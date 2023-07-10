<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BRClient extends Model {
    use HasFactory;
    private static $mysql_table = "nctViewCompanyClient";

    public static function list($wheres="", $bindings=[]) {
        $query = "select *
                    from ".self::$mysql_table."
                        where client_id is not null
                            {$wheres}
                            limit 10";
        return DB::connection('br')->select($query, $bindings);
    }

    public static function findByClientId($client_id, $group_site) {
        $query = "select *
                    from ".self::$mysql_table."
                        where client_id = :client_id and group_site = :group_site";
        return DB::connection('br')->select($query, ['client_id'=>$client_id, 'group_site'=>$group_site]);
    }
}
