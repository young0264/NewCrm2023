<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bill_PF_NEY extends Model{

    use HasFactory;

    private static $use_table = "T_BILL_PF_NEY";

    public static function insertBill($parameters) {
        return DB::table('T_BILL_PF_NEY')->insert($parameters);
    }

    public static function findBillById($loginId){
        $query = "SELECT * FROM ".self::$use_table." WHERE f_loginid=:f_loginid";
        return DB::select($query, array("f_loginid"=>$loginId));
    }

    public static function updateBill(array $parameter, array $wheres)
    {
        return DB::table(self::$use_table)
            ->where($wheres)
            ->update($parameter);
    }


}
