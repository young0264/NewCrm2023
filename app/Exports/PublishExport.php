<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
//print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">");

class PublishExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles {

    private $headers = ['f_bizname', 'f_shopname', 'f_price', 'f_pay_type', 'f_pay_interval', 'f_history', 'f_reply'
        , 'f_statement', 'f_tax_bill', 'f_issuedate'
        ,'f_registration_number', 'f_minor_business', 'f_cp_name', 'f_rep_name'
        , 'f_addr', 'f_business', 'f_event', 'f_public_addr1', 'f_public_addr2'
        ,'f_name1', 'f_mobile1', 'f_email1', 'f_name2', 'f_mobile2', 'f_email2'
        ,'f_product1', 'f_price1', 'f_product2', 'f_price2', 'f_product3', 'f_price3', 'f_product4', 'f_price4'
    ];
    private $headers_ko = ['본사명', '고객명', '공급가액', '결제방식', '결제주기', '내역', '회신', '거래명세서', '세금계산서', '발행날짜'
        ,'사업자번호', '종사업장', '상호명', '대표자명', '주소', '업태', '종목', '발행주소1', '발행주소2'
        ,'담당자1', '연락처1', '담당자메일', '담당자2', '연락처2', '담당자메일2'
        ,'품목1', '공급가액1', '품목2', '공급가액2', '품목3', '공급가액3', '품목4', '공급가액4'
    ];
    private $items;
    private $params;
    private $wheres;

    public function __construct($items) {
        $this -> items = $items;
//        $this -> wheres = "where f_billid is not null";
    }
    public function collection() {

        $res = array();
        foreach ($this->items as $item) {
            $arr_tmp = array();
            foreach ($this->headers as $header) {
                if (property_exists($item, $header)) {
                    $arr_tmp[] = $item->$header;
                } else {
                    $arr_tmp[] = "";
                }
            }

            $res[] = $arr_tmp;
        }
        return collect($res);
    }

    public function headings(): array {
        return $this->headers_ko;
    }

    public function columnWidths(): array {
        $res = [
            'A' => 25, 'B' => 10, 'C' => 30, 'D' => 30, 'E' => 20, 'F' => 10,
            'G' => 20, 'H' => 20, 'I' => 10, 'J' => 10, 'K' => 20, 'L' => 25,
            'M' => 15, 'N' => 20, 'O' => 10, 'P' => 30, 'Q' => 20, 'R' => 15,
            'S' => 25, 'T' => 30, 'U' => 20, 'V' => 10, 'W' => 10, 'X' => 15,
            'Y' => 20, 'Z' => 25, 'AA' => 10, 'AB' => 30, 'AC' => 25, 'AD' => 20,
            'AE' => 10, 'AF' => 15, 'AG' => 20
       ];

        return $res;
    }

    public function styles($sheet) {

        $sheet -> getStyle('A1:AG1') -> getFont() -> setBold(true);
        $sheet -> getStyle('A1:AG1') ->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'CCCCCC', // 회색 배경색
                ],
            ],
        ]);
    }

}
