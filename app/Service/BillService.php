<?php

use App\Models\Bill;

class BillService
{

    public function returnTest()
    {
        $a = "a";
        $b = "b";
        return [$a, $b];

    }
    public function getBillList()
    {
        $wheres = "and f_admin='BR'";
        $params = [];
        return Bill::list($wheres, $params);
    }

    public function getBillListHeaders($billList)
    {

        $headers = array();
        foreach ($billList as $key => $tableHeaders) {
            if ($key > 0)
                break;

            foreach ($tableHeaders as $header => $i) {
                if ($header == "f_billid"
                    || $header == "f_bizid"
                    || $header == "f_shopid"
                    || $header == "f_status"
                    || $header == "f_standard1"
                    || $header == "f_standard2"
                    || $header == "f_standard3"
                    || $header == "f_standard4"
                    || $header == "f_count1"
                    || $header == "f_count2"
                    || $header == "f_count3"
                    || $header == "f_count4"
                    || $header == "f_tax1"
                    || $header == "f_tax2"
                    || $header == "f_tax3"
                    || $header == "f_tax4"
                    || $header == "f_bigo1"
                    || $header == "f_bigo2"
                    || $header == "f_bigo3"
                    || $header == "f_bigo4"
                    || $header == "f_day1"
                    || $header == "f_day2"
                    || $header == "f_day3"
                    || $header == "f_day4"
                    || $header == "f_unitprice1"
                    || $header == "f_unitprice2"
                    || $header == "f_unitprice3"
                    || $header == "f_unitprice4"
                    || $header == "f_issue_type") {
                    continue;
                }
                return array("key" => $header, "name" => Bill::$column[strtoupper($header)]);

            }
        }
    }
}



//    public function insertBill($parameters) {
//        return DB::table('T_BILL_PF_NEY')->insert($parameters);
//    }
//
//    public function findBillById($loginId){
//        $query = "SELECT * FROM T_BILL_PF_NEY WHERE f_loginid=:f_loginid";
//        return DB::select($query, array("f_loginid"=>$loginId));
//    }
//
//    public function updateBill(array $parameter, array $wheres)
//    {
//        return DB::table('T_BILL_PF_NEY')
//            ->where($wheres)
//            ->update($parameter);
//    }
