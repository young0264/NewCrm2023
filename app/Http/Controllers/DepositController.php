<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class DepositController extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function history(){
        return view('depositHistory');
    }

    public static function search(){
        return view('depositSearch');
    }


}
