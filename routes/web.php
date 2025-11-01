<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RegementController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WelfareController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\purchaseOrderController;
use App\Http\Controllers\ItemLoanController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\CrvController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\WelfareMembershipController;
use App\Http\Controllers\ItemReturnController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\StockController;

Route::get('/', function () {
    return view('auth.login'); // This is your login page.
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Auth::routes();



// Define the logout route
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Define the login route
Route::get('login', [AuthController::class, 'loginPost'])->name('login.post');

// Define the profile route
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// routes/web.php
Route::middleware(['auth'])->group(function () {
Route::get('/home', [HomeController::class, 'index'])->name('home');


});

// Resource routes (but disable show since we use welfareshopAccess instead)
Route::resource('users', UserController::class)->except(['show']);
Route::get('/users/{id}/toggle-active', [UserController::class, 'active'])->name('users.toggle-active');
Route::get('/users/welfareshop-access', [UserController::class, 'welfareshopAccess'])->name('users.welfareshopaccess');
Route::get('/users/edit-welfareshopaccess/{id}', [UserController::class, 'editWelfareshopAccess'])->name('users.edit-welfareshopaccess');
Route::put('/users/update-welfareshopaccess/{id}', [UserController::class, 'updateWelfareshopAccess'])->name('users.update-welfareshopaccess');

// Define the product route
Route::resource('products', ProductController::class);
Route::get('/products/{id}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');


// Define the Role route
Route::resource('roles', RoleController::class);


// Define the Regement route
Route::resource('regements', RegementController::class); 
Route::get('regements/toggle-active/{id}', [RegementController::class, 'active'])->name('regements.toggle-active');

// Define the Rank route
Route::resource('ranks', RankController::class);
Route::get('/ranks/{id}/toggle-active', [RankController::class, 'active'])->name('ranks.toggle-active');

// Define the unit route
Route::resource('units', UnitController::class);
Route::get('/units/{id}/toggle-active', [UnitController::class, 'active'])->name('units.toggle-active');

// Define the Category route
Route::resource('categorys', CategoryController::class);
Route::get('/categorys/{id}/toggle-active', [CategoryController::class, 'active'])->name('categorys.toggle-active');

// Define the Welfare route
Route::resource('welfares', WelfareController::class);
Route::get('/welfares/{id}/toggle-status', [WelfareController::class, 'toggleStatus'])->name('welfares.toggle-status');


// Define the Supply route
Route::resource('supplys', SupplyController::class);
Route::get('/supplys/{id}/toggle-status', [SupplyController::class, 'toggleStatus'])->name('supplys.toggle-status');

// Define the item route
Route::resource('items', ItemController::class);
Route::get('/items/toggle/{itemId}', [ItemController::class, 'toggleStatus'])->name('items.toggle-active');
Route::post('/items/issue/{item}', [ItemController::class, 'issueItem'])->name('items.issue');
Route::get('/returns', [ItemReturnController::class, 'index'])->name('returns.index');
Route::get('/items/{item}/return', [ItemReturnController::class, 'create'])->name('items.return.create');
Route::post('/items/{item}/return', [ItemReturnController::class, 'store'])->name('items.return.store');
Route::get('/returns-export/csv', [ItemReturnController::class, 'exportCsv'])->name('returns.export.csv');
Route::get('/returns-export/pdf', [ItemReturnController::class, 'exportPdf'])->name('returns.export.pdf');

// Reports
Route::get('/reports/ledger', [LedgerController::class, 'index'])->name('reports.ledger');

// Invoices
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/invoices/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
Route::put('/invoices/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');

// Define the profile photo route
Route::get("/photos/{filename}",[StorageController::class,"index"])->name("image.show");

// Define the purchase_order route
Route::resource('purchaseorder', PurchaseOrderController::class);
Route::post('/purchase-orders/{id}/approve', [PurchaseOrderController::class, 'approve'])->name('purchase-orders.approve');
Route::post('/purchase-orders/{id}/reject', [PurchaseOrderController::class, 'reject'])->name('purchase-orders.reject');
Route::get('/purchase-orders/{id}/addstock', [PurchaseOrderController::class, 'addStock'])->name('purchaseorder.addstock');
Route::post('/purchase-orders/{id}/storestock', [PurchaseOrderController::class, 'storeStock'])->name('purchaseorder.storestock');
Route::get('/purchase-orders/export/csv', [PurchaseOrderController::class, 'exportCsv'])->name('purchaseorder.export.csv');
Route::get('/purchase-orders/export/pdf', [PurchaseOrderController::class, 'exportPdf'])->name('purchaseorder.export.pdf');
Route::get('/purchase-orders/ajax', [PurchaseOrderController::class, 'getData'])->name('purchase-orders.ajax');


// Define the stock routes
Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
Route::get('/stocks/data/get', [StockController::class, 'getData'])->name('stocks.getData');
Route::post('/stocks/check-serial', [StockController::class, 'checkSerial'])->name('stocks.checkSerial');
Route::get('/stocks/{id}', [StockController::class, 'show'])->name('stocks.show');

// Define the CRV routes
Route::get('/crv', [CrvController::class, 'index'])->name('crv.index');
Route::get('/crv/create/{purchaseorder}', [CrvController::class, 'create'])->name('crv.create');
Route::post('/crv/{purchaseorder}', [CrvController::class, 'store'])->name('crv.store');
Route::get('/crv/{crv}', [CrvController::class, 'show'])->name('crv.show');
Route::get('/crv-export/csv', [CrvController::class, 'exportCsv'])->name('crv.export.csv');
Route::get('/crv-export/pdf', [CrvController::class, 'exportPdf'])->name('crv.export.pdf');

// CRV approval actions
Route::post('/crv/{crv}/recommend', [CrvController::class, 'recommend'])->name('crv.recommend');
Route::post('/crv/{crv}/forward', [CrvController::class, 'forward'])->name('crv.forward');
Route::post('/crv/{crv}/approve', [CrvController::class, 'approve'])->name('crv.approve');
Route::post('/crv/{crv}/reject', [CrvController::class, 'reject'])->name('crv.reject');

// Define the Membership route
Route::resource('memberships', MembershipController::class);
Route::get('/memberships/{id}/toggle-status', [MembershipController::class, 'toggleStatus'])->name('memberships.toggle-status');

// Define the WelfareMembership route
Route::resource('welfarememberships', WelfareMembershipController::class);
Route::get('/welfarememberships/{id}/toggle-status', [WelfareMembershipController::class, 'toggleStatus'])->name('welfarememberships.toggle-status');

// Define the Item Loan routes
Route::get('/itemloans', [ItemLoanController::class, 'index'])->name('itemloans.index');
Route::get('/itemloans/create', [ItemLoanController::class, 'create'])->name('itemloans.create');
Route::post('/itemloans', [ItemLoanController::class, 'store'])->name('itemloans.store');
Route::get('/itemloans/{id}', [ItemLoanController::class, 'show'])->name('itemloans.show');
Route::get('/itemloans/{id}/edit', [ItemLoanController::class, 'edit'])->name('itemloans.edit');
Route::put('/itemloans/{id}', [ItemLoanController::class, 'update'])->name('itemloans.update');
Route::post('/itemloans/{id}/approve', [ItemLoanController::class, 'approve'])->name('itemloans.approve');
Route::post('/itemloans/{id}/reject', [ItemLoanController::class, 'reject'])->name('itemloans.reject');
Route::get('/itemloans/{id}/check-loan', [ItemLoanController::class, 'checkLoan'])->name('itemloans.checkLoan');
Route::post('/itemloans/{id}/check-membership', [ItemLoanController::class, 'checkMembership'])->name('itemloans.checkMembership');
Route::post('/itemloans/{id}/shop-coord-approve', [ItemLoanController::class, 'shopCoordApprove'])->name('itemloans.shopCoordApprove');
Route::post('/itemloans/{id}/shop-coord-reject', [ItemLoanController::class, 'shopCoordReject'])->name('itemloans.shopCoordReject');

// Serve soldier statement files directly
Route::get('/soldier-statements/{filename}', function ($filename) {
    $path = storage_path('app/public/soldier_statements/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }
    
    return response()->file($path);
})->name('soldier.statement');

// Serve loan statement files directly
Route::get('/loan-statements/{filename}', function ($filename) {
    $path = storage_path('app/public/loan_statements/' . $filename);
    
    if (!file_exists($path)) {
        abort(404);
    }
    
    return response()->file($path);
})->name('loan.statement');

// Define the Loan routes
Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
Route::get('/loans/{id}', [LoanController::class, 'show'])->name('loans.show');
Route::get('/loans/{id}/check', [LoanController::class, 'check'])->name('loans.check');
Route::get('/loans/{id}/edit', [LoanController::class, 'edit'])->name('loans.edit');
Route::put('/loans/{id}', [LoanController::class, 'update'])->name('loans.update');
Route::post('/loans/{id}/approve', [LoanController::class, 'approve'])->name('loans.approve');
Route::post('/loans/{id}/reject', [LoanController::class, 'reject'])->name('loans.reject');

