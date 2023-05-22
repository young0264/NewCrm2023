<?php
namespace App\Exports;

use App\Models\Deposit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class DepositExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{

    /**
     * @return Deposit[]|\Illuminate\Database\Eloquent\Collection|Collection
     */

    protected $headers;
    protected $params;

    public function __construct($headers, $params)
    {
        $this -> headers = $headers;
        $this -> params = $params;
    }
    public function collection()
    {
        $cols = "F_COMPANY, F_BANK, F_ACCOUNT, F_TRANS_DATE, F_CLIENT, F_PAYMENT, F_TRANS_TYPE, F_TRADE_BRANCH, F_USER";
        $res = Deposit::excelList($this ->params,[],$cols);
        return collect($res);
    }

    public function headings(): array
    {
        return $this->headers;
    }


    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 10,
            'C' => 30,
            'D' => 30,
            'E' => 20,
            'F' => 10,
            'G' => 20,
            'H' => 20,
            'I' => 10
        ];
    }

    public function styles($sheet)
    {
        $sheet -> getStyle('A1:I1') -> getFont() -> setBold(true);
        $sheet -> getStyle('A1:I1') ->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'CCCCCC', // 회색 배경색
                ],
            ],
        ]);
    }

}
