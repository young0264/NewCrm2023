<?php

namespace App\Http\Controllers;

use App\Models\Bill_PF_NEY;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PFController {

    public function isPresentId(Request $request) {
        $f_loginid = $request->input('f_loginid');
        $result = Bill_PF_NEY::isPresentId($f_loginid);
        if($result > 0) {
            return response()->json([
                'status' => 'ok',
                'result' => 'true'
            ]);
        }else {
            return response()->json([
                'status' => 'ok',
                'result' => 'false'
            ]);
        }
    }

    public function pfRegisterProcess(Request $request){
        $billPFParams = array(
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

        DB::beginTransaction();

        try{
            if (!BILL_PF_NEY::insertBill($billPFParams)) {
                throw new Exception("공연료에 대한 정보등록에 실패하였습니다.");
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage()
            ]);
        }
    }
}
