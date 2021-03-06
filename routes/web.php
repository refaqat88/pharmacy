<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KataController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CustomerBillController;
use App\Http\Controllers\PermanentKataController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;

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

Route::get('/', [UserController::class, 'loginView'])->name('loginpage');

Route::get('login', [UserController::class, 'loginView'])->name('loginview');
Route::post('login', [UserController::class, 'login'])->name('login');

Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::get('logout', [UserController::class, 'logout'])->name('signout');



Route::group(['middleware' => ['auth']], function () {

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::post('add-user', [UserController::class, 'CreateUser']);
    Route::post('update-user', [UserController::class, 'UpdateUser']);
    Route::get('show-user/{id}', [UserController::class, 'ShowUser']);
    Route::get('edit-user/{id}', [UserController::class, 'EditUser']);
    Route::post('reset-user-password', [UserController::class, 'ResetUserPaassword']);

    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('edit-profile', [UserController::class, 'editProfile'])->name('edit-profile'); //admin profile edit
    Route::post('profile-update', [UserController::class, 'profileUpdate'])->name('profile-update'); //admin profile Update
    Route::resource('roles', RoleController::class);

/*    Route::get('katas', [KataController::class, 'index']);*/
    Route::get('katas', [KataController::class, 'index']);
    Route::post('katas/create', [KataController::class, 'store']);
    Route::post('katas/mobile', [KataController::class, 'mobile']); /*ajax search*/
    Route::get('katas/edit', [KataController::class, 'edit']);
    Route::get('katas/show', [KataController::class, 'show']);
    Route::get('katas/invoice/{id}', [KataController::class, 'invoice']);
    Route::post('katas/update', [KataController::class, 'update']);
    Route::get('katas/delete', [KataController::class, 'destroy']);


    /*Products Route*/

    Route::get('products', [ProductController::class, 'index']);
    Route::post('product/create', [ProductController::class, 'store']);
    Route::get('product/show', [ProductController::class, 'show']);
    Route::get('product/edit', [ProductController::class, 'edit']);
    Route::post('product/update', [ProductController::class, 'update']);
    Route::get('product/delete', [ProductController::class, 'destroy']);

    /*BillController Route*/

    Route::get('bills', [BillController::class, 'index']);
    Route::get('bill/add', [BillController::class, 'addBill']);
    //Route::post('supplier-katas/mobile', [SupplierController::class, 'mobile']); /*ajax search*/
    Route::post('bill/create', [BillController::class, 'store']);
    Route::post('bill/search', [BillController::class, 'search']);
    Route::get('bill/show', [BillController::class, 'show']);
    Route::get('bill/edit', [BillController::class, 'edit']);
    Route::post('bill/update', [BillController::class, 'update']);
    Route::get('bill/delete', [BillController::class, 'destroy']);


    /*CustomerBillController Route*/

    Route::get('customer/bills', [CustomerBillController::class, 'index']);
    Route::get('customer/bill/add', [CustomerBillController::class, 'addBill']);
    Route::post('customer/bill/mobile', [CustomerBillController::class, 'mobile']); /*ajax search*/
    Route::post('customer/bill/create', [CustomerBillController::class, 'store']);
    Route::post('customer/bill/search', [CustomerBillController::class, 'search']);
    Route::get('customer/bill/show', [CustomerBillController::class, 'show']);
    Route::get('customer/bill/edit', [CustomerBillController::class, 'edit']);
    Route::post('customer/bill/update', [CustomerBillController::class, 'update']);
    Route::get('customer/bill/delete', [CustomerBillController::class, 'destroy']);


    /* SupplierController */

    Route::get('supplier-katas', [SupplierController::class, 'index']);
    Route::post('supplier-katas/create', [SupplierController::class, 'store']);
    Route::post('supplier-katas/mobile', [SupplierController::class, 'mobile']); /*ajax search*/
    Route::get('supplier-katas/edit', [SupplierController::class, 'edit']);
    Route::get('supplier-katas/show', [SupplierController::class, 'show']);
    Route::get('supplier-katas/invoice/{id}', [SupplierController::class, 'invoice']);
    Route::post('supplier-katas/update', [SupplierController::class, 'update']);
    Route::get('supplier-katas/delete', [SupplierController::class, 'destroy']);


    Route::get('permanent-katas', [PermanentKataController::class, 'index']);
    Route::post('permanent-katas/create', [PermanentKataController::class, 'store']);
    Route::post('permanent-katas/mobile', [PermanentKataController::class, 'mobile']); /*ajax search*/
    Route::get('permanent-katas/edit', [PermanentKataController::class, 'edit']);
    Route::get('permanent-katas/show', [PermanentKataController::class, 'show']);
    Route::get('permanent-katas/invoice/{id}', [PermanentKataController::class, 'invoice']);
    Route::post('permanent-katas/update', [PermanentKataController::class, 'update']);
    Route::get('permanent-katas/delete', [PermanentKataController::class, 'destroy']);

    Route::get('khata-reports',[ReportController::class,'KhataReport']);
    Route::post('report-temporary-ajax', [ReportController::class, 'temporaryReportAjax'])->name('reportTemporaryAjax');
    Route::get('permanent-khata-reports',[ReportController::class,'permanentKhataReport']);
    Route::post('report-permanent-ajax', [ReportController::class, 'permanentReportAjax'])->name('reportPermanentAjax');
    Route::get('report/invoice/{id}', [ReportController::class, 'invoice']);

});