<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BRClient extends Model {
    use HasFactory;
    private static $oracle_table = "t_shop";
    private static $mysql_table = "nctViewCompanyClient";

    public static function list($wheres="", $bindings=[]) {

        $query = "select * from nctViewCompanyClient
                    where client_id is not null
                    {$wheres}
                    limit 10";

        return DB::connection('br')->select($query, $bindings);
    }
}
