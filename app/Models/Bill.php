<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bill extends Model
{
    use HasFactory;

    // 해당 테이블의 키 컬럼 처리
    public static $column = [
        "F_BILLID"=>"정산키", "F_OSP"=>"사이트구분", "F_ADMIN"=>"관리자페이지",
        "F_PAY_TYPE"=>"결제방식", "F_PAY_INTERVAL"=>"결제주기",
        "F_BIZID"=>"본사아이디", "F_BIZNAME"=>"본사명", "F_LOGINID"=>"로그인아이디",
        "F_SHOPID"=>"고객아이디", "F_SHOPNAME"=>"고객명", "F_TAX_TYPE"=>"계산서종류", "F_ASSO"=>"협회", "F_STATUS"=>"상태",
        "F_NAME1"=>"담당자1", "F_MOBILE1"=>"연락처1", "F_EMAIL1"=>"담당자메일1", "F_NAME2"=>"담당자2", "F_MOBILE2"=>"연락처2", "F_EMAIL2"=>"담당자메일2",
        "F_HISTORY"=>"내역", "F_REPLY"=>"회신", "F_STATEMENT"=>"거래명세서", "F_TAX_BILL"=>"세금계산서", "F_ISSUEDATE"=>"발행날짜", "F_ETC"=>"비고",
        "F_REGISTRATION_NUMBER"=>"사업자번호", "F_MINOR_BUSINESS"=>"종사업장", "F_CP_NAME"=>"상호명", "F_REP_NAME"=>"대표자명", "F_ADDR"=>"주소", "F_BUSINESS"=>"업태", "F_EVENT"=>"종목", "F_PUBLIC_ADDR1"=>"발행주소1", "F_PUBLIC_ADDR2"=>"발행주소2",
        "F_PRICE"=>"공급가액", "F_TAX"=>"세액", "F_BIGO"=>"비고",
        "F_DAY1"=>"일자1", "F_PRODUCT1"=>"품목1", "F_STANDARD1"=>"규격1", "F_UNITPRICE1"=>"단가1", "F_COUNT1"=>"수량1", "F_PRICE1"=>"공급가액1", "F_TAX1"=>"세액1", "F_BIGO1"=>"품목비고1",
        "F_DAY2"=>"일자2", "F_PRODUCT2"=>"품목2", "F_STANDARD2"=>"규격2", "F_UNITPRICE2"=>"단가2", "F_COUNT2"=>"수량2", "F_PRICE2"=>"공급가액2", "F_TAX2"=>"세액2", "F_BIGO2"=>"품목비고2",
        "F_DAY3"=>"일자3", "F_PRODUCT3"=>"품목3", "F_STANDARD3"=>"규격3", "F_UNITPRICE3"=>"단가3", "F_COUNT3"=>"수량3", "F_PRICE3"=>"공급가액3", "F_TAX3"=>"세액3", "F_BIGO3"=>"품목비고3",
        "F_DAY4"=>"일자4", "F_PRODUCT4"=>"품목4", "F_STANDARD4"=>"규격4", "F_UNITPRICE4"=>"단가4", "F_COUNT4"=>"수량4", "F_PRICE4"=>"공급가액4", "F_TAX4"=>"세액4", "F_BIGO4"=>"품목비고4",
        "F_ISSUE_TYPE"=>"발행타입"
    ];


    public static $pay_interval = [
        "M"=>"월납",
        "Q"=>"분기납",
        "H"=>"반기납",
        "Y"=>"연납"
    ];


    public static function list($wheres="", $params) {
        $query = "select
                        f_billid, f_bizname, f_shopname, f_price,
                        -- Tab1
                        f_pay_type, f_pay_interval, f_history, f_reply, f_statement, f_tax_bill, f_issuedate,
                        -- Tab2
                        f_registration_number, f_minor_business, f_cp_name, f_rep_name, f_addr, f_business, f_event, f_public_addr1, f_public_addr2,
                        -- Tab3
                        f_name1, f_mobile1, f_email1, f_name2, f_mobile2, f_email2,
                        -- Tab4
                        f_day1 ,f_product1, f_standard1, f_unitprice1, f_count1, f_price1, f_tax1, f_bigo1,
                        f_day2, f_product2, f_standard2, f_unitprice2, f_count2, f_price2, f_tax2, f_bigo2,
                        f_day3, f_product3, f_standard3, f_unitprice3, f_count3, f_price3, f_tax3, f_bigo3,
                        f_day4, f_product4, f_standard4, f_unitprice4, f_count4, f_price4, f_tax4, f_bigo4,
                        f_issue_type
                    from t_bill
                        where f_billid is not null
                        {$wheres}
                        and rownum <= 10
                    order by f_issuedate";

        return DB::select($query, $params);
    }
}
