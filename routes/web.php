<?php

use App\Facades2\TestFClass;
use App\Http\Controllers\DBcontroller;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Auth;
// use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
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

Auth::routes();
Auth::routes(['verify' => true]);
Route::POST('/logout', [DBcontroller::class,'logout'])->name('logout');
Route::get('', function () {

    return redirect()->route('login');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get(
        '/datatable',
        function () {
            log::debug("log");
            return view('datatable');
        }
    )->name('datatable');

    Route::post('/store', [DBcontroller::class, 'store'])->name('store');
    Route::get('/fetchedData', [DBcontroller::class, 'show'])->name('fetchedData');
    Route::post('/DeleteEmployee', [DBcontroller::class, 'delete'])->name('DeleteEmployee');
    Route::post('/EditEmployee', [DBcontroller::class, 'edit'])->name('EditEmployee');
    Route::get('/PDFGenerate', [PDFController::class, 'PDFgenerate'])->name('PDFGenerate');
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
Route::get('/home', function () {
    return redirect()->route('datatable');
})->name('home');

Route::get('/fac', [TestFClass::class, 'TestFacadeFunction']);
Route::get('/redis', function () {
     $p = Redis::get('empData');
    $p = json_decode($p);

    echo "<pre>";
    print_r($p);

   // $empData = employee::all();
    // print_r(json_encode($empData));
})->name('redis')->middleware('can:IfAdmin');

Route::get('/RedisFlushall', function () {

    Redis::del('empData');
});
