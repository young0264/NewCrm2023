<?php
namespace App\Service;
use App\Models\Bill_NEY;
use App\Models\Bill_PF_NEY;
use App\Models\BRClient;
use App\Models\SCShop;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Common;

class BillPublishService {

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

    public function makeSearchConditions($request): array {
        $wheres = "";
        $binds = [];
        $sch_year = $request->input('sch_year');
        $sch_month = $request->input('sch_month');
        $f_yd_date = substr($sch_year, 2, 2).$sch_month;

        /**
         * 년도, 월 클릭시 검색 where절 설정
         */
        if ($sch_year === 'all') {
            $wheres .= "and (SUBSTR(f_yd_date, -2)  = :f_yd_date)";
            $binds += array('f_yd_date' => $sch_month);
        }
        if ($sch_year != 'all') {
            $wheres .= "and (f_yd_date = :f_yd_date)";
            $binds += array('f_yd_date' => $f_yd_date);
        }

        /**
         * select-box 검색부분 where절 설정
         */
        foreach (self::$f_billForm_param as $item) {
            if ($request->has($item) and $request->filled($item)) {
                $wheres .= " and ({$item} = :{$item})";
                $binds += array($item => $request->input($item));
            }
        }

        /**
         * select-box내 직접입력 input으로 검색, where절 설정
         */
        foreach (self::$select_input_arr as $ex_item) {
            $item = str_replace("searchInput_", "", $ex_item);
            if ($request->has($ex_item) and $request->filled($ex_item) and $request->input($ex_item) !== 'undefined') {
                $wheres .= "and ({$item} like :{$item})";
                $binds += array($item =>  "%" . $request->input($ex_item) . "%");
            }
        }

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


}
