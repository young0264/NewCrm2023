<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Bill_NEY;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class BillController extends BaseController
{
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

    public static function list(Request $request){

        $wheres = "and f_admin='BR'";
        $params = [];

        $items = Bill::list($wheres, $params);

        $headers = array();
        foreach ($items as $key => $item) {
            if ($key > 0)
                break;

            foreach ($item as $header => $i) {
                if ($header == "f_billid"
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
                $headers[] = array("key" => $header, "name" => Bill::$column[strtoupper($header)]);
            }
        }

        return response()->json(
            [
                "status" => "ok",
                "result" => array(
                    "header" => json_encode($headers),
                    "items" => json_encode($items)
                )
            ]);
    }

    public static function listByNEY(Request $request){

        $wheres = "";
        $params = [];

        $items = Bill_NEY::list($wheres, $params);
        $headers = array();

        foreach ($items as $key => $item) {
            if ($key > 0)
                break;
            foreach ($item as $header => $i) {
                if ($header == "f_billid"
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
                    || $header == "f_unitprice1"
                    || $header == "f_unitprice2"
                    || $header == "f_unitprice3"
                    || $header == "f_unitprice4"
                    || $header == "f_issue_type"
                ) {
                    continue;
                }
                $headers[] = array("key" => $header, "name" => Bill::$column[strtoupper($header)]);
            }
        }

        return response()->json(
            [
                "status" => "ok",
                "result" => array(
                    "header" => json_encode($headers),
                    "items" => json_encode($items)
                )
            ]);
    }


    /**
     * @throws Exception
     */
    public static function BillFormUpdate(Request $request){

        try {
            // 수정할 데이터

            $parameters = json_decode($request->getContent(), true);
            // 검색할 데이터
            $wheres = array("f_billId"=>$parameters['f_billId']);
            unset($parameters['f_billId']);
            if (empty($parameters || $wheres)) {
                throw new Exception("수정에 실패하였습니다..");
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "msg" => $e->getMessage()
            ]);
        }

        if (!Bill_NEY::updateBill($parameters, $wheres)) {
            throw new Exception("수정시 에러가 발생했습니다. 입력값들을 확인해주세요.");
        }
    }

    public static function findBillById(Request $request){

        try {
            $items = Bill_NEY::findBillById($request->input('billId'));
            if(empty($items))
                throw new Exception("검색 결과가 없습니다.");
        } catch (Exception $e) {
            return response()->json([
                    "status" => "error",
                    "msg" => $e->getMessage()
                ]
            );
        }

        return response()->json(
            [
                "status" => "ok",
                "result" => [
                    "item" => json_encode($items)
                ]
            ]
        );
    }

    /**
     * Bill Create Porcess (계산서 등록)
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public static function billRegisterProcess(Request $request){

        $tax_type0306 = $request->input('tax_type0306') === 'on' ? 'on' : 'off';
        $tax_type01 = $request->input('tax_type01') === 'on' ? 'on' : 'off';
        $asso_array = array(
            "KOMCA" => "06",
            "FKMP" => "06",
            "KAPP" => "03",
            "KOSCAP" => "06"
        );

        /**
         * 기본 데이터 파라미터 셋팅(공연권료와 이용료 분할을 제외한)
         */
        $basic_info_param = array(
            "F_SHOPNAME" => $request->input('f_shopname'),
            "F_CB" => $request->input('f_cb'),
            "F_BUSINESS" => $request->input('f_business'),
            "F_CP_NAME" => $request->input('f_cp_name'),
            "F_NAME1" => $request->input('f_name1'),
            "F_PAY_TYPE" => $request->input('f_pay_type'),
            "F_REP_NAME" => $request->input('f_rep_name'),
            "F_MOBILE1" => $request->input('f_mobile1'),
            "F_PAY_INTERVAL" => $request->input('f_pay_interval'),
            "F_REGISTRATION_NUMBER" => $request->input('f_registration_number'),
            "F_EMAIL1" => $request->input('f_email1'),
            "F_HISTORY" => $request->input('f_history'),
            "F_ADDR" =>  $request->input('f_addr'),
            "F_NAME2" =>  $request->input('f_name2'),
            "F_REPLY" => $request->input('f_reply'),
            "F_PUBLIC_ADDR1" => $request->input('f_public_addr1'),
            "F_MOBILE2" =>  $request->input('f_mobile2'),
            "F_STATEMENT" =>  $request->input('f_statement'),
            "F_PUBLIC_ADDR2" =>  $request->input('f_public_addr2'),
            "F_EMAIL2" => $request->input('f_email2'),
            "F_TAX_BILL" => $request->input('f_tax_bill')
        );

        try {
            DB::beginTransaction();
            $results = self::registBillForm($tax_type01, $basic_info_param, $request, $tax_type0306, $asso_array);

            if (empty($results)) {
                throw new Exception("등록할 계산서가 없습니다. 계산서를 등록해주세요.");
            }

            foreach ($results as $key=>$result) {
                if(empty($result)){
                    throw new Exception(sprintf("%s번째 계산서 등록에 실패하였습니다.", $key));
                }
                Bill_NEY::insertBill($result);
            }

            DB::commit();
            return redirect()->route('chargeMemberRegist');

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                "status"=>$e->getCode(),
                "msg"=>$e->getMessage()
            ]);
        }
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
    private static function registOf01(string $tax_type01, array $basic_info_param, Request $request): array{
        $results = array();
        if ($tax_type01 === "on") {
            for ($i = 1; $i <= 4; $i++) {
                $params = $basic_info_param;
                if (!empty($_POST['f_product' . $i])) {
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
     *      off -> 동작 X (checkbox가 off이면 해당 <div> -> style.display="none")     * @param string $tax_type0306
     * @param array $asso_array
     * @param array $basic_info_param
     * @param Request $request
     * @return array
     */
    private static function registOf0306(string $tax_type0306, array $asso_array, array $basic_info_param, Request $request): array
    {
        $results = array();
        if ($tax_type0306 == "on") {
            foreach ($asso_array as $key => $val) {
                $params = $basic_info_param;
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

    /**
     * 01(일반), 0306(공연,위수탁) 계산서 등록
     * @param string $tax_type01
     * @param array $basic_info_param
     * @param Request $request
     * @param string $tax_type0306
     * @param array $asso_array
     * @return array|null
     * @throws Exception
     */
    private static function registBillForm(string $tax_type01, array $basic_info_param, Request $request, string $tax_type0306, array $asso_array): ?array
    {
        /**
         * [ 이용료 분할 / (세금)계산서 (일반) ] 01 ] --> on일때(각 row insert), off일때(1개 row) 등록 할  array 라턴
         */
        $results1 = self::registOf01($tax_type01, $basic_info_param, $request);

        /**
         * [공연권료 / (세금)계산서 (위수탁)] 03 06 ] --> on일떄(각 row insert), off(동작 x) 등록할  array 리턴
         */
        $results2 = self::registOf0306($tax_type0306, $asso_array, $basic_info_param, $request);

        return array_merge($results1, $results2);
    }
}
