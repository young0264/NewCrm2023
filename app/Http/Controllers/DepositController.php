<?php

namespace App\Http\Controllers;
//use Deposit;
//use App\Models\Deposit;
use App\Models\Deposit;
use App\Helpers\File;
use App\Imports\SampleImport;
use App\Models\Deposit_File;
use DateTime;
use App\Exports\DepositExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DepositController extends Controller {

    public static function history(Request $request){

        $years = array();
        for ($i=date('Y'); $i>2018; $i--) {
            $years[] = $i;
        }

        $query = "
                SELECT *
                    FROM T_DEPOSIT_FILE
                        WHERE extract(year from F_CREATED_AT) = :year
                            ORDER BY F_FILEID DESC";

        $binds = [
            'year' => $request->input("sch_year"),
        ];

        $history_res = array();
        $items = DB::select($query, $binds);

        $cnt = 0;

        foreach($items as $item){

            $pay_system = mb_substr($item->f_pay_system, 0, 1);
            $date = new DateTime($item->f_created_at);
            $month = ($date->format('m'));
            $day_time = ($date->format('d일 H:i:s'));

//            xxxxxxxxxxx
//            echo Storage::disk("public")->url("/temp/20230519/20230519_ef791b9c17359f1521a9bb9237ac566e.csv");

            if (!empty($history_res[$month]) &&  count($history_res[$month]) > 2) {
                continue;
            }

            $history_res[$month][] = array(
                "fileid"=>$item->f_fileid,
                "pay_system"=>$pay_system,
                "month"=>$month,
                "day_time"=>$day_time,
                "filepath"=>$item->f_path
            );

        }
        return view('deposit.depositHistory', ['history_res'=>$history_res, "years"=>$years]);
    }

    public static function match1(){
        return view('deposit.depositMatching');
    }
    public static function match2(){
        return view('deposit.depositMatching2');
    }

    public static function list(Request $request){
        $mode = $request->input("mode");
        $sch_year = $request->input("sch_year");
        $sch_month = $request->input("sch_month");
        $sch_day = $request->input("sch_day");
        $sch_cols = $request->input("sch_cols");
        $sch_val = $request->input("sch_val");
        $f_account = $request->input("f_account");
        $where = "where f_depositid is not null";


        if (!empty($sch_year)) {
            $where .= " and EXTRACT(YEAR FROM TO_DATE(f_trans_date)) = '".$sch_year."'";
        }
        if (!empty($sch_month)) {
            $where .= " and EXTRACT(MONTH FROM TO_DATE(f_trans_date)) = '".$sch_month."'";
        }
        if (!empty($sch_day)) {
            $where .= " and EXTRACT(DAY FROM TO_DATE(f_trans_date)) = '".$sch_day."'";
        }
        if (!empty($f_account) && $f_account!="account_all") {
            $where .= " and f_account = '".$f_account."'";
        }
        else if($f_account=="account_all"){
            $where .= " and (f_account = '592201-01-513261' or f_account = '140-009-167369')";
        }

        if (!empty($sch_cols) && $sch_cols!="sch_all") {
            $where .= " and $sch_cols like '%".$sch_val."%'";
        }
        if( $sch_cols=="sch_all" && !empty($sch_val)){
            $where .= " and (f_company like '%".$sch_val."%'
            or f_bank like '%".$sch_val."%'
            or f_client like '%".$sch_val."%'
            or f_payment like '%".$sch_val."%'
            or f_trans_type like '%".$sch_val."%'
            or f_trade_branch like '%".$sch_val."%'
            or f_user like '%".$sch_val."%')";
        }

//        검색 데이터 가져오기
        $currentPage =  $request->input('page') ?? 1;
        $paged_data = Deposit::list($where, [], $currentPage);

        if ($mode === "excel") {
            $headers = ['기업명', ' 은행', '계좌', '거래일자', '의뢰인', '입금액', '거래구분', '거래점', '작성자'];
            $filename = sprintf("%s_입금내역_%s.xlsx", date('Ymd'), time());
            return Excel::download(new DepositExport($headers, $where), $filename);
        } else {
            return view('deposit.depositSearch',[
                'depositList' => $paged_data['depositList'],
                'currentPage' => $currentPage,
                'start_page' => $paged_data['start_page'],
                'end_page' => $paged_data['end_page'],
                'max_page' => $paged_data['max_page'],
            ]);
        }
    }


    /**
     * 파일 업로드 기능 처리
     * /app/Helpers/File.php
     * 엑셀에서 데이터 가져오기 (엑셀 설명서)
     *  https://freeblogger.tistory.com/15
     * $path = "/temp/20230411/20230411_eb6076be29e795cb3a09deaedd415dc8.xlsx";
     * $path =  <pre> /temp/20230517/20230517_48bbf1ac710bc4d886e59424acaedb50.csv
     */
    public static function save(Request $request): \Illuminate\Http\JsonResponse{
        DB::beginTransaction();
        $file_info = File::upload($request->file("file"), "temp");
//        $path = $request->file("file")->store('path');
        $f_pay_system = $request->input('f_pay_system');
        $file_param = [
            'F_NAME' => $file_info['name'],
            'F_PATH' => $file_info['path'],
            'F_SIZE' => $file_info['size'],
            'F_EXT' => $file_info['ext'],
            "F_PAY_SYSTEM"=>$f_pay_system,
            'F_USER' => Auth::user()->id,
        ];

        $fileId = Deposit_File::saveFile($file_param);

        $items = Excel::toArray(new SampleImport, Storage::disk('public')->path($file_info['path']))[0];

        $results = array();
        foreach ($items as $key=>$item) {
            if ($key > 0) {
                $results[] = array(
                    'F_COMPANY'=>$item[0],
                    'F_BANK'=>$item[1],
                    'F_ACCOUNT'=>$item[2],
                    'F_TRANS_DATE'=>$item[3],
                    'F_CLIENT'=>$item[4],
                    'F_PAYMENT'=>$item[5],
                    'F_TRANS_TYPE'=>$item[6],
                    'F_TRADE_BRANCH'=>$item[7],
                    "F_USER"=>Auth::user()->id,
                    "F_PAY_SYSTEM"=>$f_pay_system,
                    "F_FILEID"=>$fileId
                );
            }
        }

        Deposit::saveDeposit($results);
        DB::commit();
        return response()->json(
            [
                "status"=>"ok",
                "results"=>$results,
            ]
        );
    }

    public static function download(Request $request){
        $item = Deposit_File::getOne($request->input("f_depositid"));

        if (Storage::disk("public")->exists($item->f_path)) {
            return response()->download(Storage::disk("public")->path($item->f_path));
        } else {
            abort(404, 'File not found');
        }
    }
}
