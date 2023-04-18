<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexContorller extends Controller
{
    //
    public static function index() {
        return view("index", []);
    }
}
