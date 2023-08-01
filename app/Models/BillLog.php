<?php
namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BillLog extends Model{
    use HasFactory;

    public static function createLog($params) {
        try {
            DB::table("T_BILL_LOG")->insert($params);
        } catch (Exception $e) {
            DB::rollBack();
            print_r($e->getMessage());
            throw new Exception("Bill Log 등록에 실패하였습니다.");
            return false;
        }
        return true;
    }

}
