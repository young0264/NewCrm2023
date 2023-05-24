<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Deposit extends Model {

    use HasFactory;
    protected $table = 'T_DEPOSIT';
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

    public static function list($where, $params, $page)
    {
        $query = "select * from t_deposit
                      {$where}
                          order by f_depositid desc";
        $depositList = DB::select($query, $params);

        $total_data_cnt = count($depositList);
        $max_page = ceil($total_data_cnt / 10);

        $start_page = max(1, $page-2);
        $end_page = min($max_page, $page+2);

        $paged_depositList = self::pagination($query, $page, $total_data_cnt);

        $result = [
            'depositList' => $paged_depositList,
            'start_page' => $start_page,
            'end_page' => $end_page,
            'max_page' => $max_page
        ];
        return $result;
    }

    public static function pagination($query, $page, $total_data_cnt){

        // == 페이징 == //
        $PAGE_SIZE = 10;
        $skip_page = ($page - 1) * $PAGE_SIZE;

        $query = "select * from
            (select t.*, ROWNUM AS rn from
                         (select *
                          from (select *
                                from ($query)
                                where f_depositid is not null
                                order by f_depositid desc
                                )
                          where rownum <= ($skip_page+$PAGE_SIZE)
                          ) t
                                      )
         where rn > $skip_page
         order by f_depositid desc
         fetch first $PAGE_SIZE rows only";

        return DB::select($query,[]);
    }

    public static function excelList($where, $params, $cols){
        $query = "select {$cols} from t_deposit
                      {$where}
                          order by f_depositid desc";

        return DB::select($query, $params);
    }
}
