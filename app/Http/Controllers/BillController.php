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
