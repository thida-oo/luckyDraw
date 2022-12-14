<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Draw\DrawController;
use App\Http\Controllers\Setup\DistributorController;
use App\Http\Controllers\Setup\EventSettingController;
use App\Http\Controllers\Setup\PresentController;
use App\Http\Controllers\Setup\ProductController;
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

//For google login
Route::get('auth/google', [App\Http\Controllers\Auth\GoogleController::class, 'reDirectGoogle'])->name('reDirectGoogle');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\GoogleController::class, 'googleCallBack'])->name('googleCallBack');

//For dingTalk Login
Route::get('auth/dingtalk', [App\Http\Controllers\Auth\DingTalkController::class, 'reDirectDingTalk'])->name('reDirectDingTalk');
 Route::get('auth/dingTalk/callback', [App\Http\Controllers\Auth\DingTalkController::class, 'dingTalkCallback'])->name('dingTalkCallback');

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

    Route::get('product',[ProductController::class, 'index'])->name('product.index');
    Route::post('product/import',[ProductController::class, '_productImport'])->name('product-import');
    Route::post('product/store',[ProductController::class, 'productStore'])->name('product-store');
    Route::get('product/edit/{id}',[ProductController::class, 'edit'])->name('product-edit');
    Route::get('product/delete/{id}',[ProductController::class, 'delete'])->name('product-delete');
    Route::get('product/search',[ProductController::class, 'productSearch'])->name('product-search');
    // for present
    Route::get('present',[PresentController::class, 'index'])->name('index');
    Route::post('present-save',[PresentController::class, 'store'])->name('store');


    // for event setting
    Route::get('event-setting',[EventSettingController::class, 'create'])->name('event-setting-create');
    Route::get('distributors/search',[DistributorController::class, 'distributorSearch'])->name('distributors.search');

    
});
    Route::get('stores/search',[StoreController::class, 'storeSearch'])->name('stores.search');
Route::post('event-setting/store',[EventSettingController::class, 'store'])->name('event-setting-store');

Route::prefix('draw')->middleware('auth', 'isAdmin')->group(function(){
    Route::get('index', [DrawController::class, 'index'])->name('index');
});