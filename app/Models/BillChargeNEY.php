<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

//$arr =  array('f_shopname', 'f_cb', 'f_business', 'f_cp_name', 'f_name1', 'f_pay_type', 'f_rep_name', 'f_mobile1', 'f_pay_interval',
//    'f_registration_number', 'f_email1', 'f_history', 'f_addr', 'f_name2', 'f_reply', 'f_public_addr1', 'f_mobile2',
//    'f_statement', 'f_public_addr2', 'f_email2', 'f_tax_bill', 'f_product1', 'f_product2', 'f_product3', 'f_product4',
//    'f_unitprice1', 'f_unitprice2', 'f_unitprice3', 'f_unitprice4', 'f_issue_type', 'f_bigo1', 'f_bigo2', 'f_bigo3', 'f_bigo4',
//);
class Bill_Charge_NEY extends Model{
    use HasFactory;
    private static $oracle_table = "T_BILL_NEY";
    private static $mysql_table = "T_BILL_NEY";


}

