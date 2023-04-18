<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SampleExport implements FromCollection, WithHeadings
{
    protected $data;
    protected $header;
    public function __construct($header, $data)
    {
        $this->data = $data;
        $this->header = $header;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->data);
    }



    public function headings(): array
    {
        return $this->header;
    }
}
