<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Deposit_File extends Model
{

    use HasFactory;

    private static $use_table = "T_DEPOSIT_FILE";

    public static function saveFile(array $results)
    {
        $file_id = DB::getSequence()->nextValue('T_DEPOSIT_FILE_SEQ');
        $results['F_FILEID'] = $file_id;
        DB::table('T_DEPOSIT_FILE')->insert($results);

        return $file_id;
    }

    public static function getOne($fileid) {
        $binds = array("f_fileid"=>$fileid);
        $query = "select * from t_deposit_file where f_fileid=:f_fileid";
        return DB::select($query, $binds)[0];
    }

}
