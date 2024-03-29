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
use App\Http\Controllers\Setup\StocksController;
use App\Http\Controllers\Setup\dingTalkController;
use App\Http\Controllers\Setup\departmentController;
use App\Http\Controllers\Setup\SaleController;
use App\Http\Controllers\Report\LuckyDrawResultController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Setup\KpiSettingController;
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
Route::get('/phpinfo', function () {
    return view('phpinfo');
});
Route::get('/mobile_spin',function(){
    return view('draw/mobile_spin');
});

Route::get('/test',function(){
    return view('test');
});

Auth::routes();

//For dingTalk Login
Route::get('auth/dingtalk', [App\Http\Controllers\Auth\DingTalkController::class, 'reDirectDingTalk'])->name('reDirectDingTalk');
 Route::get('auth/dingtalk/callback', [App\Http\Controllers\Auth\DingTalkController::class, 'dingTalkCallback'])->name('dingTalkCallback');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/validate/user/{phone_number}',[dingTalkController::class, 'validateUserStatus'])->name('validate-user');
Route::prefix('admin')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('index');
});

Route::prefix('setup')->middleware('auth', 'isAdmin')->group(function(){
    Route::get('store', [StoreController::class, 'index'])->name('index');
    Route::post('store/import',[StoreController::class, '_storeImport'])->name('store-import');
    Route::get('stores/search',[StoreController::class, 'storeSearch'])->name('stores.search');

    //Route::get('distributorImport', [DistributorController::class, 'distributorImport'])->name('distributorImport');  // delete in process, but still have UI
    Route::get('distributor', [DistributorController::class, 'index'])->name('distributor-index');
    Route::post('distributor/import', [DistributorController::class, '_distributorImport'])->name('distributor-import');
    Route::get('distributors/search',[DistributorController::class, 'distributorSearch'])->name('distributors.search');
    
    Route::get('import',[DistributorController::class, 'import'])->name('import');

    Route::get('product',[ProductController::class, 'index'])->name('product.index');
    Route::post('product/import',[ProductController::class, '_productImport'])->name('product-import'); //
    Route::post('product/store',[ProductController::class, 'productStore'])->name('product-store');
    Route::get('product/edit/{id}',[ProductController::class, 'edit'])->name('product-edit');
    Route::get('product/delete/{id}',[ProductController::class, 'delete'])->name('product-delete');
    Route::get('product/search',[ProductController::class, 'productSearch'])->name('product-search');

    //For stock
    Route::post('stock/import',[StocksController::class, '_stockImport'])->name('stock-import');
    // For Sale
    Route::post('sale/import',[SaleController::class, '_saleImport'])->name('sale-import');

    // for present
    Route::get('present',[PresentController::class, 'index'])->name('present-index');
    Route::get('present-create', [PresentController::class, 'create'])->name('present-create');
    Route::post('present-save',[PresentController::class, 'store'])->name('present-store');
    Route::get('present-edit/{id}',[PresentController::class, 'edit'])->name('present-edit');
    Route::get('present-delete/{id}',[PresentController::class, 'delete'])->name('present-delete');
    Route::post('present-update/{id}',[PresentController::class, 'update'])->name('present-update');
    Route::get('present-search/',[PresentController::class, 'search'])->name('present-search');

  
    //for Deptartment
    Route::get('/department/list',[departmentController::class, 'index'])->name('department-list-index');
    Route::get('/department/get',[departmentController::class, 'fetchDepartmentApi'])->name('department-fetchDepartmentApi');
    Route::get('/department/search',[departmentController::class, 'search'])->name('department-search');

    //for KPI Setting
    Route::get('/kpi-setting/list', [KpiSettingController::class, 'index'])->name('kpi-setting-index');
    Route::get('/kpi-setting-create', [KpiSettingController::class, 'create'])->name('kpi-setting-create');
    Route::post('/kpi-setting-save', [KpiSettingController::class, 'store'])->name('kpi-setting-store');
    
});

Route::prefix('draw')->group(function(){
    Route::get('index', [DrawController::class, 'index'])->name('draw-index');
    Route::post('draw-store', [DrawController::class, 'store'])->name('store');
    Route::post('present', [DrawController::class, 'present']);

});

Route::prefix('report')->group(function(){
    Route::get('lucky-draw-result', [LuckyDrawResultController::class, 'index'])->name('result-index');
    Route::get('search/lucky/draw/result', [LuckyDrawResultController::class, 'search'])->name('search-lucky-draw-result');

});

//For testing
Route::get('get/access-token',[dingTalkController::class, 'orderAndListDepartment']);
Route::get('/test/{id}',[dingTalkController::class, 'test'])->name('test');
// Route::get('sync/dept',[departmentController::class, 'syncDept'])->name('sync-dept');


  // for event setting
    Route::get('setup/event-setting',[EventSettingController::class, 'index'])->name('event-setting-index');
    Route::get('setup/event-setting-create', [EventSettingController::class, 'create'])->name('event-setting-create');
    Route::post('setup/event-setting/store',[EventSettingController::class, 'store'])->name('event-setting-store');
    Route::get('setup/event-setting-overview/{id}',[EventSettingController::class, 'overview'])->name('event-setting-overview');
    Route::get('setup/event-setting-edit/{id}',[EventSettingController::class, 'edit'])->name('event-setting-edit');
    Route::post('setup/event-setting-update',[EventSettingController::class, 'update'])->name('event-setting-update');
    Route::get('setup/event-setting/search',[EventSettingController::class, 'search'])->name('event-setting-search');
    Route::get('setup/event-setting-delete/{id}',[EventSettingController::class, 'delete'])->name('event-setting-delete');
