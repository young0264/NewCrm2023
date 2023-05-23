<?php

namespace App\Http\Controllers;
use App\Exports\DepositExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController
{
    /**
     *
     */

    public function exportExcel()
    {
        return Excel::download(new DepositExport, 'deposit.xlsx');
    }
//
//    public function downloadExcel(Request $request)
//    {
//        echo "<pre>";
//        print_r("============================excel download ssss============================");
//        print_r($request->input('depositList'));
//        print_r("============================excel download eeee============================");
//        exit;
//        // Create a new Spreadsheet object
//        $spreadsheet = new Spreadsheet();
//
//        // Add data to the spreadsheet
//        $sheet = $spreadsheet->getActiveSheet();
//        $sheet->setCellValue('A1', 'Hello');
//        $sheet->setCellValue('B1', 'World');
//
//        // Create a new Excel writer
//        $writer = new Xlsx($spreadsheet);
//
//        // Set the headers for file download
//        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//        header('Content-Disposition: attachment; filename="example.xlsx"');
//
//        // Save the spreadsheet to a file
//        $writer->save('php://output');
//    }
}
