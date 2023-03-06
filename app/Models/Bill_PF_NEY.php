<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bill_PF_NEY extends Model{

    use HasFactory;

    private static $t_table = "T_BILL_PF_NEY";

    public static function isPresentId($f_loginid) {
        $query = "SELECT COUNT(*) AS CNT FROM T_BILL_PF_NEY WHERE f_loginid=:f_loginid";
        $result = DB::select($query, array("f_loginid"=>$f_loginid));
        return $result[0]->cnt;
    }
    public static function insertBill($params) {
        try {
            DB::table(self::$t_table)->insert($params);
        } catch (Exception $e) {
            DB::rollBack();
            print_r($e->getMessage());
            throw new Exception("PF계산서 등록에 실패하였습니다.");
        }
    }

    public static function findBillByLoginId($loginId){
        $query = "SELECT * FROM T_BILL_PF_NEY WHERE f_loginid=:f_loginid";
        return DB::select($query, array("f_loginid"=>$loginId));
    }

    public static function updateBill(array $params, $wheres) {
        try {
            DB::table(self::$t_table)->where($wheres)->update($params);
        } catch (Exception $e) {
            DB::rollBack();
            print_r($e->getMessage());
            throw new Exception("PF계산서 수정에 실패하였습니다.");
        }
    }

}
