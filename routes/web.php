<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\IndexContorller;
use App\Http\Controllers\SampleController;
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
        Route::get("/", [IndexContorller::class, "index"])->name("index");
        /**
         * 기능 샘플
         */
        Route::get("/sample/oracle", [SampleController::class, "connection"])->name("oracleConnection");
        Route::get("/sample/dataTables", [SampleController::class, "dataTables"])->name("dataTables");
        Route::get("/sample/sqlrelay", [SampleController::class, "sqlrelay"])->name("sqlrelay");
        Route::get("/excel/import", [SampleController::class, "import"])->name("excelImport");
        Route::get("/excel/exportProcess", [SampleController::class, "exportProcess"])->name("excelExportProcess");
        Route::post("/excel/importProcess", [SampleController::class, "importProcess"])->name("excelImportProcess");
        Route::get("/sample/dataTablesOracle", [SampleController::class, "dataTablesOracle"])->name("dataTablesOracle");
        Route::get("/sample/getStore", [SampleController::class, "getStore"])->name("getStore");

        /**
         * 이용료청구
         */
        Route::get("/charge/NonMember", [ClientController::class, "chargeNonMemberRegist"])->name("chargeNonMemberRegist");
        Route::get("/charge/member", [ClientController::class, "chargeMember"])->name("chargeMember");
        Route::post("/charge/storeInfo", [ClientController::class, "getStoreInfo"])->name("getStoreInfo");

        /**
         * 계산서
         */
        Route::get("/bill/issue", [BillController::class, "issue"])->name("billIssue");
        Route::get("/bill/form", [BillController::class, "form"])->name("billForm");
        Route::get("/bill/form/sub", [BillController::class, "printForm"])->name("printBillForm");
        Route::get("/bill/integrate", [BillController::class, "integrate"])->name("billIntegratedCollection");
        Route::get("/bill/cash", [BillController::class, "cashReceipt"])->name("billCashReceipt");
        Route::post("/bill/ListNEY", [BillController::class, "listByNEY"])->name("billListNEY");
        Route::post("/bill/list", [BillController::class, "list"])->name("billList");
        Route::post("/bill/findById", [BillController::class, "findBillById"])->name("findBillById");
        Route::post("/bill/BillFormUpdate", [BillController::class, "BillFormUpdate"])->name("BillFormUpdate");
        Route::post("/bill/register", [BillController::class, "billRegisterProcess"])->name("billRegisterProcess");

        Route::get("/bill/issue2", [BillController::class, "issuePage"])->name("billIssue2");


        /**
         * 입금내역
         */
        Route::get("/deposit/history", [DepositController::class, "showHistory"])->name("depositHistory");
        Route::get("/deposit/list", [DepositController::class, "list"])->name("depositList"); //
        Route::get("/deposit/match/1", [DepositController::class, "match1"])->name("depositMatch1");
        Route::get("/deposit/match/2", [DepositController::class, "match2"])->name("depositMatch2");
        Route::post("/deposit/save", [DepositController::class, "fileUpload"])->name("depositUpload");
        Route::get("/deposit/download", [DepositController::class, "download"])->name("downloadExcel");


        /**
         * 엑셀
         */
//        Route::get('/download/excel/', [DepositController::class, 'export'])->name('downloadExcel');

    });
}


require __DIR__.'/auth.php';
