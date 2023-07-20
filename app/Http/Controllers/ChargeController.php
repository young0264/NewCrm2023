<?php

namespace App\Http\Controllers;

use App\Models\Bill_NEY;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ChargeController extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public static function chargeNonMemberRegist(){
        return view('charge.nonMemberRegistView');
    }

    public static function member(Request $request){
        return view('charge.member');
    }

    public static function chargeNonMember(Request $request){

    }


}
