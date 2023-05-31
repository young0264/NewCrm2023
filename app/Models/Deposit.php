<?php

namespace App\Models;

use App\Helpers\Pagination;
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

    public static function list($where, $params, $currentPage)
    {
        $query = "select * from t_deposit {$where} order by f_depositid desc";
        $count_query = "select count(*) from t_deposit {$where}";
        $total_data_cnt = DB::select($count_query, $params)[0]->{'count(*)'};

        $paged_data = Pagination::paginate($query, $total_data_cnt, $currentPage, 10 ,10);
        $paged_depositList = DB::select($paged_data['paged_query'], []);

        return [
            'paged_depositList' => $paged_depositList,
            'start_page' => $paged_data['start_page'],
            'end_page' => $paged_data['end_page'],
            'max_page' => $paged_data['max_page'],
            'page_gap' => $paged_data['page_gap']
        ];
    }

    public static function pagination($query, $currentPage){

        // == 페이징 == //
        $rowsPerPage = 10;
        $skip_page = ($currentPage - 1) * $rowsPerPage;

        $query = "select * from
            (select t.*, ROWNUM AS rn from
                         (select *
                          from (select *
                                from ($query)
                                where f_depositid is not null
                                order by f_depositid desc
                                )
                          where rownum <= ($skip_page+$rowsPerPage)
                          ) t
                                      )
         where rn > $skip_page
         order by f_depositid desc
         fetch first $rowsPerPage rows only";

        return DB::select($query,[]);
    }

    public static function excelList($where, $params, $cols){
        $query = "select {$cols} from t_deposit
                      {$where}
                          order by f_depositid desc";
        return DB::select($query, $params);
    }
}
