<?php


use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FreeIssuesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentCreditorBalanceController;
use App\Http\Controllers\PlacingOrderAll;
use App\Http\Controllers\PlacingOrderController;
use App\Http\Controllers\PlacingOrderPdfController;
use App\Http\Controllers\ProductController;
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

Route::get('welcome', function () {
    return view('welcome');
});

Route::get('/', function(){
    return view('index');
});

Route::get('/productReg', function(){
    return view('productReg');
});

Route::get('/customerReg', function(){
    return view('customerReg');
});

Route::get('/defineFreeIssues', function(){
    return view('defineFreeIssues');
});

Route::get('/placingOrder', function(){
    return view('placingOrder');
});


Route::get('/creditorBalance', function(){
    return view('creditorBalance');
});

// product routes
Route::prefix('/productReg')->group(function(){
    Route::post('/store',[ProductController::class, "store"])->name('productReg.store');
});

Route::prefix('/productView')->group(function(){
    Route::get('/',[ProductController::class, "view"])->name('productReg.view');
    Route::get('/delete/{task_id}',[ProductController::class, "delete"])->name('productReg.delete');
    Route::get('/edit-product/{task_id}', [ProductController::class, 'edit'])->name('productReg.edit');
    Route::put('/update-product/{task_id}', [ProductController::class, 'update'])->name('productReg.update');
    //stock
    Route::get('/productStockView',[ProductController::class, "stock_view"])->name('productStock.view');
    Route::get('/edit-stock/{task_id}', [ProductController::class, 'editStock'])->name('stock.edit');
    Route::put('/update-stock/{task_id}', [ProductController::class, 'updateStock'])->name('stock.update');
    //import excel
    Route::POST('/import_product', [ProductController::class, 'import_product'])->name('import_product');
});


// customer Routes
Route::prefix('/customerReg')->group(function(){
    Route::post('/store', [CustomerController::class,"store"])->name('customerReg.store');
});

Route::prefix('/customerView')->group(function(){
    Route::get('/',[CustomerController::class,"view"])->name('customer.view');
    Route::get('/editCustomer/{task_id}',[CustomerController::class, "editCust"])->name('customer.edit');
    Route::post('updateCustomer/{task_id}',[CustomerController::class,"updateCust"])->name('customer.update');
    //import excel
    Route::POST('/import_customer', [CustomerController::class, 'import_customer'])->name('import_customer');
});


// Define Free Issues
Route::prefix('/defineFreeIssues')->group(function(){
    Route::get('/', [FreeIssuesController::class, "selectProduct"])->name('selectProduct');
    Route::post('/addFreeIssue', [FreeIssuesController::class, "addFreeIssue"])->name('addFreeIssue');
    Route::get('/defineFreeIssuesView',[FreeIssuesController::class,"view"])->name('freeIssues.view');
    Route::get('/editFreeIssues/{task_id}',[FreeIssuesController::class,"editeFreeIssues"])->name('freeIssues.edit');
    Route::post('/updateFreeIssues/{task_id}',[FreeIssuesController::class, "updateFreeIssues"])->name('freeIssues.update');
    Route::get('/placingOrder/{pu_product}', [PlacingOrderController::class,"getFreeIssue"]);
});

// Placing Order
Route::prefix('/placingOrder')->group(function(){
    Route::get('/', [PlacingOrderController::class, "placingorder"])->name('placingorder');
    Route::post('/saveData', [PlacingOrderController::class, 'saveData'])->name('saveData');
    Route::get('/placingOrderView',[PlacingOrderController::class,"view"])->name('placingOrder.view');
    Route::get('/placingOrdersView/{order_No}',[PlacingOrderController::class,"details"])->name('placingOrders.view');

});

// Placing Order PDF
Route::get('/placingOrderAllPdf',[PlacingOrderPdfController::class,"exportAllPdf"])->name('exportAllPdf');
Route::any('/generate-pdf', [PlacingOrderPdfController::class, 'getOrderDetails'])->name('generatePdf');


Route::get('/placingOrderPdf', [PlacingOrderPdfController::class, 'exportPdf'])->name('exportPdf');
Route::get('/placingOrderPdf/displayDetails', [PlacingOrderPdfController::class, 'displayDetails']);
Route::post('/download-pdf', [PlacingOrderPdfController::class, 'downloadPdf']);
Route::get('/export-pdf-multiple/{order_No}', [App\Http\Controllers\PlacingOrderPdfController::class, 'exportPdfMultiple'])->name('exportPdfMultiple');
Route::post('/get-order-details', 'PlacingOrderPdfController@getOrderDetails');
Route::any('/export-pdf-multiple', [PlacingOrderPdfController::class, 'exportPdfMultiple'])->name('export-pdf-multiple');


// creditor Balance and payment
Route::prefix('/payment')->group(function(){
    Route::get('/', [PaymentController::class, "viewData"])->name('viewData');
    // Route::post('/saveData', [PlacingOrderController::class, 'saveData'])->name('saveData');
    // Route::get('/placingOrderView',[PlacingOrderController::class,"view"])->name('placingOrder.view');
    Route::get('/paydetails/{order_No}',[PaymentController::class,"paydetails"])->name('paydetails');
    Route::get('/edit-pay/{order_No}',[PaymentController::class, "editPay"])->name('pay.edit');
    Route::put('/payment/{orderNumber}', [PaymentController::class, 'updatePay'])->name('payment.update');
});

Route::get('/creditorBalance', [PaymentCreditorBalanceController::class, 'displayCustomerBalances']);

//Display All order in select customer
Route::get('/allOrders/{customer_name}',[PlacingOrderAll::class, 'allOrders'])->name('allOrders.view');
Route::delete('/deleteOrder/{id}', [PlacingOrderAll::class, 'deleteOrder'])->name('deleteOrder');