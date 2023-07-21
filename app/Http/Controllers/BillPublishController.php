<?php
namespace App\Http\Controllers;
use App\Models\Bill;
use App\Models\Bill_NEY;
use App\Models\BillPublishNEY;
use App\Service\BillPublishService;
use App\Service\BillService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class BillPublishController extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected BillPublishService $billPublishService;

    public function __construct(BillPublishService $billPublishService){
        $this->billPublishService = $billPublishService;
    }

    public function list(Request $request){

        $result = $this->billPublishService->makeSearchConditions($request);
        $items = BillPublishNEY::list($result["wheres"], $result['binds']);
        $headers = array();

        $publishHeaders = array_flip(["f_id", "f_billid", "f_bizid", "f_shopid", "f_status", "f_standard1", "f_standard2", "f_standard3", "f_standard4",
            "f_count1", "f_count2", "f_count3", "f_count4", "f_tax1", "f_tax2", "f_tax3", "f_tax4", "f_bigo1", "f_bigo2", "f_bigo3", "f_bigo4",
            "f_day1", "f_day2", "f_day3", "f_day4", "f_unitprice1", "f_unitprice2", "f_unitprice3", "f_unitprice4", "f_issue_type", "f_tax", "f_loginid"]);

        foreach ($items as $key => $item) {
            if ($key > 0)
                break;
            foreach ($item as $header => $value) {
                if (! isset($publishHeaders[$header])) {
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

    public function update(Request $request){
        $result = $this->billPublishService->billMultiUpdate($request->input());
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

}