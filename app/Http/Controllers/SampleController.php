<?php

namespace App\Http\Controllers;

use App\Exports\SampleExport;
use App\Helpers\Common;
use App\Helpers\File;
use App\Helpers\Pagination;
use App\Imports\SampleImport;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Mointeng\SQLRelay\Connectors\OracleConnector;

class SampleController extends Controller
{
    //
    public static function connection() {
//        $query = "select * from tab where tname=:tname order by tname";
//        $parameters = array(
//            "tname"=>"MIGRATIONS"
//        );

        $search = false;
        $wheres = "";
        $parameters = array();
        if ($search) {
            $wheres = " and id=:id";
            $parameters = array(
                "id"=>"1"
            );
        }

        $query = "select * from t_users
                    where id is not null
                    {$wheres}
                    order by id";

        $items = DB::select($query, $parameters);

        return view('sample.connection', [
            'items'=>$items
        ]);
    }

    public static function import() {
        return view('sample.excelImport', [
        ]);
    }

    public static function importProcess(Request $request) {

        /**
         * 파일 업로드 기능 처리
         * /app/Helpers/File.php
         *
         */
        $results = File::upload($request->file("file"), "temp");
        /**
         * 엑셀에서 데이터 가져오기
         *  https://freeblogger.tistory.com/15
         * (엑셀 설명서)
         */
        $path = $results['path'];
//        $path = "/temp/20230411/20230411_eb6076be29e795cb3a09deaedd415dc8.xlsx";

        // Collection 사용 방법
        $items = Excel::toArray(new SampleImport, Storage::disk('public')->path($path))[0];
        $results = array();

        foreach ($items as $num=>$item) {
            if ($num == 0) $headers = $item;

            if ($num == 0 || $num > 10) continue;

            $results[] = $item;
        }
        return response()->json(
            [
                "status"=>"ok",
                "results"=>$results,
                "headers"=>$headers
            ]
        );
    }

    public static function exportProcess(Request $request) {

        $data = [
            ['one', 'name', 'a', 'b'],
            ['two', 'family', 'c', 'd']
        ];

        $header = array(
            "a",
            "b",
            "c",
            "d",
        );
        return Excel::download(new SampleExport($header, $data), "users.xlsx");
    }

    public static function dataTables(Request $request) {
        $query = "select
                        f_billid,
                        f_bizname,
                        f_shopname,
                        -- Tab1
                        f_price,
                        f_pay_type,
                        f_pay_interval,
                        f_history,
                        f_reply,
                        f_statement,
                        f_tax_bill,
                        f_issuedate,
                        -- Tab2
                        f_registration_number,
                        f_minor_business,
                        f_cp_name,
                        f_rep_name,
                        f_addr,
                        f_business,
                        f_event,
                        f_public_addr1,
                        f_public_addr2,
                        -- Tab3
                        f_name1,
                        f_mobile1,
                        f_email1,
                        f_name2,
                        f_mobile2,
                        f_email2
                    from t_bill
                    order by f_billid asc";

        $items = DB::select($query, []);
        $headers = array();
        foreach ($items as $key=>$item) {
            if ($key > 0)
                break;

            $num = 0;
            foreach ($item as $header=>$i) {
                if($header == "f_billid"
                    || $header == "f_shopid"
                    || $header == "f_shopid"
                    || $header == "f_perform_type"
                    || $header == "f_contract_yn"
                    || $header == "f_status"
                ) {
                    continue;
                }
                $headers[] = $header;
                $num++;
            }
        }

        return view('sample.datatables', [
            "headers"=>json_encode($headers),
            "items"=>json_encode($items)
        ]);
    }

    public static function dataTablesOracle(Request $request) {


        return view('sample.datatablesOra', [

        ]);
    }

    public static function sqlrelay() {


//        $aa = DB::connection("sqlrelay");
//        print_r($aa);
//        exit;
//
//
//        $user = "NSC";
//        $pass = "SR-NSC1234";
//
//
//        $con  = new \PDO("sqlrelay:host=localhost;port=9903;tries=1;retrytime=1;debug=0", $user, $pass);
//        if (!$con) {
//            die("connection failed");
//        }
//        $stmt = $con->query("select * from tab");
//        while($row=$stmt->fetch(\PDO::FETCH_BOTH)){
//            echo "Result  data value:"  .$row[0] ."\n";
//        }


//        $con = sqlrcon_alloc("localhost", 9903, "", "NSC", "SR-NSC1234", 0, 1);
//        $cur = sqlrcur_alloc($con);
//        echo "con:" .$con  ." cur:"  .$cur  ."\n";
//
//        if(!sqlrcur_sendQuery($cur, "select * from tab")) {
//            echo sqlrcur_errorMessage($cur);
//            echo "\n";
//        }
//
//        for($row=0; $row<sqlrcur_rowCount($cur); $row++) {
//            for($col=0; $col<sqlrcur_colCount($cur); $col++) {
//                echo sqlrcur_getField($cur,$row,$col);
//                echo ",";
//            }
//            echo "\n";
//        }
//
//
//        sqlrcon_endSession($con);
//        sqlrcur_free($cur);
//        sqlrcon_free($con);



        $config = array(
            "host"=>"localhost",
            "port"=>9903,
            "username"=>"NSC",
            "password"=>"SR-NSC1234"
        );


        $aa = \Mointeng\SQLRelay\Connectors\OracleConnector::connect($config);
//        print_r($aa);
//        exit;
//
//
//        print_r($aa);

//        $relay = new OracleConnector($config);
//        echo '<pre>';
//        print_r($relay);
//        exit;
    }
}

