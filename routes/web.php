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
use App\Http\Controllers\MembershipController;

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


Route::resource('ranks', RankController::class);
Route::get('/ranks/{id}/toggle-active', [RankController::class, 'active'])->name('ranks.toggle-active');

// Define the Rank route
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

// Define the Item route
Route::resource('items', ItemController::class);
Route::get('/items/toggle/{itemId}', [ItemController::class, 'toggleStatus'])->name('items.toggle-active');

// Define the profile photo route
Route::get("/photos/{filename}",[StorageController::class,"index"])->name("image.show");

// Define the purchase_order route
Route::resource('purchaseorder', PurchaseOrderController::class);
Route::post('/purchase-orders/{id}/approve', [PurchaseOrderController::class, 'approve'])->name('purchase-orders.approve');
Route::post('/purchase-orders/{id}/reject', [PurchaseOrderController::class, 'reject'])->name('purchase-orders.reject');

// Define the Membership route
Route::resource('memberships', MembershipController::class);
Route::get('/memberships/{id}/toggle-status', [MembershipController::class, 'toggleStatus'])->name('memberships.toggle-status');




