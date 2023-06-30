<?php
namespace App\Service;
use App\Models\Bill;
use App\Models\Bill_NEY;
use App\Models\Bill_PF_NEY;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillService
{

    public function returnTest()
    {
        $a = "a";
        $b = "b";
        return [$a, $b];
    }

    public function makeSearchConditions($request)
    {

        $wheres = "";
        $binds = [];

        /**
         * select option 검색의 name값
         */
        $f_billForm_param = array(
             'f_bizname', 'f_shopname', 'f_price',
                        'f_pay_type', 'f_pay_interval', 'f_history', 'f_reply', 'f_statement', 'f_tax_bill', 'f_issuedate',
                        'f_registration_number', 'f_minor_business', 'f_cp_name', 'f_rep_name', 'f_addr', 'f_business', 'f_event', 'f_public_addr1', 'f_public_addr2',
                        'f_name1','f_mobile1', 'f_email1', 'f_name2', 'f_mobile2', 'f_email2', 'f_day1' ,'f_product1', 'f_standard1', 'f_unitprice1', 'f_count1', 'f_price1', 'f_tax1', 'f_bigo1',
                        'f_day2', 'f_product2', 'f_standard2', 'f_unitprice2', 'f_count2', 'f_price2', 'f_tax2', 'f_bigo2',
                        'f_day3', 'f_product3', 'f_standard3', 'f_unitprice3', 'f_count3', 'f_price3', 'f_tax3', 'f_bigo3',
                        'f_day4', 'f_product4', 'f_standard4', 'f_unitprice4', 'f_count4', 'f_price4', 'f_tax4', 'f_bigo4',
                        'f_issue_type');

        /**
         * select input 검색의 name값
         */
        $select_input_arr = array('selectInput_f_addr', 'selectInput_f_bizname', 'selectInput_f_business', 'selectInput_f_cp_name', 'selectInput_f_email1',
            'selectInput_f_email2', 'selectInput_f_event', 'selectInput_f_history', 'selectInput_f_issuedate', 'selectInput_f_minor_business', 'selectInput_f_mobile1',
            'selectInput_f_mobile2', 'selectInput_f_name1', 'selectInput_f_name2', 'selectInput_f_pay_interval', 'selectInput_f_pay_type', 'selectInput_f_price',
            'selectInput_f_price1', 'selectInput_f_price2', 'selectInput_f_price3', 'selectInput_f_price4', 'selectInput_f_product1', 'selectInput_f_product2',
            'selectInput_f_product3', 'selectInput_f_product4', 'selectInput_f_public_addr1', 'selectInput_f_public_addr2', 'selectInput_f_registration_number',
            'selectInput_f_rep_name', 'selectInput_f_reply', 'selectInput_f_shopname', 'selectInput_f_statement', 'selectInput_f_tax_bill');

        if ($request->has("f_pay_type") and $request->filled("f_pay_type")) {
            $wheres .= "and (f_pay_type = :f_pay_type)";
            $binds += array("f_pay_type"=>$request->input("f_pay_type"));
        }

        /**
         * select box 검색부분 where절 설정
         */
        foreach ($f_billForm_param as $item) {
            if ($request->has($item) and $request->filled($item)) {
                $wheres .= "and ({$item} = :{$item})";
                $binds += array($item => $request->input($item));
            }
        }

        /**
         * select box내 직접입력 input으로 검색, where절 설정
         */
        foreach ($select_input_arr as $ex_item) {
            $item = str_replace("selectInput_", "", $ex_item);
            if ($request->has($ex_item) and $request->filled($ex_item) and $request->input($ex_item) !== 'undefined') {
                $wheres .= "and ({$item} like :{$item})";
                $binds += array($item =>  "%" . $request->input($ex_item) . "%");
            }
        }


        /**
         * input box 검색부분 where절 설정
         */
        if ($request->has("sch_key") and $request->filled("sch_key")) {
            $wheres .= "and (";
            foreach($f_billForm_param as $item) {
                $wheres .= "{$item} like :sch_val or ";
            }
            $wheres = substr($wheres, 0, -3);
            $wheres .= ")";
            $binds += array("sch_val" => "%" . $request->input('sch_key') . "%");
        }

        return [
            "wheres"=>$wheres,
            "binds"=>$binds
        ];
    }

    /**
     * @param $request
     * @param string $wheres
     * @param array $binds
     * @return void
     */

    private function makeTonghapConditions($request, string &$wheres, array &$binds): void
    {
        if ($request->has("sch_key") and $request->filled("sch_key")
            and $request->has("sch_val") and $request->filled("sch_val")) {

            if ($request->input("sch_key") == "tonghap") {
                $wheres .= "and
                            (f_bizname like :sch_val
                                or f_shopname like :sch_val
                                or f_registration_number like :sch_val
                                or f_pay_interval like :sch_val
                                or f_price like :sch_val
                            )";
            } else {
                $wheres .= "and {$request->input("sch_key")} like :sch_val";
            }
            $binds += array("sch_val" => "%" . $request->input("sch_val") . "%");
        }
    }


    /**
     * bill. 이용료청구(단일) 수정
     */
    public function billUpdate(array $request)
    {
        DB::beginTransaction();
        $bill_wheres = array("f_billId"=>($request['f_billId']));
        $BillInfoKeys = self::getBillsIdInput();
        $paramOfBill_basic = self::makeToAssocidateArray($BillInfoKeys, $request);

        if (empty($request || $bill_wheres)) {
            DB::rollBack();
            return array("status"=>false, "msg"=>"수정에 실패하였습니다.");
        }
        if (!Bill_NEY::updateBill($paramOfBill_basic, $bill_wheres)) {
            DB::rollBack();
            return array("status"=>false, "수정시 에러가 발생했습니다. 입력값들을 확인해주세요.");
        }
        DB::commit();

        return array("status"=>true, "수정에 성공하였습니다.");
    }

    /**
     * bill. 이용료청구(여러개) 수정
     */
    public function billsUpdate(array $request)
    {
        DB::beginTransaction();

        foreach ($request['billIdArr'] as $billId) {
            $new_request = $request;
            $new_request['f_billId'] = $billId;
            $result = self::billUpdate($new_request);

            if (!$result['status']) {
                return response()->json([
                    "status" => "error",
                    "msg" => $result['msg']
                ]);
            }
        }

        DB::commit();

        return array("status"=>true, "수정에 성공하였습니다.");
    }


    public function findBillById(Request $request)
    {
        $bill_items = Bill_NEY::findBillById($request->input('billId'));
        $bill_pf_items = Bill_PF_NEY::findBillById($request->input('loginId'));
        //TODO : 이전코드, pf따라서 변경
//        if (empty($bill_items) || empty($bill_pf_items)) {
//            throw new Exception("검색 결과가 없습니다.");
//        }
//        return (array)$bill_pf_items[0] + (array)$bill_items[0];

        if (empty($bill_items) && empty($bill_pf_items)) {
            throw new Exception("검색 결과가 없습니다.");
        }
        if($bill_pf_items == null){
            return (array)$bill_items[0];
        }elseif($bill_items == null){
            return (array)$bill_pf_items[0];
        }return (array)$bill_pf_items[0] + (array)$bill_items[0];
    }

    /**
     * bill (이용료청구) 등록
     * @throws Exception
     */
    public function billCreate(Request $request)
    {
        $tax_type0306 = $request->input('tax_type0306') === 'on' ? 'on' : 'off';
        $tax_type01 = $request->input('tax_type01') === 'on' ? 'on' : 'off';

        $billPF_arr = self::getBillPFInfo();
        $billPFParams = self::makeToAssocidateArray($billPF_arr, $request);

        DB::beginTransaction();

        $billData = self::makeBillDataByChecked($tax_type01, $request, $tax_type0306);

        if (empty($billData)) {
            throw new Exception("등록할 계산서가 없습니다. 계산서를 등록해주세요.");
        } else if (!Bill_PF_NEY::insertBill($billPFParams)) {
            throw new Exception("공연쪽 입력 정보를 확인해주세요.");
        } else if (!Bill_NEY::insertBills($billData)) {
            throw new Exception("등록할 계산서가 없습니다. 계산서를 등록해주세요.");
        }

        DB::commit();
    }

    /**
     * 01(일반), 0306(공연,위수탁) 계산서 등록
     * @param string $tax_type01
     * @param Request $request
     * @param string $tax_type0306
     * @return array|null
     * @throws Exception
     */
    private static function makeBillDataByChecked(string $tax_type01, Request $request, string $tax_type0306): ?array
    {
        /**
         * $basic_info_param : 등록 모달창 기본 데이터 파라미터 셋팅 (공연권료, 이용료 분할은 제외)
         */
        $basic_info_arr = self::getBillBasicInfo();
        $basic_info_param = self::makeToAssocidateArray($basic_info_arr, $request);

        /**
         * $billData_01   : [ 이용료 분할 / (세금)계산서 (일반) ] 01 ] --> on일때(각 row insert), off일때(1개 row) 등록할  array 리턴
         * $billData_0306 : [공연권료 / (세금)계산서 (위수탁)] 03 06 ] --> on일떄(각 row insert), off(동작 x) 등록할  array 리턴
         */
        $billData_01 = self::getInfo_01($tax_type01, $basic_info_param, $request);
        $billData_0306 = self::getInfo_0306($tax_type0306, $basic_info_param, $request);

        return array_merge($billData_01, $billData_0306);
    }

    /**
     * input의 id값과 db의 컬럼명이 같은 경우 사용
     * @param array $BillInfoKeys : db의 컬럼명과 일치하는 소문자로 된 id값 배열
     * @param array $request : request 값
     * @return array key => value  연관배열
     */
    private static function makeToAssocidateArray(array $BillInfoKeys, array $request): array
    {
        $arr = array();
        foreach ($BillInfoKeys as $key) {
            if (array_key_exists($key, $request)) {
                $arr[strtoupper($key)] = $request[$key];
            }
        }
        return $arr;
    }
    private static function getBillsIdInput()
    {
        return array_merge(self::getBillBasicInfo(), self::getBillDivisionInfo());
    }

    private static function getBillBasicInfo()
    {
        return array(
            'f_shopname', 'f_cb', 'f_business', 'f_cp_name', 'f_name1', 'f_pay_type', 'f_rep_name', 'f_mobile1',
            'f_pay_interval', 'f_interval_option', 'f_registration_number', 'f_email1', 'f_history', 'f_addr', 'f_name2', 'f_reply',
            'f_public_addr1', 'f_mobile2', 'f_statement', 'f_public_addr2', 'f_email2', 'f_tax_bill','f_issue_type');
    }

    private static function getBillDivisionInfo()
    {
        return array('f_bigo',
            'f_product1', 'f_product2', 'f_product3', 'f_product4',
            'f_unitprice1', 'f_unitprice2', 'f_unitprice3', 'f_unitprice4',
            'f_bigo1', 'f_bigo2', 'f_bigo3', 'f_bigo4'
        );
    }

    /**
     * @throws Exception
     */


    private static function getBillPFInfo()
    {
        return array("f_loginid", "f_tax_issue", "f_pf_price", "f_pyung", "f_village", "f_issuedate", "f_opendate", "f_closedate",);
    }

    /**
     * [ 이용료 분할 / (세금)계산서 (일반) ] 01
     *      on -> 각 품목마다 각각의 row로 insert
     *      off -> 품목1~4를 한개의 row에 insert
     * @param string $tax_type01
     * @param array $basic_info_param
     * @param Request $request
     * @return array
     * @throws Exception
     */
    private static function getInfo_01(string $tax_type01, array $basic_info_param, Request $request): array{
        $results = array();
        if ($tax_type01 === "on") {
            for ($i = 1; $i <= 4; $i++) {
                $params = $basic_info_param;
                $params["F_LOGINID"] = $request->input('f_loginid');
                $params["F_BIGO"] =  $request->input('f_bigo');
                if (!empty($request->input('f_product' . $i))) {
                    $params["F_PRODUCT1"] = $request->input('f_product' . $i);
                    $params["F_UNITPRICE1"] = $request->input('f_unitprice' . $i);
                    $params["F_BIGO1"] = $request->input('f_bigo' . $i);
                    $params["F_ISSUE_TYPE"] = $request->input('f_issue_type_prod' . $i);
                    $params["F_BIGO"] = $request->input('f_bigo');
                    $params["F_PRICE"] = $request->input('f_unitprice' . $i);
                    $params["F_TAX_TYPE"] = "01"; //이용료 분할 계산서 (일반 -> 01)
                    $params["F_ASSO"] = "NORMAL";
                    $results[] = $params;
                }
            }
        } else if ($tax_type01 === "off") {

            $total_price = 0;
            $params = $basic_info_param;

            $total_price += $request->input('f_unitprice1');
            $total_price += $request->input('f_unitprice2');
            $total_price += $request->input('f_unitprice3');
            $total_price += $request->input('f_unitprice4');
            $params["F_LOGINID"] = $request->input('f_loginid');
            $params["F_PRICE"] = $total_price;
            $params["F_PRODUCT1"] = $request->input('f_product1');
            $params["F_UNITPRICE1"] = $request->input('f_unitprice1');
            $params["F_ISSUE_TYPE"] = $request->input('f_issue_type_prod1');
            $params["F_BIGO1"] = $request->input('f_bigo1');

            $params["F_PRODUCT2"] = $request->input('f_product2');
            $params["F_UNITPRICE2"] = $request->input('f_unitprice2');
            $params["F_BIGO2"] = $request->input('f_bigo2');

            $params["F_PRODUCT3"] = $request->input('f_product3');
            $params["F_UNITPRICE3"] = $request->input('f_unitprice3');
            $params["F_BIGO3"] = $request->input('f_bigo3');

            $params["F_PRODUCT4"] = $request->input('f_product4');
            $params["F_UNITPRICE4"] = $request->input('f_unitprice4');
            $params["F_BIGO4"] = $request->input('f_bigo4');

            $params["F_BIGO"] = $request->input('f_bigo');
            $params["F_ASSO"] = "NORMAL";

            $results[] = $params;
        }
        return $results;
    }


    /**
     * [공연권료 / (세금)계산서 (위수탁)] 03 06
     *      on -> 음저협, 합저협, 음실련, 연제협을 각 row에 insert
     *      off -> 동작 X (checkbox가 off이면 해당 <div> -> style.display="none")
     * @param string $tax_type0306
     * @param array $basic_info_param
     * @param Request $request
     * @return array
     */
    private static function getInfo_0306(string $tax_type0306, array $basic_info_param, Request $request): array
    {
        $asso_arr = array(
            "KOMCA" => "06",
            "FKMP" => "06",
            "KAPP" => "03",
            "KOSCAP" => "06"
        );
        $results = array();
        if ($tax_type0306 == "on") {
            foreach ($asso_arr as $key => $val) {
                $params = $basic_info_param;
                $params["F_LOGINID"] = $request->input("f_loginid");
                $params["F_PRODUCT1"] = $request->input("f_product1_" . strtolower($key));
                $params["F_UNITPRICE1"] = $request->input("f_unitprice_" . strtolower($key));
                $params["F_ISSUE_TYPE"] = $request->input("f_issue_type_" . strtolower($key));
                $params["F_BIGO1"] = $request->input("f_bigo1_" . strtolower($key));
                $params["F_BIGO"] = $request->input("f_bigo_" . strtolower($key));
                $params["F_TAX_TYPE"] = $val;
                $params["F_ASSO"] = $key;

                $results[] = $params;
            }
        }
        return $results;
    }
}
?>
