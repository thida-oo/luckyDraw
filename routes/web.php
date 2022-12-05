<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Draw\DrawController;
use App\Http\Controllers\Setup\DistributorController;
use App\Http\Controllers\Setup\StoreController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('index');
});

Route::prefix('setup')->middleware('auth', 'isAdmin')->group(function(){
    Route::get('store', [StoreController::class, 'index'])->name('index');
    Route::get('distributor', [DistributorController::class, 'index'])->name('index');
    Route::get('distributorImport', [DistributorController::class, 'distributorImport'])->name('distributorImport');
    Route::post('distributor/import', [DistributorController::class, '_distributorImport'])->name('distributor-import');
    Route::get('import',[DistributorController::class, 'import'])->name('import');
    Route::post('store/import',[StoreController::class, '_storeImport'])->name('store-import');
    
});


Route::prefix('draw')->middleware('auth', 'isAdmin')->group(function(){
    Route::get('index', [DrawController::class, 'index'])->name('index');
});