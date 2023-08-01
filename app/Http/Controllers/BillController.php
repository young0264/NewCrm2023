<?php

namespace App\Http\Controllers;
use App\Models\Bill;
use App\Models\Bill_NEY;
use App\Service\BillService;
use App\Service\LogService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillController extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected BillService $billService;
    protected LogService $logService;

    public function __construct(BillService $billService, LogService $logService){
        $this->billService = $billService;
        $this->logService = $logService;
    }

    public function list(Request $request){
        $params = [];
        $headers = array();
        $wheres = "and f_admin='BR'";
        $notContainedHeader = array_flip(["f_billid", "f_bizid", "f_shopid", "f_status", "f_standard1", "f_standard2", "f_standard3", "f_standard4",
            "f_count1", "f_count2", "f_count3", "f_count4", "f_tax1", "f_tax2", "f_tax3", "f_tax4", "f_bigo1", "f_bigo2", "f_bigo3", "f_bigo4",
            "f_day1", "f_day2", "f_day3", "f_day4", "f_unitprice1", "f_unitprice2", "f_unitprice3", "f_unitprice4", "f_issue_type"]);

        $items = Bill::list($wheres, $params);

        foreach ($items as $key => $item) {
            if ($key > 0)
                break;

            foreach ($item as $header => $i) {
                if (! isset($notContainedHeader[$header])) {
                    $headers[] = array("key" => $header, "name" => Bill::$column[strtoupper($header)]);
                }
            }
        }
        return response()->json([
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
        $headers = array();
        $notContainedHeader = array_flip(["f_billid", "f_bizid", "f_shopid", "f_status", "f_standard1", "f_standard2", "f_standard3", "f_standard4",
            "f_count1", "f_count2", "f_count3", "f_count4", "f_tax1", "f_tax2", "f_tax3", "f_tax4", "f_bigo1", "f_bigo2", "f_bigo3", "f_bigo4",
            "f_day1", "f_day2", "f_day3", "f_day4", "f_unitprice1", "f_unitprice2", "f_unitprice3", "f_unitprice4", "f_issue_type", "f_tax", "f_loginid"]);

        foreach ($items as $key => $item) {
            if ($key > 0)
                break;
            foreach ($item as $header => $i) {
                if (! isset($notContainedHeader[$header])) {
                    $headers[] = array("key" => $header, "name" => Bill::$column[strtoupper($header)]);
                }
            }
        }
        return response()->json([
                "status" => "ok",
                "result" => array(
                    "header" => json_encode($headers),
                    "items" => json_encode($items)
                )
            ]
        );
    }

    /** bill 삭제 : N(삭제하지 않은 데이터), Y(삭제한데이터)
     * @throws Exception
     */
    public function billDelete(Request $request) {
        $log_params = $this->logService->makeLogParams($request->input('f_billId')[0],"Bill_NEY","D");
        if ($this->billService->billDelete($request->input(), $log_params )) {
            return response()->json([
                "status" => "ok",
                "msg" => "삭제되었습니다."
            ]);
        }
    }

    /**
     * bill 업데이트
     */
       public function billUpdate(Request $request){
           $log_params = $this->logService->makeLogParams($request->input('f_billId'),"Bill_NEY","U");
           $result = $this->billService->billSingleUpdate($request->input(), $log_params);
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
     * $bill_items : bill table정보,
     * $bill_pf_items : bill_pf table 공연 정보
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

    public static function issue(){
        return view("bill.billIssue");
    }

    public static function form(){
        return view("bill.billFormView");
    }

    public static function printForm(){
        return view("bill.printBillFormView");
    }

    public static function integrate(){
        return view("bill.integratedCollection");
    }

    public static function cashReceipt(){
        return view("bill.cashReceiptSearch");
    }

}
