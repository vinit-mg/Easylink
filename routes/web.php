<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\OrdersController;
use App\Http\Middleware\SuperAdminRedirect;

Route::post('/admin/stores/get-company-name', [StoreController::class, 'getAckroCompanyName'])
    ->name('admin.stores.getCompanyName');
Route::post('/admin/stores/get-api-version', [StoreController::class, 'getShopifyApiVersion'])
    ->name('admin.stores.getShopifyApiVersion');
Route::post('/admin/stores/test', [StoreController::class, 'test'])
    ->name('admin.stores.test');


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', SuperAdminRedirect::class])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/orders', [OrdersController::class, 'index'])->middleware(['auth', 'verified'])->name('orders');
    Route::get('/orders/view/{id}', [OrdersController::class, 'view'])->middleware(['auth', 'verified'])->name('orders.view');
    Route::get('/orders/transfer/{id}', [OrdersController::class, 'transfer'])->middleware(['auth', 'verified'])->name('orders.transfer');
    Route::get('/orders/log/{id}', [OrdersController::class, 'log'])->middleware(['auth', 'verified'])->name('orders.log');

    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->middleware(['auth', 'verified'])->name('subscriptions');
    Route::get('/subscriptions/invoicedetail/{subscription_id}', [SubscriptionController::class, 'view'])->middleware(['auth', 'verified'])->name('subscriptions.invoicedetail');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
