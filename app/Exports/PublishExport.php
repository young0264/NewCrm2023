<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
//print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">");

class BillExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles {

    private $headers = ['f_bizname', 'f_shopname', 'f_price', 'f_pay_type', 'f_pay_interval', 'f_history', 'f_reply'
        , 'f_statement', 'f_tax_bill', 'f_issuedate'
        ,'f_registration_number', 'f_minor_business', 'f_cp_name', 'f_rep_name'
        , 'f_addr', 'f_business', 'f_event', 'f_public_addr1', 'f_public_addr2'
        ,'f_name1', 'f_mobile1', 'f_email1', 'f_name2', 'f_mobile2', 'f_email2'
        ,'f_product1', 'f_price1', 'f_product2', 'f_price2', 'f_product3', 'f_price3', 'f_product4', 'f_price4'
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
//            echo "<pre>";
//            print_r($this->items);
//            exit;
            foreach ($this->headers as $header) {
                if (property_exists($item, $header)) {
                    $arr_tmp[] = $item->$header;
                } else {
                    $arr_tmp[] = "";
                }
            }

            $res[] = $arr_tmp;
        }
//        echo "<pre>";
//        print_r($res);
//        exit;
        return collect($this->items);
    }

    public function headings(): array {
        return $this->headers;
    }

    public function columnWidths(): array {
//        $res = array();
//        foreach ($this->headers as $header) {
//            $res[$header] = 10;
//        }
//        return $res;
//    }
        $res = [
            'A' => 25, 'B' => 10, 'C' => 30, 'D' => 30, 'E' => 20, 'F' => 10,
            'G' => 20, 'H' => 20, 'I' => 10, 'J' => 10, 'K' => 20, 'L' => 25,
            'M' => 15, 'N' => 20, 'O' => 10, 'P' => 30, 'Q' => 20, 'R' => 15,
            'S' => 25, 'T' => 30, 'U' => 20, 'V' => 10, 'W' => 10, 'X' => 15,
            'Y' => 20, 'Z' => 25, 'AA' => 10, 'AB' => 30, 'AC' => 25, 'AD' => 20,
            'AE' => 10, 'AF' => 15, 'AG' => 20
       ];

//        echo "<pre>";
//        print_r($res);
//        exit;
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
