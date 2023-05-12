<?php

namespace App\Http\Controllers;

use App\Models\Bill_TAX_NEY;
use Exception;
use http\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TaxController
{

    public function taxRegisterProcess(Request $request){
//        $billTaxKeys = array("F_LOGINID", "F_TAX_ISSUE", "F_PF_PRICE", "F_PYUNG", "F_VILLAGE", "F_ISSUEDATE");
//        echo "<pre>";
//        print_r($request->input());
//        exit;
        $billTaxParams = array(
            "F_LOGINID" => $request->input('f_loginid'),
            "F_TAX_ISSUE" => $request->input('f_tax_issue'),
            "F_PF_PRICE" => $request->input('f_pf_price'),
            "F_PYUNG" => $request->input('f_pyung'),
            "F_VILLAGE" => $request->input('f_village'),
            "F_ISSUEDATE" => $request->input('f_issuedate'),
            "F_OPENDATE" => $request->input('f_opendate'),
            "F_CLOSEDATE" => $request->input('f_closedate'),
            "F_CB" => $request->input('f_cb')
        );

//        echo "<pre>";
//        print_r($billTaxParams);
//        exit;

        try{
            Bill_TAX_NEY::insertBill($billTaxParams);
            DB::commit();
        }catch(Exception $e){
            print_r($e->getMessage());

            echo $e->getMessage();
        }finally{
            return redirect()->route('chargeMemberRegist');
        }

    }
}
