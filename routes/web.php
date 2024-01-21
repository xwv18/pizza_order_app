<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UserListController;
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





// login / register page

Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});



Route::middleware([
    'auth'
])->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::middleware(['admin_auth'])->group(function () {
        // Admin
        // Category Page
        Route::group(['prefix' => 'category'], function () {
            Route::get('home', [CategoryController::class, 'categoryHome'])->name('category#home');
            Route::get('list', [CategoryController::class, 'categoryList'])->name('category#list');
            Route::post('create', [CategoryController::class, 'categoryCreate'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'categoryUpdate'])->name('category#update');
        });
        // admin password

        Route::prefix('admin')->group(function () {
            // password
            Route::get('password/changePage', [AdminController::class, 'passwordChangePage'])->name('admin#changePasswordPage');
            Route::post('change/password', [AdminController::class, 'changePassword'])->name('admin#changePassword');

            // account
            Route::prefix('account')->group(function () {
                Route::get('info', [AdminController::class, 'accountInfo'])->name('adminAccount#info');
                Route::get('edit', [AdminController::class, 'accountEdit'])->name('adminAccount#edit');
                Route::post('update', [AdminController::class, 'accountUpdate'])->name('account#update');
            });


            // admin list
            Route::get('list', [AdminController::class, 'adminList'])->name('admin#list');
            Route::get('account/delete/{id}', [AdminController::class, 'adminDelete'])->name('admin#delete');
            Route::get('role/change/{id}', [AdminController::class, 'roleChange'])->name('role#change');
            Route::post('role/changeUpdate/{id}', [AdminController::class, 'roleChangeUpdate'])->name('role#update');

            // products
            Route::prefix('products')->group(function () {
                Route::get('list', [ProductController::class, 'productsList'])->name('products#list');
                Route::get('create', [ProductController::class, 'productsCreate'])->name('product#create');
                Route::post('create', [ProductController::class, 'getProduct'])->name('get#product');
                Route::get('delete/{id}', [ProductController::class, 'deleteProduct'])->name('delete#product');
                Route::get('detail/{id}', [ProductController::class, 'detailProduct'])->name('product#detail');
                Route::get('edit/{id}', [ProductController::class, 'editProduct'])->name('product#edit');
                Route::post('update', [ProductController::class, 'updateProduct'])->name('product#update');
            });

            // order
            Route::prefix('order')->group(function () {
                Route::get('list', [OrderController::class, 'orderList'])->name('admin#orderList');
                Route::get('ajax/status', [OrderController::class, 'orderStatus'])->name('order#status');
                Route::get('ajax/change/status',[OrderController::class,'orderChangeStatus'])->name('orderChange#status');
                Route::get('list/info/{orderCode}',[OrderController::class,'orderListInfo'])->name('orderList#info');
                Route::get('list/delete/{id}',[OrderController::class,'orderListDelete'])->name('orderList#delete');
            });

            //user list
            Route::prefix('user')->group(function () {
                Route::get('list',[UserListController::class,'userList'])->name('user#list');
                Route::get('ajax/role/change',[UserListController::class,'userRoleChange'])->name('user#roleChange');
                Route::get('list/delete/{id}',[UserListController::class,'userListDelete'])->name('userList#delete');
            });

            //user contact list
            Route::prefix('user')->group(function () {
                Route::get('contact/list',[ContactController::class,'userContactList'])->name('user#contactList');
                Route::get('contact/delete/{id}',[ContactController::class,'userContactDelete'])->name('user#contactDelete');
                Route::get('contact/detail/{id}',[ContactController::class,'userContactDetail'])->name('user#contactDetail');
            });
        });
    });


    // User
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        // Route::get('home', function () {
        //     return view('user.home');
        // })->name('user#home');
        // home page
        Route::get('home', [UserController::class, 'home'])->name('user#home');
        Route::get('category/filter/{id}', [UserController::class, 'categoryFilter'])->name('category#filter');

        Route::prefix('pizza')->group(function () {
            Route::get('details/{id}', [UserController::class, 'pizzaDetail'])->name('pizza#detail');
        });

        // password
        Route::get('password/changePage', [UserController::class, 'passwordChangePage'])->name('user#changePasswordPage');
        Route::post('change/password', [UserController::class, 'changePassword'])->name('user#changePassword');

        // account
        Route::prefix('account')->group(function () {
            Route::get('info', [UserController::class, 'accountInfo'])->name('account#info');
            Route::get('edit', [UserController::class, 'accountEdit'])->name('account#edit');
            Route::post('update', [UserController::class, 'accountUpdate'])->name('account#update');
        });
        // ajax
        Route::prefix('ajax')->group(function () {
            Route::get('dataList', [AjaxController::class, 'dataList'])->name('ajax#dataList');
            Route::get('addToCart', [AjaxController::class, 'addToCart'])->name('ajax#addToCart');
            Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
            Route::get('clear/cart', [AjaxController::class, 'clearCart'])->name('clear#cart');
            Route::get('clear/current/product', [AjaxController::class, 'clearCurrentProduct'])->name('clear#currentProduct');
            Route::get('view/count',[AjaxController::class,'viewCount'])->name('view#count');
        });
        // cart page
        Route::prefix('cart')->group(function () {
            Route::get('homePage', [CartController::class, 'cartPage'])->name('cart#homePage');
        });

        //user order history
        Route::prefix('order')->group(function () {
            Route::get('history', [UserController::class, 'history'])->name('order#history');

        });

        //contact page
        Route::prefix('contact')->group(function () {
            Route::get('homePage',[ContactController::class,'contactHomePage'])->name('user#contactHomePage');
            Route::post('contact/data',[ContactController::class,'contactData'])->name('contact#data');
        });


    });
});
