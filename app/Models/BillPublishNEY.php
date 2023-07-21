<?php
namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BillPublishNEY extends Model{
    use HasFactory;
    public static function list($wheres="", $params) {
        $query = "select
                    *
                    from
                        (
                        select
                            f_id, f_billid, f_bizname, f_shopname, f_price, f_tax,
                            f_pay_type, f_pay_interval, f_history, f_reply, f_statement, f_tax_bill, f_issuedate,
                            f_registration_number, f_minor_business, f_cp_name, f_rep_name, f_addr, f_business, f_event, f_public_addr1, f_public_addr2,
                            f_name1, f_mobile1, f_email1, f_name2, f_mobile2, f_email2,
                            f_product1, f_standard1, f_unitprice1, f_count1, f_price1, f_tax1, f_bigo1,
                            f_product2, f_standard2, f_unitprice2, f_count2, f_price2, f_tax2, f_bigo2,
                            f_product3, f_standard3, f_unitprice3, f_count3, f_price3, f_tax3, f_bigo3,
                            f_product4, f_standard4, f_unitprice4, f_count4, f_price4, f_tax4, f_bigo4,
                            f_issue_type, f_loginid
                            from T_BILL_NEY_PUBLISH
                                where f_id is not null
                                {$wheres}
                                    order by f_id desc
                        )
                        where rownum <= 50";
        return DB::select($query, $params);
    }

    public static function findBillById($billId){
        $query = "SELECT * FROM T_BILL_NEY_PUBLISH WHERE f_billid=:f_billid";
        return DB::select($query, array("f_billid"=>$billId));
    }

    public static function insertBillPublish($params,$dateStr){
        $f_ym = date('Ym');
        foreach ($params as $param) {
            $param['f_ym'] = $f_ym;
            DB::table('T_BILL_NEY_PUBLISH')->insert($param);
        }
        return DB::table('T_BILL_NEY_PUBLISH')->insert($params);
    }
    public static function updateBillPublish($parameters, $wheres){
        return DB::table('T_BILL_NEY_PUBLISH')
            ->whereIn('f_id', $wheres['f_id'])
            ->update($parameters);
    }

}
