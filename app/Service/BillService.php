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
        if ($request->has("f_pay_type") and $request->filled("f_pay_type")) {
            $wheres .= "and (f_pay_type = :f_pay_type)";
            $binds += array("f_pay_type"=>$request->input("f_pay_type"));
        }

        $this->makeTonghapConditions($request, $wheres, $binds);

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
     * bill. 이용료청구 수정
     * @throws Exception
     */
    public function billUpdate(Request $request)
    {
        DB::beginTransaction();

        $bill_wheres = array("f_billId"=>$request['f_billId']);
        $BillInfoKeys = self::getBillInput();
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

    public function findBillById(Request $request)
    {
        $bill_items = Bill_NEY::findBillById($request->input('billId'));
        $bill_pf_items = Bill_PF_NEY::findBillById($request->input('loginId'));

        if (empty($bill_items) || empty($bill_pf_items)) {
            throw new Exception("검색 결과가 없습니다.");
        }

        return (array)$bill_pf_items[0] + (array)$bill_items[0];

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
     * @param Request $request : request 값
     * @return array key => value  연관배열
     */
    private static function makeToAssocidateArray(array $BillInfoKeys, Request $request): array
    {
        $arr = array();
        foreach ($BillInfoKeys as $key) {
            $arr[strtoupper($key)] = $request->input($key);
        }
        return $arr;
    }
    private static function getBillInput()
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



//    public function insertBill($parameters) {
//        return DB::table('T_BILL_PF_NEY')->insert($parameters);
//    }
//
//    public function findBillById($loginId){
//        $query = "SELECT * FROM T_BILL_PF_NEY WHERE f_loginid=:f_loginid";
//        return DB::select($query, array("f_loginid"=>$loginId));
//    }
//
//    public function updateBill(array $parameter, array $wheres)
//    {
//        return DB::table('T_BILL_PF_NEY')
//            ->where($wheres)
//            ->update($parameter);
//    }
?>
