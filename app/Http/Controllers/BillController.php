<?php

namespace App\Http\Controllers;
use App\Models\Bill;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class BillController extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public static function issue()
    {
        return view("bill.billIssueView");
    }
    public static function form()
    {
        return view("bill.billFormView");
    }
    public static function printForm()
    {
        return view("bill.printBillFormView");
    }

    public static function integrate()
    {
        return view("bill.integratedCollection");
    }

    public static function cashReceipt()
    {
        return view("bill.cashReceiptSearch");
    }

    public static function list(Request $request) {

        $wheres = "and f_admin='BR'";
        $params = [];

        $items = Bill::list($wheres, $params);

        $headers = array();
        foreach ($items as $key=>$item) {
            if ($key > 0)
                break;

            foreach ($item as $header=>$i) {
                if($header == "f_billid"
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
                ) {
                    continue;
                }
                $headers[] = array("key"=>$header, "name"=>Bill::$column[strtoupper($header)]);
            }
        }


        return response()->json(
            [
                "status"=>"ok",
                "result"=>array(
                    "header"=>json_encode($headers),
                    "items"=>json_encode($items)
                )
            ]);
    }



}
