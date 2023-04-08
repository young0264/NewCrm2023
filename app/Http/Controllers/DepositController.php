<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class DepositController extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function history(){
        return view('deposit.depositHistory');
    }

    public static function search(){
        return view('deposit.depositSearch');
    }

    public static function match1(){
        return view('deposit.depositMatching');
    }
    public static function match2(){
        return view('deposit.depositMatching2');
    }


}
