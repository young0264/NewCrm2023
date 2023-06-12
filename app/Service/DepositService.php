<?php

namespace App\Service;
use App\Helpers\File;
use App\Imports\SampleImport;
use App\Models\Deposit;
use App\Models\Deposit_File;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DepositService
{


    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function getHistoryInfo(Request &$request)
    {
        $result = $this->getHistoryInfoByYear($request);
        $years = $result["years"];
        $historyList = $result["historyList"];
        $history_result = $this->getHistoryResult($historyList, []);

        return [
            "history_result" => $history_result,
            "years" => $years
        ];
    }

    /**
     * @param Request $request
     * @param $years
     * @param $historyList
     * @return void
     */
    private function getHistoryInfoByYear(Request &$request): array
    {

        $binds = [
            'year' => $request->input("sch_year"),
        ];

        $query = "
                SELECT *
                    FROM T_DEPOSIT_FILE
                        WHERE extract(year from F_CREATED_AT) = :year
                            ORDER BY F_FILEID DESC";

        $historyList = DB::select($query, $binds);
        $years = $this->circYearsToNow();

        return [
            "historyList" => $historyList,
            "years" => $years
        ];
    }

    /**
     * @return array
     */
    public function circYearsToNow(): array
    {
        $years = array();

        for ($i = date('Y'); $i > 2018; $i--) {
            $years[] = $i;
        }
        return $years;
    }

    /**
     * 검색조건 where절 생성
     * @param Request $request
     * @return array
     */
    public function makeSearchConditions(Request &$request)
    {
        $where = "where f_depositid is not null";

        $sch_year = $request->input("sch_year");
        $sch_month = $request->input("sch_month");
        $sch_day = $request->input("sch_day");
        $sch_cols = $request->input("sch_cols");
        $sch_val = $request->input("sch_val");
        $f_account = $request->input("f_account");

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
        $binds = array();
//        return Deposit::list($where, $binds, $currentPage);
        return [
            "currentPage" => $currentPage,
            "paged_data" => Deposit::list($where, $binds, $currentPage)
        ];
    }

    /**
     * deposit - history 데이터 가져오기
     * @param array $historyList
     * @param array $history_result
     * @return array
     * @throws \Exception
     */
    private function getHistoryResult(array &$historyList, array $history_result): array
    {
        foreach ($historyList as $item) {

            $pay_system = mb_substr($item->f_pay_system, 0, 1);
            $date = new DateTime($item->f_created_at);
            $month = ($date->format('m'));
            $day_time = ($date->format('d일 H:i:s'));

            //maximum 데이터 3개, 0부터시작 3개 초과시 continue
            if (!empty($history_result[$month]) && count($history_result[$month]) > 2) {
                continue;
            }

            $history_result[$month][] = array(
                "fileid" => $item->f_fileid,
                "pay_system" => $pay_system,
                "month" => $month,
                "day_time" => $day_time,
                "filepath" => $item->f_path
            );
        }
        return $history_result;
    }


    /**
     * deposit - 파일업로드
     * @param Request $request
     * @return bool
     */
    public function fileUpload(Request &$request)
    {
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
            $paymentToInt = intval(str_replace(',', '', $item[5]));
            if ($key > 0) {
                $results[] = array(
                    'F_COMPANY'=>$item[0],
                    'F_BANK'=>$item[1],
                    'F_ACCOUNT'=>$item[2],
                    'F_TRANS_DATE'=>$item[3],
                    'F_CLIENT'=>$item[4],
                    'F_PAYMENT'=>$paymentToInt,
                    'F_TRANS_TYPE'=>$item[6],
                    'F_TRADE_BRANCH'=>$item[7],
                    "F_USER"=>Auth::user()->id,
                    "F_PAY_SYSTEM"=>$f_pay_system,
                    "F_FILEID"=>$fileId
                );
            }
        }

        $result = Deposit::saveDeposit($results);
        DB::commit();
        return $result;
    }

    /**
     * id값으로 deposit row 가져오기
     * @param $f_depositid
     */
    public function findByDepositId($f_depositid)
    {
        return Deposit_File::getOne($f_depositid);
    }
}

?>
