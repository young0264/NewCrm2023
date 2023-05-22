<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\ChargeController;
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

        /**
         * 이용료청구
         */
//
        Route::get("/charge/chargeMember", [ChargeController::class, "chargeMemberRegist"])->name("chargeMemberRegist");
        Route::get("/charge/chargeNonMember", [ChargeController::class, "chargeNonMemberRegist"])->name("chargeNonMemberRegist");

        /**
         * 계산서
         */
        Route::get("/bill/issue", [BillController::class, "issue"])->name("billIssue");
        Route::get("/bill/form", [BillController::class, "form"])->name("billForm");
        Route::get("/bill/form/sub", [BillController::class, "printForm"])->name("printBillForm");
        Route::get("/bill/integrate", [BillController::class, "integrate"])->name("billIntegratedCollection");
        Route::get("/bill/cash", [BillController::class, "cashReceipt"])->name("billCashReceipt");
        Route::post("/bill/list", [BillController::class, "listByNEY"])->name("billList");
        Route::post("/bill/findById", [BillController::class, "findBillById"])->name("findBillById");
        Route::post("/bill/BillFormUpdate", [BillController::class, "BillFormUpdate"])->name("BillFormUpdate");
        Route::post("/bill/register", [BillController::class, "billRegisterProcess"])->name("billRegisterProcess");

        /**
         * 입금내역
         */
        Route::get("/deposit/history", [DepositController::class, "history"])->name("depositHistory");
        Route::get("/deposit/search", [DepositController::class, "list"])->name("depositSearch"); //
        Route::get("/deposit/match/1", [DepositController::class, "match1"])->name("depositMatch1");
        Route::get("/deposit/match/2", [DepositController::class, "match2"])->name("depositMatch2");
        Route::post("/deposit/save", [DepositController::class, "save"])->name("depositUpload");


        /**
         * 엑셀
         */
        Route::get('/download/excel/', [DepositController::class, 'export'])->name('downloadExcel');

    });
}


require __DIR__.'/auth.php';
