<?php

namespace App\Http\Controllers;
use App\Models\Deposit;
use App\Helpers\File;
use App\Imports\SampleImport;
use App\Models\Deposit_File;
use App\Service\DepositService;
use DateTime;
use App\Exports\DepositExport;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse as JsonResponseAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DepositController extends Controller {

    protected DepositService $depositService;
    public function __construct(DepositService $depositService)
    {
        $this->depositService = $depositService;
    }


    /**
     * @param Request $request
     * @throws \Exception
     */
    public function showHistory(Request $request){

        try {
            $result = $this->depositService->getHistoryInfo($request);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "msg" => $e->getMessage()
            ]);
        }

        return view('deposit.depositHistory',
            ['history_result'=>$result["history_result"],
            "years"=>$result["years"]]
        );
    }


    public function list(Request $request){
        /**
         * $mode가 excel이면 download
         * 아니면 검색조건에 맞는 view
         */
        $mode = $request->input("mode");

        if ($mode === "excel") {
            $headers = ['기업명', ' 은행', '계좌', '거래일자', '의뢰인', '입금액', '거래구분', '거래점', '작성자'];
            $filename = sprintf("%s_입금내역_%s.xlsx", date('Ymd'), time());
            return Excel::download(new DepositExport($headers), $filename);
        }

        try {
            $result = $this->depositService->makeSearchConditions($request);
        } catch (Exception $e) {
            return
                response()->json(
                [
                    "status"=>"error",
                    "message"=>$e->getMessage(),
                ]
            );
        }

        $paged_data = $result["paged_data"];
        $currentPage = $result["currentPage"];

        return view('deposit.depositSearch',[
            'depositList' => $paged_data['paged_depositList'],
            'currentPage' => $currentPage,
            'start_page' => $paged_data['start_page'],
            'end_page' => $paged_data['end_page'],
            'max_page' => $paged_data['max_page'],
            'page_gap' => $paged_data['page_gap']
        ]);
    }

    /**
     * deposit 저장
     * 파일 업로드 기능 처리
     * /app/Helpers/File.php
     * 엑셀에서 데이터 가져오기 (엑셀 설명서)
     *  https://freeblogger.tistory.com/15
     * $path = "/temp/20230411/20230411_eb6076be29e795cb3a09deaedd415dc8.xlsx";
     * $path =  <pre> /temp/20230517/20230517_48bbf1ac710bc4d886e59424acaedb50.csv
     */
    public function fileUpload(Request $request): JsonResponseAlias
    {

        $results = $this->depositService->fileUpload($request);

        return response()->json(
            [
                "status"=>"ok",
                "results"=>$results,
            ]
        );
    }


    /**
     * 입금내역 등록 히스토리 다운로드
     */
    public function download(Request $request){

        try {
            $item = $this -> depositService -> findByDepositId($request->input("f_depositid"));
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "msg" => $e->getMessage()
            ]);
        }

        if (Storage::disk("public")->exists($item->f_path)) {
            return response()->download(Storage::disk("public")->path($item->f_path));
        } else {
            abort(404, 'File not found');
        }
    }

    public static function match1(){
        return view('deposit.depositMatching');
    }

    public static function match2(){
        return view('deposit.depositMatching2');
    }
}
