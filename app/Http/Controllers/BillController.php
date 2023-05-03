<?php

namespace App\Http\Controllers;
use App\Models\Bill;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class BillController extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public static function issue()
    {
        return view("bill.billIssueView");
    }
    public static function form()
    {
        return view("bill.billFormView");
    }
    public static function printForm()
    {
        return view("bill.printBillFormView");
    }

    public static function integrate()
    {
        return view("bill.integratedCollection");
    }

    public static function cashReceipt()
    {
        return view("bill.cashReceiptSearch");
    }

    public static function list(Request $request) {

        $wheres = "and f_admin='BR'";
        $params = [];

        $items = Bill::list($wheres, $params);

        $headers = array();
        foreach ($items as $key=>$item) {
            if ($key > 0)
                break;

            foreach ($item as $header=>$i) {
                if($header == "f_billid"
                    || $header == "f_bizid"
                    || $header == "f_shopid"
                    || $header == "f_status"
                    || $header == "f_standard1"
                    || $header == "f_standard2"
                    || $header == "f_standard3"
                    || $header == "f_standard4"
                    || $header == "f_count1"
                    || $header == "f_count2"
                    || $header == "f_count3"
                    || $header == "f_count4"
                    || $header == "f_tax1"
                    || $header == "f_tax2"
                    || $header == "f_tax3"
                    || $header == "f_tax4"
                    || $header == "f_bigo1"
                    || $header == "f_bigo2"
                    || $header == "f_bigo3"
                    || $header == "f_bigo4"
                    || $header == "f_day1"
                    || $header == "f_day2"
                    || $header == "f_day3"
                    || $header == "f_day4"
                    || $header == "f_unitprice1"
                    || $header == "f_unitprice2"
                    || $header == "f_unitprice3"
                    || $header == "f_unitprice4"
                    || $header == "f_issue_type"
                ) {
                    continue;
                }
                $headers[] = array("key"=>$header, "name"=>Bill::$column[strtoupper($header)]);
            }
        }


        return response()->json(
            [
                "status"=>"ok",
                "result"=>array(
                    "header"=>json_encode($headers),
                    "items"=>json_encode($items)
                )
            ]);
    }

    public static function billRegisterProcess(Request $request)
    {
        $tax_type0306 = $request->input('tax_type0306') === 'on' ? 'on' : 'off';
        $tax_type01 = $request->input('tax_type01') === 'on' ? 'on' : 'off';

        extract($_POST);


        /**
         * 1. 이용료에 대한 등록
         * {
         *      1-1 이용료 분할에 체크 O => 맥시멈 4줄
         *      1-2 이용ㄹ 분할에 체크 X => 1줄인데 => 옆으로 집어넣어
         * }
         * 2. 공연권료 체크가 되어있으면, 음저협 / 함저협 / 음실연 / 연제협 의 데이터를 4줄을 모두 넣는다. ( 각각 )
         */

        $asso_array = array(
            "KOMCA"=>"06",
            "FKMP"=>"06",
            "KAPP"=>"03",
            "KOSCAP"=>"06"
        );
        // 기본 파라미터 세팅 ( 전체 )
        $basic_info_param = array(
            "F_EVENT"=>$f_event,
            "F_BUSINESS"=>$f_business,
            "F_CP_NAME"=>$f_cp_name,
            "F_NAME1"=>$f_name1,
            "F_PAY_TYPE"=>$f_pay_type,
            "F_REP_NAME"=>$f_rep_name,
            "F_MOBILE1"=>$f_mobile1,
            "F_PAY_INTERVAL"=>$f_pay_interval,
            "F_REGISTRATION_NUMBER"=>$f_registration_number,
            "F_EMAIL1"=>$f_email1,
            "F_HISTORY"=>$f_history,
            "F_ADDR"=>$f_addr,
            "F_NAME2"=>$f_name2,
            "F_REPLY"=>$f_reply,
            "F_PUBLIC_ADDR1"=>$f_public_addr1,
            "F_MOBILE2"=>$f_mobile2,
            "F_STATEMENT"=>$f_statement,
            "F_PUBLIC_ADDR2"=>$f_public_addr2,
            "F_EMAIL2"=>$f_email2,
            "F_TAX_BILL"=>$f_tax_bill
        );

        $params = array();
        // 이용료 건 등록
//        try {
//            if (empty($f_reply)) throw new \Exception("컬럼이 없습니다");
//        } catch (\Exception $e) {
//            DB::rollBack();
//            return response()->json(array("status"=>"error", "msg"=>$e->getMessage()));
//        }

        if ($tax_type01 === "on") {
            /**
             * 이용료분할 처리가 On 되었을 경우
             * 품목명이 있을 경우에만  등록한다. ( Maximum : 4줄 )
             */
            for ($i=1; $i<=4; $i++) {
                $params = $basic_info_param;
                if (!empty($_POST['f_product'.$i])) {

                    $params["F_PRODUCT1"] = $_POST["f_product".$i];
                    $params["F_UNITPRICE1"] = $_POST["f_unitprice".$i];
                    $params["F_TAX_TYPE"] = "01"; //이용료 분할 계산서 (일반 -> 01)
                    $params["F_ISSUE_TYPE"] = $_POST["f_issue_type_prod".$i];
                    $params["F_BIGO1"] = $_POST["f_bigo".$i];
                    $params["F_BIGO"] = $_POST['f_bigo'];
                    $params["F_ASSO"] = "NORMAL";

                    // 인서트
                    if (DB::table('T_BILL_NEY')->insert( $params) === false)
                        throw new \Exception("등록을 실패하였습니다." .$i);
                }
            }

        } else if($tax_type01 === "off") {
            /**
             * 이용료분할 처리가 Off 되었을 경우
             * 옆으로 1~4까지 컬럼을 다 채운다
             */
            $params = $basic_info_param;
            $params["F_PRODUCT1"] = $_POST["f_product1"];
            $params["F_UNITPRICE1"] = $_POST["f_unitprice1"];
            $params["F_ISSUE_TYPE"] = $_POST["f_issue_type_prod1"];
            $params["F_BIGO1"] = $_POST["f_bigo1"];

            $params["F_PRODUCT2"] = $_POST["f_product2"];
            $params["F_UNITPRICE2"] = $_POST["f_unitprice2"];
            $params["F_BIGO2"] = $_POST["f_bigo2"];

            $params["F_PRODUCT3"] = $_POST["f_product3"];
            $params["F_UNITPRICE3"] = $_POST["f_unitprice3"];
            $params["F_BIGO3"] = $_POST["f_bigo3"];

            $params["F_PRODUCT4"] = $_POST["f_product4"];
            $params["F_UNITPRICE4"] = $_POST["f_unitprice4"];
            $params["F_BIGO4"] = $_POST["f_bigo4"];

            $params["F_BIGO"] = $_POST['f_bigo'];
            $params["F_ASSO"] = "NORMAL";

            // 인서트
            DB::table('T_BILL_NEY')->insert( $params);
        }





//        DB::commit();
//        print_r("T_BILL_NEY INSERT123");
//        exit;


        // 공연권료 등록
        if ($tax_type0306 == "on") {
            foreach ($asso_array as $key => $val) {
                $params = $basic_info_param;
                $params["F_PRODUCT1"] = $_POST["f_product1_".strtolower($key)];
                $params["F_UNITPRICE1"] = $_POST["f_unitprice_".strtolower($key)];
                $params["F_ISSUE_TYPE"] = $_POST["f_issue_type_".strtolower($key)];
                $params["F_BIGO1"] = $_POST["f_bigo1_".strtolower($key)];
                $params["F_TAX_TYPE"] = $val;
                $params["F_BIGO"] = $_POST["f_bigo_".strtolower($key)];
                $params["F_ASSO"] = $key;

                // 인서트
                DB::table('T_BILL_NEY')->insert($params);
            }
        }
        DB::commit();
        print_r("T_BILL_NEY INSERT123");
        exit;


//        if ($mode == 'insert') {
//            $f_billid = 0;
//        }



//        $wheres = array("F_BILLID" => $f_billid);
//        $wheres = array("F_BILLID"=>999999999999999999999);


        $second_info_param1 = array();
        $second_info_param2 = array();
        $second_info_param3 = array();
        $second_info_param4 = array();

        $final_info_param = array();

//        공연권료 / (세금)계산서 (위수탁)
        if ($tax_type0306 == 'off') {
            print_r("공연권료 / (세금)계산서 (위수탁)");
            $param_arr = array(
                "F_ASSO" => 'NORMAL'
            );
            $basic_info_param = array_merge($basic_info_param, $param_arr);

        } else if ($tax_type0306 == 'on') {
            $param_arr1 = array(
//                "F_ASSO" => 'KOMCA',
                "F_ASSO"=>$f_asso_komca,
                "F_ISSUE_TYPE"=>$f_issue_type_komca,
                "F_BIGO1"=>$f_bigo1_komca,
                "F_BIGO"=>$f_bigo_komca
            );
            $param_arr2 = array(
//                "F_ASSO" => 'FKMP',
                "F_ASSO"=>$f_asso_fkmp,
                "F_ISSUE_TYPE"=>$f_issue_type_fkmp,
                "F_BIGO1"=>$f_bigo1_fkmp,
                "F_BIGO"=>$f_bigo_fkmp
            );
            $param_arr3 = array(
//                "F_ASSO" => 'KOSCAP',
                "F_ASSO"=>$f_asso_koscap,
                "F_ISSUE_TYPE"=>$f_issue_type_koscap,
                "F_BIGO1"=>$f_bigo1_koscap,
                "F_BIGOP"=>$f_bigo_koscap
            );
            $param_arr4 = array(
//                "F_ASSO" => 'KAPP',
                "F_ASSO"=>$f_asso_kapp,
                "F_ISSUE_TYPE"=>$f_issue_type_kapp,
                "F_BIGO1"=>$f_bigo1_kapp,
                "F_BIGO"=>$f_bigo_kapp
            );

            $second_info_param1 = array_merge($basic_info_param, $param_arr1);
            $second_info_param2 = array_merge($basic_info_param, $param_arr2);
            $second_info_param3 = array_merge($basic_info_param, $param_arr3);
            $second_info_param4 = array_merge($basic_info_param, $param_arr4);
        }

        $param_arr = array(

            "F_PRODUCT1"=>$f_product1,
            "F_COUNT1"=>$f_count1,
            "F_STANDARD1"=>$f_issue_type_prod1,
            "F_BIGO1"=>$f_bigo1,

            "F_PRODUCT2"=>$f_product2,
            "F_COUNT2"=>$f_count2,
            "F_STANDARD2"=>$f_issue_type_prod2,
            "F_BIGO2"=>$f_bigo2,

            "F_PRODUCT3"=>$f_product3,
            "F_COUNT3"=>$f_count3,
            "F_STANDARD3"=>$f_issue_type_prod3,
            "F_BIGO3"=>$f_bigo3,

            "F_PRODUCT4"=>$f_product4,
            "F_COUNT4"=>$f_count4,
            "F_STANDARD4"=>$f_issue_type_prod4,
            "F_BIGO4"=>$f_bigo4
        );

        $param_arr5 = array();
        $param_arr6 = array();
        $param_arr7 = array();
        $param_arr8 = array();

        //  이용료 분할 / (세금)계산서 (일반)
        if ($tax_type0306=='off' and $tax_type01 == 'off' ) {
            print_r("이용료 분할 / (세금)계산서 (일반)");
            $final_info_param = array_merge($basic_info_param, $param_arr);
            DB::table('T_BILL_NEY')->updateOrInsert($wheres, $final_info_param);

        }else if ( $tax_type0306=='on' and $tax_type01 == 'off'){
            $param_arr1 = array_merge($second_info_param1, $param_arr);
            $param_arr2 = array_merge($second_info_param2, $param_arr);
            $param_arr3 = array_merge($second_info_param3, $param_arr);
            $param_arr4 = array_merge($second_info_param4, $param_arr);
            DB::table('T_BILL_NEY')->updateOrInsert($wheres, $param_arr1);
            DB::table('T_BILL_NEY')->updateOrInsert($wheres, $param_arr2);
            DB::table('T_BILL_NEY')->updateOrInsert($wheres, $param_arr3);
            DB::table('T_BILL_NEY')->updateOrInsert($wheres, $param_arr4);
        } else if ($tax_type0306=='off' and $tax_type01 == 'on') {
            $arr1 = array(
                "F_PRODUCT1" => $f_product1,
                "F_COUNT1" => $f_count1,
                "F_STANDARD1" => $f_issue_type_prod1,
                "F_BIGO1" => $f_bigo1);
            $arr2 = array(
                "F_PRODUCT2"=>$f_product2,
                "F_COUNT2"=>$f_count2,
                "F_STANDARD2"=>$f_issue_type_prod2,
                "F_BIGO2"=>$f_bigo2);
            $arr3 = array(
                "F_PRODUCT3"=>$f_product3,
                "F_COUNT3"=>$f_count3,
                "F_STANDARD3"=>$f_issue_type_prod3,
                "F_BIGO3"=>$f_bigo3);
            $arr4 = array(
                "F_PRODUCT4"=>$f_product4,
                "F_COUNT4"=>$f_count4,
                "F_STANDARD4"=>$f_issue_type_prod4,
                "F_BIGO4"=>$f_bigo4);
            $param_arr5 = array_merge($basic_info_param,$arr1);
            $param_arr6 = array_merge($basic_info_param,$arr2);
            $param_arr7 = array_merge($basic_info_param,$arr3);
            $param_arr8 = array_merge($basic_info_param,$arr4);
            DB::table('T_BILL_NEY')->updateOrInsert($wheres, $param_arr5);
            DB::table('T_BILL_NEY')->updateOrInsert($wheres, $param_arr6);
            DB::table('T_BILL_NEY')->updateOrInsert($wheres, $param_arr7);
            DB::table('T_BILL_NEY')->updateOrInsert($wheres, $param_arr8);
        }
//        else if ($tax_type0306 == 'on' and $tax_type01 == 'on') {
//
//        }

        echo "<pre>";
//        print_r($final_info_param);
//        exit;
//        DB::table('T_BILL')->updateOrInsert($wheres, $final_info_param);





        DB::commit();
        return redirect()->route('chargeMemberRegist');


////        param all info
//        $param = array(
//            "F_TAX_TYPE"=>$f_tax_type,
//            "F_EVENT"=>$f_event,
//            "F_BUSINESS"=>$f_business,
//            "F_CP_NAME"=>$f_cp_name,
//            "F_NAME1"=>$f_name1,
//            "F_PAY_TYPE"=>$f_pay_type,
//            "F_REP_NAME"=>$f_rep_name,
//            "F_MOBILE1"=>$f_mobile1,
//            "F_PAY_INTERVAL"=>$f_pay_interval,
//            "F_REGISTRATION_NUMBER"=>$f_registration_number,
//            "F_EMAIL1"=>$f_email1,
//            "F_HISTORY"=>$f_history,
//            "F_ADDR"=>$f_addr,
//            "F_NAME2"=>$f_name2,
//            "F_REPLY"=>$f_reply,
//            "F_PUBLIC_ADDR1"=>$f_public_addr1,
//            "F_MOBILE2"=>$f_mobile2,
//            "F_STATEMENT"=>$f_statement,
//            "F_PUBLIC_ADDR2"=>$f_public_addr2,
//            "F_EMAIL2"=>$f_email2,
//            "F_TAX_BILL"=>$f_tax_bill,
//
////  공연권료 / (세금)계산서 (위수탁)
//            "tax_type0306"=>$tax_type0306, // on/off
//
//            "F_ASSO_KOMCA"=>$f_asso_komca,
//            "F_ISSUE_TYPE_KOMCA"=>$f_issue_type_komca,
//            "F_BIGO1_KOMCA"=>$f_bigo1_komca,
//            "F_BIGO_KOMCA"=>$f_bigo_komca,
//
//            "F_ASSO_KOSCAP"=>$f_asso_koscap,
//            "F_ISSUE_TYPE_KOSCAP"=>$f_issue_type_koscap,
//            "F_BIGO1_KOSCAP"=>$f_bigo1_koscap,
//            "F_BIGO_KOSCAP"=>$f_bigo_koscap,
//
//            "F_ASSO_FKMP"=>$f_asso_fkmp,
//            "F_ISSUE_TYPE_FKMP"=>$f_issue_type_fkmp,
//            "F_BIGO1_FKMP"=>$f_bigo1_fkmp,
//            "F_BIGO_FKMP"=>$f_bigo_fkmp,
//
//            "F_ASSO_KAPP"=>$f_asso_kapp,
//            "F_ISSUE_TYPE_KAPP"=>$f_issue_type_kapp,
//            "F_BIGO1_KAPP"=>$f_bigo1_kapp,
//            "F_BIGO_KAPP"=>$f_bigo_kapp,
//
////  이용료 분할 / (세금)계산서 (일반)
//            "TAX_TYPE01"=>$tax_type01, // on/off
//            "F_PRODUCT1"=>$f_product1,
//            "F_COUNT1"=>$f_count1,
//            "F_ISSUE_TYPE_PROD1"=>$f_issue_type_prod1,
//            "F_BIGO1"=>$f_bigo1,
//            "F_PRODUCT2"=>$f_product2,
//            "F_COUNT2"=>$f_count2,
//            "F_ISSUE_TYPE_PROD2"=>$f_issue_type_prod2,
//            "F_BIGO2"=>$f_bigo2,
//            "F_PRODUCT3"=>$f_product3,
//            "F_COUNT3"=>$f_count3,
//            "F_ISSUE_TYPE_PROD3"=>$f_issue_type_prod3,
//            "F_BIGO3"=>$f_bigo3,
//            "F_PRODUCT4"=>$f_product4,
//            "F_COUNT4"=>$f_count4,
//            "F_ISSUE_TYPE_PROD4"=>$f_issue_type_prod4,
//            "F_BIGO4"=>$f_bigo4
//        );
//        DB::table('t_bill')
//            ->updateOrInsert(
//                $wheres,
//                $param
//            );
//        DB::commit();
//        return redirect()->route('chargeMemberRegist');

    }


}


//

//
//"F_BILLID" => $f_billid
//"F_OSP" => $f_osp
//"F_ADMIN" => $f_admin
//"F_PAY_TYPE" => $f_pay_type
//"F_PAY_INTERVAL" => $f_pay_interval
//"F_BIZID" => $f_bizid
//"F_BIZNAME" => $f_bizname
//"F_LOGINID" => $f_loginid
//"F_SHOPID" => $f_shopid
//"F_SHOPNAME" => $f_shopname
//"F_TAX_TYPE" => $f_tax_type
//"F_ASSO" => $f_asso
//"F_STATUS" => $f_status
//"F_NAME1" => $f_name1
//"F_MOBILE1" => $f_mobile1
//"F_EMAIL1" => $f_email1
//"F_NAME2" => $f_name2
//"F_MOBILE2" => $f_mobile2
//"F_EMAIL2" => $f_email2
//"F_HISTORY" => $f_history
//"F_REPLY" => $f_reply
//"F_STATEMENT" => $f_statement
//"F_TAX_BILL" => $f_tax_bill
//"F_ISSUEDATE" => $f_issuedate
//"F_ETC" => $f_etc
//"F_REGISTRATION_NUMBER" => $f_registration_number
//"F_MINOR_BUSINESS" => $f_minor_business
//"F_CP_NAME" => $f_cp_name
//"F_REP_NAME" => $f_rep_name
//"F_ADDR" => $f_addr
//"F_BUSINESS" => $f_business
//"F_EVENT" => $f_event
//"F_PUBLIC_ADDR1" => $f_public_addr1
//"F_PUBLIC_ADDR2" => $f_public_addr2
//"F_PRICE" => $f_price
//"F_TAX" => $f_tax
//"F_BIGO" => $f_bigo
//"F_DAY1" => $f_day1
//"F_PRODUCT1" => $f_product1
//"F_STANDARD1" => $f_standard1
//"F_UNITPRICE1" => $f_unitprice1
//"F_COUNT1" => $f_count1
//"F_PRICE1" => $f_price1
//"F_TAX1" => $f_tax1
//"F_BIGO1" => $f_bigo1
//"F_DAY2" => $f_day2
//"F_PRODUCT2" => $f_product2
//"F_STANDARD2" => $f_standard2
//"F_UNITPRICE2" => $f_unitprice2
//"F_COUNT2" => $f_count2
//"F_PRICE2" => $f_price2
//"F_TAX2" => $f_tax2
//"F_BIGO2" => $f_bigo2
//"F_DAY3" => $f_day3
//"F_PRODUCT3" => $f_product3
//"F_STANDARD3" => $f_standard3
//"F_UNITPRICE3" => $f_unitprice3
//"F_COUNT3" => $f_count3
//"F_PRICE3" => $f_price3
//"F_TAX3" => $f_tax3
//"F_BIGO3" => $f_bigo3
//"F_DAY4" => $f_day4
//"F_PRODUCT4" => $f_product4
//"F_STANDARD4" => $f_standard4
//"F_UNITPRICE4" => $f_unitprice4
//"F_COUNT4" => $f_count4
//"F_PRICE4" => $f_price4
//"F_TAX4" => $f_tax4
//"F_BIGO4" => $f_bigo4
//"F_ISSUE_TYPE" => $f_issue_type
//"F_ETC01" => $f_etc01
//"F_ETC02" => $f_etc02
//"F_ETC03" => $f_etc03
//"F_ETC04" => $f_etc04
//"F_ETC05" => $f_etc05
//"F_ETC06" => $f_etc06
//"F_ETC07" => $f_etc07
//"F_ETC08" => $f_etc08
//"F_ETC09" => $f_etc09
//"F_ETC10" => $f_etc10
//"F_REGID" => $f_regid
//"F_REGDATE" => $f_regdate
//"F_EDITID" => $f_editid
//"F_EDITDATE" => $f_editdate
