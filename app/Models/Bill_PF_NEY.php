<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bill_PF_NEY extends Model{

    use HasFactory;

    private static $t_table = "T_BILL_PF_NEY";

    public static function insertBill($parameters) {
        try {
            DB::table('T_BILL_PF_NEY')->insert($parameters);
        } catch (Exception $e) {
            DB::rollBack();
//            throw new Exception($e->getMessage());
            throw new Exception("PF계산서 등록에 실패하였습니다.");
        }
    }

    public static function findBillById($loginId){
        $query = "SELECT * FROM ".self::$t_table." WHERE f_loginid=:f_loginid";
        return DB::select($query, array("f_loginid"=>$loginId));
    }

}
