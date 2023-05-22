<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Deposit extends Model {

    use HasFactory;
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'user_id',
        'amount',
        'created_at',
        'updated_at',
    ];



    public static function saveDeposit($params){
        return DB::table('T_DEPOSIT')->insert($params);
    }

    public static function list($where, $params)
    {
        $query = "select * from t_deposit
                      {$where}
                          order by f_depositid desc";

        return DB::select($query, $params);
//        return DB::table('T_DEPOSIT')->paginate(10);
//        return DB::table('T_DEPOSIT')->get();
    }

}
