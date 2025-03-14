<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SellerController;
use App\Http\Controllers\SellerProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentSlipController;

use App\Models\Employee;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmployeeController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Models\UserActivity;
use Illuminate\Http\Request;

use App\Http\Controllers\UserActivityController;
use App\Models\Categories;

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

// Public Routes
Route::get('/register-admin', function () {
    return view('auth.registerAdmin');
})->name('register.admin');



// Route::middleware(['auth:employee'])->group(function () {
//     Route::get('/employee/home', [HomeController::class, 'index'])->name('employee.home');
// });

Route::middleware(['auth:employee'])->group(function () {

    Route::get('/employee/home', [HomeController::class, 'index'])->name('employee.home');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{user_id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/update-status', [OrderController::class, 'updateStatus']);


    //Route User
    Route::get('/users', [UserController::class, 'index'])->name('users.index'); // แสดงรายชื่อผู้ใช้
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // แสดงฟอร์มสร้างผู้ใช้
    Route::post('/users', [UserController::class, 'store'])->name('users.store'); // บันทึกผู้ใช้ใหม่
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show'); // แสดงรายละเอียดผู้ใช้
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit'); // แสดงฟอร์มแก้ไขผู้ใช้
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update'); // อัพเดตข้อมูลผู้ใช้
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // ลบผู้ใช้


    // Route Seller
    Route::get('/sellers', [SellerController::class, 'index'])->name('sellers.index'); // แสดงรายชื่อผู้ใช้
    Route::get('/sellers/create', [SellerController::class, 'create'])->name('sellers.create'); // แสดงฟอร์มสร้างผู้ใช้
    Route::post('/sellers', [SellerController::class, 'store'])->name('sellers.store'); // บันทึกผู้ใช้ใหม่
    Route::get('/sellers/{id}', [SellerController::class, 'show'])->name('sellers.show'); // แสดงรายละเอียดผู้ใช้
    Route::get('/sellers/{id}/edit', [SellerController::class, 'edit'])->name('sellers.edit'); // แสดงฟอร์มแก้ไขผู้ใช้
    Route::put('/sellers/{id}', [SellerController::class, 'update'])->name('sellers.update'); // อัพเดตข้อมูลผู้ใช้
    Route::delete('/sellers/{id}', [SellerController::class, 'destroy'])->name('sellers.destroy'); // ลบผู้ใช้


    // seller products
    Route::get('/sellers/{seller_id}/products', [SellerProductController::class, 'index'])->name('sellers.products');
    Route::get('/sellers/{seller_id}/products/create', [SellerProductController::class, 'create'])->name('sellers.products.create');
    Route::post('/sellers/{seller_id}/products', [SellerProductController::class, 'store'])->name('sellers.products.store');

    Route::get('/sellers/{seller_id}/products/{id}/edit', [SellerProductController::class, 'edit'])->name('sellers.products.edit');
    // Route::post('/sellers/{seller_id}/products/{product_id}/update', [SellerProductController::class, 'update'])->name('sellers.products.update');
    // Route::post('/sellers/{seller_id}/products/{product_id}/update', [ProductController::class, 'update'])->name('sellers.products.update');

    Route::put('/sellers/{seller_id}/products/{id}/update', [SellerProductController::class, 'update'])->name('sellers.products.update');
    Route::delete('/sellers/{seller_id}/products/{id}', [SellerProductController::class, 'destroy'])->name('sellers.products.destroy');


    // Route payment
    Route::get('/payment-slips', [PaymentSlipController::class, 'index'])->name('payment.slips');
    Route::post('/update-order-status/{id}', [PaymentSlipController::class, 'updateStatus']);


// กำหนด route สำหรับหน้า Home
// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', [HomeController::class, 'index'])->name('home'); // ใช้เพียงบรรทัดนี้
// });

// user ใช้
// Route::get('/home', [HomeController::class, 'index'])->name('home'); // ใช้เพียงบรรทัดนี้



// Route::middleware(['auth'])->group(function () {
//     Route::get('/product', [ProductController::class, 'index'])->name('product.index');
// });
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
// Routes that require login


// Route::middleware(['auth'])->group(function () {

    // Dashboard (or other routes requiring login)
    // Route::get('/home', 'HomeController@index')->name('home');

    // Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Product routes
    Route::get('/create-product', function () {
        return view('create_product');
    });

    Route::get('/create-product', [ProductController::class, 'createProduct'])->name('create-product');

    // Route::get('create-categoriestest', function () {
    //     return view('create_categories_product');
    // })->name('create.categoriestest'); 

    // Route::get('/categories/create', function () {
    //     return view('create_categories_product');
    // })->name('categories.create');
    

    // For product CRUD actions
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/show/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    // Route::get('/edit-product/{id}', 'ProductController@edit')->name('product.edit');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');

    // Categories routes
    Route::get('/categories', [ProductController::class, 'categories'])->name('categories.categories');
    Route::post('/Create_categories', [ProductController::class, 'categories'])->name('categories.categories');

    // Route::get('/categories', [ProductController::class, 'store'])->name('categories.store');
    // Route::post('/Create_categories', [ProductController::class, 'categories'])->name('Create_categories.categories');
    
    // SellerController routes
    Route::get('/indextest', [SellerController::class, 'showSellers'])->name('indextest');

    // Route::get('Employee', [Employee::class, 'showRegistrationForm'])->name('registerContol');
    // Route::post('create', [RegisterController::class, 'registerContol']);
    // เปลี่ยน Route ให้ตรงกับฟังก์ชันที่ต้องการ
    // Route::get('registerC', [RegisterController::class, 'showRegistrationForm'])->name('registerContol');
    // Route::post('registerC', [RegisterController::class, 'registerC'])->name('registerContol'); // ใช้ POST method

    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
    // Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

    // Route::middleware(['auth'])->group(function () {
    //     Route::get('/home', [HomeController::class, 'index'])->name('home');
    // });

    // Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // กำหนด route สำหรับการแสดงฟอร์มสมัครสมาชิก
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');

    // กำหนด route สำหรับการบันทึกข้อมูลเมื่อ submit
    // Route::post('register', [RegisterController::class, 'create'])->name('register.create');

    // Route for handling registration submission (Call 'registerC' instead of 'create')
    Route::post('register', [RegisterController::class, 'registerC'])->name('register.create');

    // เพิ่ม Route สำหรับแสดงกิจกรรม
    Route::get('/home', [UserActivityController::class, 'showUserActivity']);
    // Route::get('/home', [UserActivityController::class, 'showUserActivity'])->name('user.activity');

    Route::post('/track-activity', function (Request $request) {
        if (Auth::check()) {
            UserActivity::create([
                'user_id' => Auth::id(),
                'page_url' => url()->current(),
                'action' => $request->input('action'),
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);
        }
        return response()->json(['success' => true]);
    });

    Route::middleware(['log.user.activity'])->group(function() {
        // วาง Route ที่ต้องการให้ติดตามกิจกรรม
        Route::get('/home', [HomeController::class, 'index']);
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        // Route::get('/home', [HomeController::class, 'index'])->name('employee.home');
    });
    
    // สำหรับผู้ใช้ employee (employee guard)
    Route::middleware(['auth:employee'])->group(function () {
        Route::get('/employee/home', [HomeController::class, 'index'])->name('employee.home');
    });

    // Route::get('/home', [EmployeeController::class, 'index'])->name('home');


    Route::get('/categories/create', function () {
        return view('create_categories_product');
    })->name('categories.create');

    Route::get('categories', function () {
        return view('categories');
    })->name('categories');
   
    // Route::post('categories', [Categories::class, 'store'])->name('categories.store');
    Route::get('categories', [CategoryController::class, 'index'])->name('category');
    Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

    // Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::get('/edit-categories/{id}', 'CategoryController@edit')->name('categories.edit');
    Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');


    Route::get('/category', [CategoryController::class, 'index'])->name('categories.index');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');


    // สร้าง Category
    // Route::get('/categories/create', [CategoryController::index, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'storeCategory'])->name('categories.store');
        
// });
});