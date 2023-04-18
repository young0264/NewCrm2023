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
        Route::get("/sample/oracle", [\App\Http\Controllers\SampleController::class, "connection"])->name("oracleConnection");
        Route::get("/excel/import", [\App\Http\Controllers\SampleController::class, "import"])->name("excelImport");
        Route::post("/excel/importProcess", [\App\Http\Controllers\SampleController::class, "importProcess"])->name("excelImportProcess");
        Route::get("/excel/exportProcess", [\App\Http\Controllers\SampleController::class, "exportProcess"])->name("excelExportProcess");
        Route::get("/sample/dataTables", [\App\Http\Controllers\SampleController::class, "dataTables"])->name("dataTables");
    });
}


require __DIR__.'/auth.php';
