<?php
namespace App\Service;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class LogService {

    public function makeLogParams($f_billid, $f_tableName, $f_action) {
        DB::beginTransaction();
        $params = array();
        $params["f_billid"] = $f_billid;
        $params["f_table_name"] = $f_tableName;
        $params["f_action"] = $f_action;
        $params["f_loginid"] = Auth::user()->email;
        DB::commit();
        return $params;
    }

}
