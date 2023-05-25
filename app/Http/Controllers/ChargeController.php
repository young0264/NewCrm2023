<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ChargeController extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public static function chargeMemberRegist(Request $request){
//        echo "<pre>";
//        print_r(123123123);
//        print_r($request->input());
//        exit;
        return view('charge.memberRegistView');
    }
    public static function chargeNonMemberRegist(){
        return view('charge.nonMemberRegistView');
    }

}
