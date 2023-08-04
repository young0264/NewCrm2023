<?php
namespace App\Service;

use App\Models\BillLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class LogService {

    public function makeBillLogParams($f_billId, $f_tableName, $f_action) {
        DB::beginTransaction();
        $params = array();
        $params["f_billId"] = $f_billId;
        $params["f_table_name"] = $f_tableName;
        $params["f_action"] = $f_action;
        $params["f_loginid"] = Auth::user()->email;
        DB::commit();
        return $params;
    }

    public function makePublishLogParams($publishId, $f_tableName, $f_action) {
        DB::beginTransaction();
        $params = array();
        $params["f_publishId"] = $publishId;
        $params["f_table_name"] = $f_tableName;
        $params["f_action"] = $f_action;
        $params["f_loginid"] = Auth::user()->email;
        DB::commit();
        return $params;
    }
    public function createPublishLog($publishIdArr) {
        $params = array();
        foreach ($publishIdArr as $key => $publishId) {
            $param = $this->makePublishLogParams($publishId, "T_BILL_NEW_PUBLISH", "U");
            $params[] = $param;
        }
//        echo "<pre>";
//        print_r($params);
//        exit;
        return BillLog::createLog($params);
    }

}
