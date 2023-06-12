<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Bill_NEY;
use App\Models\Bill_PF_NEY;
use App\Service\BillService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected BillService $billService;
    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
    }

    public function ttt()
    {
        $testArr = $this->billService->returnTest();
        return $testArr;
    }

    public function list(Request $request){

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

    public function listByNEY(Request $request){
        $result = $this->billService->makeSearchConditions($request);
        $items = Bill_NEY::list($result["wheres"], $result['binds']);

        return response()->json(
            [
                "status" => "ok",
                "result" => array(
                    "items" => json_encode($items)
                )
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function BillFormUpdate(Request $request){

        $result = $this->billService->billUpdate($request);

        if (!$result['status']) {
            return response()->json([
                "status" => "error",
                "msg" => $result['msg']
            ]);
        }
        return response()->json([
            "status" => "ok",
            "msg" => "정상적으로 수정되었습니다."
        ]);

    }

    /**
     * @param Request $request
     * $bill_items : bill table정보,
     * $bill_pf_items : bill_pf table 공연 정보
     * @return JsonResponse
     */
    public function findBillById(Request $request){
        try {
            $items = $this->billService->findBillById($request);

            return response()->json([
                "status" => "ok",
                "result" => [
                    "item" => json_encode($items)
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                    "status" => "error",
                    "msg" => $e->getMessage(),
                ]
            );
        }
    }

    /**
     * Bill Create Porcess (계산서 등록)
     * @param Request $request
     * @return JsonResponse
     */
    public function billRegisterProcess(Request $request){

        try {
            $this->billService->billCreate($request);

            return response()->json([
                "status"=>"ok",
                "msg"=>"계산서 등록이 완료되었습니다."
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                "status"=>$e->getCode(),
                "msg"=>$e->getMessage()
            ]);
        }
    }

    public static function issue()
    {
        return view("bill.billIssueView");
    }
    public static function issuePage()
    {
        return view("bill.billIssuePage");
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


}
