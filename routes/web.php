<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchiveInvoiceController;
use App\Http\Controllers\CustomerReportController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceAttachmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\InvoiceReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;












/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::Resource('/invoices', InvoiceController::class);
Route::Resource('/department', DepartmentController::class);
Route::Resource('/product', ProductController::class);
Route::Resource('/InvoiceAttachment', InvoiceAttachmentController::class);
Route::get('/departments', [InvoiceController::class, 'getproduct'])->name('getProduct');
Route::get('/InvoiceDetail/{id}', [InvoiceDetailController::class, 'getDepartment']);
Route::get('viewFile/{fileName}', [InvoiceDetailController::class, 'openFile']);
Route::get('download/{fileName}', [InvoiceDetailController::class, 'downloadFile']);
Route::delete('deleteFile', [InvoiceDetailController::class, 'destroy'])->name('deleteFile');
Route::get('changeStatus/{id}', [InvoiceController::class, 'changeStatus'])->name('changeStatus');
Route::post('updateStatus/{id}', [InvoiceController::class, 'updateStatus'])->name('updateStatus');
Route::get('invoicePaid', [InvoiceController::class, 'invoicePaid']);
Route::get('invoiceUnpaid', [InvoiceController::class, 'invoiceUnpaid']);
Route::get('invoicePartialPaid', [InvoiceController::class, 'invoicePartialPaid']);
Route::Resource('/archiveInvoice', ArchiveInvoiceController::class);
Route::get('printInvoice/{id}', [InvoiceController::class, 'printInvoice']);
Route::get('exportInvoices', [InvoiceController::class, 'export']);
Route::Resource('/invoiceReport', InvoiceReportController::class);
Route::post('/searchInvoice', [InvoiceReportController::class, 'searchInvoice']);
Route::Resource('/customerReport', CustomerReportController::class);
Route::post('/searchCustomer', [CustomerReportController::class, 'searchCustomer']);
Route::get('markAll', [InvoiceController::class, 'markAll'])->name('markAll');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
Route::get('/{page}', [AdminController::class, 'index']);
