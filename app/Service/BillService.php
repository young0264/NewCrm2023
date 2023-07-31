<?php
namespace App\Service;
use App\Models\Bill_NEY;
use App\Models\Bill_PF_NEY;
use App\Models\BillPublishNEY;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillService{

    private static $client_extra_key_info = array(
        'f_osp', 'f_admin', 'f_bizid', 'f_bizname', 'f_shopid'
    );

    /**
     * select option 검색의 name값
     */
    private static $f_billForm_param = array(
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
    private static $select_input_arr = array(
        'searchInput_f_addr', 'searchInput_f_bizname', 'searchInput_f_business', 'searchInput_f_cp_name', 'searchInput_f_email1',
        'searchInput_f_email2', 'searchInput_f_event', 'searchInput_f_history', 'searchInput_f_issuedate', 'searchInput_f_minor_business', 'searchInput_f_mobile1',
        'searchInput_f_mobile2', 'searchInput_f_name1', 'searchInput_f_name2', 'searchInput_f_pay_interval', 'searchInput_f_pay_type', 'searchInput_f_price',
        'searchInput_f_price1', 'searchInput_f_price2', 'searchInput_f_price3', 'searchInput_f_price4', 'searchInput_f_product1', 'searchInput_f_product2',
        'searchInput_f_product3', 'searchInput_f_product4', 'searchInput_f_public_addr1', 'searchInput_f_public_addr2', 'searchInput_f_registration_number',
        'searchInput_f_rep_name', 'searchInput_f_reply', 'searchInput_f_shopname', 'searchInput_f_statement', 'searchInput_f_tax_bill');




    /**
     * 검색조건 wheres, bindings 생성
     */
    public function makeSearchConditions($request): array {
        $wheres = "and (F_DELETED = 'N')";
        $binds = [];

        /**
         * input 컬럼 검색
         */
        if ($request->filled("sch_key") and $request->input("sch_key") != "tonghap") {
            $wheres .= " and (";
            $wheres .= $request->input('sch_key') . " like :sch_val";
            $wheres .= ")";
            $binds += array("sch_val" => "%" . $request->input('sch_val') . "%");
        }

        /**
         * input tonghap 검색
         */
        if ($request->input("sch_key") == "tonghap") {
            $wheres .= " and (";
            foreach(self::$f_billForm_param as $item) {
                $wheres .= "{$item} like :sch_val or ";
            }
            $wheres = substr($wheres, 0, -3);
            $wheres .= ")";
            $binds += array("sch_val" => "%" . $request->input('sch_val') . "%");
        }

        return [
            "wheres"=>$wheres,
            "binds"=>$binds
        ];
    }


    /**
     * bill. 이용료청구(단일) 수정
     */
    public function billSingleUpdate(array $request){
        DB::beginTransaction();
        $bill_wheres = array("f_billId"=>($request['f_billId']));
        $paramOfBill_basic = self::makeToAssocidateArray($request, self::getAllBillIds());

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

    public function findBillById(Request $request){
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
        }else if($bill_items == null){
            return (array)$bill_pf_items[0];
        }return (array)$bill_pf_items[0] + (array)$bill_items[0];
    }

    /**
     * bill (이용료청구) 등록
     * @throws Exception
     */
    public function billCreate(Request $request){
        DB::beginTransaction();
        $tax_type0306 = $request->input('tax_type0306') === 'on' ? 'on' : 'off';
        $tax_type01 = $request->input('tax_type01') === 'on' ? 'on' : 'off';
        $billPFParams = self::makeToAssocidateArray($request->input(), self::getBillPFInfo());
        $billsData = self::getBillTotalData($tax_type01, $request, $tax_type0306);

        Bill_PF_NEY::insertBill($billPFParams);
        Bill_NEY::insertBills($billsData);

        if ($request->input('bill_immediate') == "true") {
            BillPublishNEY::insertBillPublish($billsData);
        };
        DB::commit();
    }

    /**
     * 01(일반), 0306(공연,위수탁) 계산서 등록
     */
    private static function getBillTotalData(string $tax_type01, Request $request, string $tax_type0306): ?array{

        /**
         * $basic_info_param : 등록 모달창 기본 데이터 파라미터 셋팅 (공연권료, 이용료 분할은 제외)
         * $billData_0306 : [공연권료 / (세금)계산서 (위수탁)] 03 06 ] --> on일떄(각 row insert), off(동작 x) 등록할  array 리턴
         * $billData_01   : [ 이용료 분할 / (세금)계산서 (일반) ] 01 ] --> on일때(각 row insert), off일때(1개 row) 등록할  array 리턴
         */
        $billData_0306 = self::getInfo_0306($tax_type0306, $request);
        $billData_01 = self::getInfo_01($tax_type01, $request);

        return array_merge($billData_01, $billData_0306);
    }

    /**
     * getBillsIdInput의 key를 기준으로
     * request로 들어온 값을 key:value의 연관배열 형태로 만들어 리턴
     */
    private static function makeToAssocidateArray(array $request, array $keyArray): array{
        $associate_arr = array();
        foreach ($keyArray as $key) {
            if (array_key_exists($key, $request)) {
                $associate_arr[strtoupper($key)] = $request[$key];
            }
        }
        //sequence 형태로 billid 직접 넣어주기
        $nextVal = DB::select("SELECT \"SBMUSIC\".\"T_BILL_NEY_SEQ\".NEXTVAL FROM DUAL");
        $associate_arr["f_billid"] = $nextVal[0]->nextval;
        return $associate_arr;
    }

    /**
     * bill 전체 id 정보
     */
    private static function getAllBillIds(){
        return array_merge(self::getBillBasicInfo(), self::getBillDivisionInfo(), self::getExtraIdsOfBill());
    }

    /**
     * bill_table 기타 정보들(column)
     */
    private static function getExtraIdsOfBill(){
        return array('f_price', 'f_price1', 'f_price2', 'f_price3', 'f_price4', 'f_minor_business', 'f_cp_name', 'f_event', 'f_issuedate');
    }

    /**
     * bill 등록 기본 정보
     */
    private static function getBillBasicInfo(){
        return array(
            'f_shopname', 'f_cb', 'f_business', 'f_cp_name', 'f_name1', 'f_pay_type', 'f_rep_name', 'f_mobile1', 'f_regid', 'f_loginid',
            'f_pay_interval', 'f_interval_option', 'f_registration_number', 'f_email1', 'f_history', 'f_addr', 'f_name2', 'f_reply',
            'f_public_addr1', 'f_mobile2', 'f_statement', 'f_public_addr2', 'f_email2', 'f_tax_bill','f_issue_type');
    }

    /**
     * bill 이용료분할 (일반) 정보
     */
    private static function getBillDivisionInfo(){
        return array('f_bigo',
            'f_product1', 'f_product2', 'f_product3', 'f_product4',
            'f_unitprice1', 'f_unitprice2', 'f_unitprice3', 'f_unitprice4',
            'f_bigo1', 'f_bigo2', 'f_bigo3', 'f_bigo4'
        );
    }

    /**
     * t_bill_pf 테이블 column 정보
     */
    private static function getBillPFInfo(){
        return array("f_loginid", "f_tax_issue", "f_pf_price", "f_pyung", "f_village", "f_issuedate", "f_opendate", "f_closedate");
    }

    /**
     * [ 이용료 분할 / (세금)계산서 (일반) ] 01
     *      on -> 각 품목마다 각각의 row로 insert
     *      off -> 품목 1~4를 한개의 row에 insert
     */
    private static function getInfo_01(string $tax_type01, Request $request): array{
        $basic_info_param = self::makeToAssocidateArray($request->input(), self::getBillBasicInfo());
        $client_result = self::makeToAssocidateArray($request->input(), self::$client_extra_key_info);

        $result = array();
        if ($tax_type01 === "on") {
            for ($i = 1; $i <= 4; $i++) {
                if (empty($request->input('f_product' . $i))) {
                    break;
                }
                $params = array_merge($basic_info_param,$client_result);
                $params["F_PRODUCT1"] = $request->input('f_product' . $i);
                $params["F_UNITPRICE1"] = $request->input('f_unitprice' . $i);
                $params["F_BIGO1"] = $request->input('f_bigo' . $i);
                $params["F_ISSUE_TYPE"] = $request->input('f_issue_type_prod' . $i);
                $params["F_BIGO"] = $request->input('f_bigo');
                $params["F_PRICE"] = $request->input('f_unitprice' . $i);
                $params["F_TAX_TYPE"] = "01"; //이용료 분할 계산서 (일반 -> 01)
                $params["F_ASSO"] = "NORMAL";
                $result[] = $params;
            }
        } else if ($tax_type01 === "off") {
            $total_price = 0;
            $total_price += $request->input('f_unitprice1');
            $total_price += $request->input('f_unitprice2');
            $total_price += $request->input('f_unitprice3');
            $total_price += $request->input('f_unitprice4');

            $params = array_merge($basic_info_param,$client_result);
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
            $result[] = $params;
        }
        return $result;
    }

    /**
     * [공연권료 / (세금)계산서 (위수탁)] 03 06
     *      on -> 음저협, 합저협, 음실련, 연제협을 각 row에 insert
     *      off -> 동작 X (checkbox가 off이면 해당 <div> -> style.display="none")
     */
    private static function getInfo_0306(string $tax_type0306, Request $request): array{
        $basic_info_param = self::makeToAssocidateArray($request->input(), self::getBillBasicInfo());
        $client_result = self::makeToAssocidateArray($request->input(), self::$client_extra_key_info);

        $result = array();
        $asso_arr = array(
            "KOMCA" => "06",
            "FKMP" => "06",
            "KAPP" => "03",
            "KOSCAP" => "06"
        );
        if ($tax_type0306 == "on") {
            foreach ($asso_arr as $key => $val) {
                if (empty($request->input("f_product1_" . strtolower($key)))) {
                    break;
                }
                $params = array_merge($basic_info_param,$client_result);
                $params["F_PRODUCT1"] = $request->input("f_product1_" . strtolower($key));
                $params["F_UNITPRICE1"] = $request->input("f_unitprice_" . strtolower($key));
                $params["F_ISSUE_TYPE"] = $request->input("f_issue_type_" . strtolower($key));
                $params["F_BIGO1"] = $request->input("f_bigo1_" . strtolower($key));
                $params["F_BIGO"] = $request->input("f_bigo_" . strtolower($key));
                $params["F_TAX_TYPE"] = $val;
                $params["F_ASSO"] = $key;
                $result[] = $params;
            }
        }
        return $result;
    }

    /**
     * @throws Exception
     */
    public function billDelete(array $request) {
        DB::beginTransaction();
        Bill_NEY::deleteBill($request['f_billid']);
        DB::commit();
        return true;
    }
}
?>
