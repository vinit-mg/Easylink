<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\SuperAdminRedirect;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\SubscriptionController;

Route::post('/admin/stores/get-company-name', [StoreController::class, 'getAckroCompanyName'])
    ->name('admin.stores.getCompanyName');
Route::post('/admin/stores/get-api-version', [StoreController::class, 'getShopifyApiVersion'])
    ->name('admin.stores.getShopifyApiVersion');
Route::post('/admin/stores/test', [StoreController::class, 'test'])
    ->name('admin.stores.test');


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', SuperAdminRedirect::class, SetLocale::class])->group(function () {

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

Route::post('/switch-language', [ProfileController::class, 'switchLanguage'])->name('language.switch');

Route::group(
    array_merge(
        config('translation.route_group_config'),
        ['namespace' => 'JoeDixon\\Translation\\Http\\Controllers', 'middleware' => ['auth', 'verified']]
    ),
    function ($router) {

        $router->get(config('translation.ui_url'), 'LanguageController@index')
            ->name('languages.index')->middleware(SetLocale::class);

        $router->get(config('translation.ui_url') . '/create', 'LanguageController@create')
            ->name('languages.create')->middleware(SetLocale::class, 'can:language create');

        $router->post(config('translation.ui_url'), 'LanguageController@store')
            ->name('languages.store');

        $router->get(config('translation.ui_url') . '/{language}/translations', 'LanguageTranslationController@index')
            ->name('languages.translations.index');

        $router->post(config('translation.ui_url') . '/{language}', 'LanguageTranslationController@update')
            ->name('languages.translations.update');

        $router->get(config('translation.ui_url') . '/{language}/translations/create', 'LanguageTranslationController@create')
            ->name('languages.translations.create')->middleware(SetLocale::class, 'can:translation create');

        $router->post(config('translation.ui_url') . '/{language}/translations', 'LanguageTranslationController@store')
            ->name('languages.translations.store');
    }
);

require __DIR__.'/auth.php';
