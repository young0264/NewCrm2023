<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class SCShop extends Model{
    use HasFactory;

    public static function list($wheres='', $bindings=[]) {

        $query = "select * from (
                        select
                            (select f_shopname from t_shop where f_shopid = t1.f_bizid) as f_bizname,
                            t1.*
                        from t_shop t1
                    )
                    where f_shopid is not null
                    {$wheres}
                    and rownum < 10";

        return DB::connection('sc')->select($query, $bindings);
    }
}
