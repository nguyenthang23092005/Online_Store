<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


Route::get('/customer', function () {
    return view('customer.home');   // resources/views/customer/home.blade.php
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/customers', function () {
        return view('admin.customer');
    })->name('customers');

    Route::get('/chat', function () {
        return view('admin.chat');
    })->name('chat');

    Route::get('/deliveries', function () {
        return view('admin.deliveries');
    })->name('deliveries');

    Route::get('/home', function () {
        return view('admin.home');
    })->name('home');

    Route::get('/inventory', function () {
        return view('admin.inventory');
    })->name('inventory');

    Route::get('/payments-gateway', function () {
        return view('admin.payments_gateway');
    })->name('payments_gateway');

    Route::get('/products', function () {
        return view('admin.products');
    })->name('products');

    Route::get('/returns', function () {
        return view('admin.returns');
    })->name('returns');

    Route::get('/staff', function () {
        return view('admin.staff');
    })->name('staff');

    Route::get('/stock-alerts', function () {
        return view('admin.stock-alerts');
    })->name('stock-alerts');

    Route::get('/warranties', function () {
        return view('admin.warranties');
    })->name('warranties');
});


Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    Route::get('/reset_password', function () {
        return view('auth.reset_password');
    })->name('reset_password');
});





Route::get('/b', function () {
    return view('admin.t');      // resources/views/admin/home.blade.php
});
Route::get('/css/app.css', function () {
    $path = resource_path('css/app.css');
    return Response::make(File::get($path), 200, [
        'Content-Type' => 'text/css'
    ]);
});
Route::get('/css/payments_gateway.css', function () {
    $path = resource_path('css/payments_gateway.css');
    return Response::make(File::get($path), 200, [
        'Content-Type' => 'text/css'
    ]);
});
Route::get('/js/products.js', function () {
    $path = resource_path('js/products.js');
    return Response::make(File::get($path), 200, [
        'Content-Type' => 'text/javascript'
    ]);
});
// Route::get('/js/products.css', function () {
//     $path = resource_path('css/products.css');
//     return Response::make(File::get($path), 200, [
//         'Content-Type' => 'text/css'
//     ]);
// });
// Route::get('/payments', function () {
//     return view('payments_gateway');
// });
