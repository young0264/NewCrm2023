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
        Route::get("/sample/dataTablesOracle", [\App\Http\Controllers\SampleController::class, "dataTablesOracle"])->name("dataTablesOracle");

        /**
         * 이용료청구
         */
//
        Route::get("/charge/chargeMember", [\App\Http\Controllers\ChargeController::class, "chargeMemberRegist"])->name("chargeMemberRegist");
        Route::get("/charge/chargeNonMember", [\App\Http\Controllers\ChargeController::class, "chargeNonMemberRegist"])->name("chargeNonMemberRegist");

        /**
         * 계산서
         */
        Route::get("/bill/issue", [\App\Http\Controllers\BillController::class, "issue"])->name("billIssue");
        Route::get("/bill/form", [\App\Http\Controllers\BillController::class, "form"])->name("billForm");
        Route::get("/bill/form/sub", [\App\Http\Controllers\BillController::class, "printForm"])->name("printBillForm");
        Route::get("/bill/integrate", [\App\Http\Controllers\BillController::class, "integrate"])->name("billIntegratedCollection");
        Route::get("/bill/cash", [\App\Http\Controllers\BillController::class, "cashReceipt"])->name("billCashReceipt");
        Route::post("/bill/list", [\App\Http\Controllers\BillController::class, "listByNEY"])->name("billList");
        Route::post("/bill/findById", [\App\Http\Controllers\BillController::class, "findBillById"])->name("findBillById");
        Route::post("/bill/BillFormUpdate", [\App\Http\Controllers\BillController::class, "BillFormUpdate"])->name("BillFormUpdate");


        /**
         * 입금내역
         */
        Route::get("/deposit/history", [\App\Http\Controllers\DepositController::class, "history"])->name("depositHistory");
        Route::get("/deposit/search", [\App\Http\Controllers\DepositController::class, "search"])->name("depositSearch");
        Route::get("/deposit/match/1", [\App\Http\Controllers\DepositController::class, "match1"])->name("depositMatch1");
        Route::get("/deposit/match/2", [\App\Http\Controllers\DepositController::class, "match2"])->name("depositMatch2");


        /**
         * 계산서 CUD
         */
        Route::post("/bill/register", [\App\Http\Controllers\BillController::class, "billRegisterProcess"])->name("billRegisterProcess");
    });
}


require __DIR__.'/auth.php';
