<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bill_TAX_NEY extends Model{

    use HasFactory;

    private static $use_table = "T_BILL_TAX_NEY";


//    public static function list($wheres="", $params) {
//
//        $query = "select * from (
//                    select
//                        f_loginid, f_tax_issue, f_pf_price, f_pyung, f_village, f_issuedate
//
//                    from ".self::$use_table."
//                        where f_loginid is not null
//                        {$wheres}
//                    order by f_issuedate desc) where rownum <= 10";
//
//        return DB::select($query, $params);
//    }

    public static function insertBill($parameters) {
        return DB::table('T_BILL_TAX_NEY')->insert($parameters);
    }
}
