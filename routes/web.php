<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

if (!Auth::check()) {
    Route::middleware(['auth'])->group(function() {
        Route::get("/", [\App\Http\Controllers\IndexContorller::class, "index"])->name("index");
        /**
         * 기능 샘플
         */
        Route::get("/sample/oracle", [\App\Http\Controllers\SampleController::class, "connection"])->name("oracleConnection");
        Route::get("/sample/dataTables", [\App\Http\Controllers\SampleController::class, "dataTables"])->name("dataTables");
        Route::get("/sample/sqlrelay", [\App\Http\Controllers\SampleController::class, "sqlrelay"])->name("sqlrelay");
        Route::get("/excel/import", [\App\Http\Controllers\SampleController::class, "import"])->name("excelImport");
        Route::get("/excel/exportProcess", [\App\Http\Controllers\SampleController::class, "exportProcess"])->name("excelExportProcess");
        Route::post("/excel/importProcess", [\App\Http\Controllers\SampleController::class, "importProcess"])->name("excelImportProcess");


        /**
         * 이용료청구
         */
//
        Route::get("/regist/chargeMember", [\App\Http\Controllers\ChargeController::class, "chargeMemberRegist"])->name("chargeMemberRegist");
        Route::get("/regist/chargeNonMember", [\App\Http\Controllers\ChargeController::class, "chargeNonMemberRegist"])->name("chargeNonMemberRegist");
        Route::get("/bill/issue", [\App\Http\Controllers\BillController::class, "issue"])->name("billIssue");

        Route::get("/deposit/history", [\App\Http\Controllers\DepositController::class, "history"])->name("depositHistory");


    });
}


require __DIR__.'/auth.php';
