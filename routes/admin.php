<?php

use App\Http\Middleware\SetLocale;
use App\Http\Middleware\HasAccessAdmin;


Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => config('admin.prefix'),
    'middleware' => ['auth', 'verified', HasAccessAdmin::class, SetLocale::class],
    'as' => 'admin.',
], function () {

   
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

  
    Route::resource('user', 'UserController');
    Route::resource('customer/{customer}/users', 'CustomerUserController')->names([
        'index'   => 'customer.users.index',
        'create'  => 'customer.users.create',
        'store'   => 'customer.users.store',
        'show'    => 'customer.users.show',
        'edit'    => 'customer.users.edit',
        'update'  => 'customer.users.update',
        'destroy' => 'customer.users.destroy',
    ]);
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
    Route::resource('media', 'MediaController');
    Route::resource('menu', 'MenuController')->except([
        'show',
    ]);
    Route::resource('menu.item', 'MenuItemController')->except([
        'show',
    ]);
    Route::group([
        'prefix' => 'category',
        'as' => 'category.',
    ], function () {
        Route::resource('type', 'CategoryTypeController')->except([
            'show',
        ]);
        Route::resource('type.item', 'CategoryController')->except([
            'show',
        ]);
    });
    Route::resource('comment', 'CommentController');
    Route::resource('thread', 'ThreadController');
    Route::get('edit-account-info', 'UserController@accountInfo')->name('account.info');
    Route::post('edit-account-info', 'UserController@accountInfoStore')->name('account.info.store');
    Route::post('change-password', 'UserController@changePasswordStore')->name('account.password.store');

    Route::resource('activitylog', 'ActivityLogController')->except([
        'create',
        'store',
        'edit',
        'update',
    ]);

    //Demo
    Route::group([
        'prefix' => 'demo',
        'as' => 'demo.',
    ], function () {
        Route::resource('forms', 'DemoFormsController')->except([
            'show',
            'edit',
            'update',
        ]);
    });

    Route::resource('emailtemplates', 'EmailTemplateController');
    Route::resource('storenotifications', 'StoreNotificationController');
    Route::resource('customers', 'CustomersController');
    Route::resource('customer/{customer}/stores', 'StoreController')->names([
        'index'   => 'customer.stores.index',
        'create'  => 'customer.stores.create',
        'store'   => 'customer.stores.store',
        'show'    => 'customer.stores.show',
        'edit'    => 'customer.stores.edit',
        'update'  => 'customer.stores.update',
        'destroy' => 'customer.stores.destroy',
    ]);

    Route::resource('customer/{customer}/extralimits', 'CustomerExtraLimitController')->names([
        'create'  => 'customer.extralimits.create',
        'store'   => 'customer.extralimits.store',
        'show'    => 'customer.extralimits.show',
        'edit'    => 'customer.extralimits.edit',
        'update'  => 'customer.extralimits.update',
        'destroy' => 'customer.extralimits.destroy',
    ]);

    Route::get('customer/{customer}/stores/{store}/manage', 'StoreController@manage')->name('customer.stores.manage');
    Route::post('customer/{customer}/stores/{store}/activate', 'StoreController@activateStore')->name('customer.stores.activate');
    Route::post('customer/{customer}/stores/{store}/deactivate', 'StoreController@deactivateStore')->name('customer.stores.deactivate');
    Route::post('customer/{customer}/stores/{store}/settings', 'StoreController@saveSettings')->name('customer.stores.settings.save');
    Route::post('customer/{customer}/stores/{store}/permissions', 'StoreController@savePermissions')->name('customer.stores.permissions.save');
    Route::get('customer/{customer}/stores/{store}/addons/{feature}', 'StoreController@loadAddOns')->name('customer.stores.load.addons');

    Route::resource('packages', 'PackagesController');
    Route::resource('packagefeatures', 'PackageFeaturesController');
    Route::resource('customer/{customer}/subscriptions', 'CustomerSubscriptionController')->names([
        'index'   => 'customer.subscriptions.index',
        'create'  => 'customer.subscriptions.create',
        'store'   => 'customer.subscriptions.store',
        'show'    => 'customer.subscriptions.show',
        'edit'    => 'customer.subscriptions.edit',
        'update'  => 'customer.subscriptions.update',
        'destroy' => 'customer.subscriptions.destroy',
    ]);
    Route::resource('addon', 'AddOnController');
    Route::resource('addonfeatures', 'AddOnFeaturesController');

    Route::resource('customer/{customer}/addonpurchase', 'AddOnPurchaseController')->names([
        'create'  => 'customer.addonpurchase.create',
        'store'   => 'customer.addonpurchase.store',
        'show'    => 'customer.addonpurchase.show',
        'edit'    => 'customer.addonpurchase.edit',
        'update'  => 'customer.addonpurchase.update',
        'destroy' => 'customer.addonpurchase.destroy',
    ]);
    Route::resource('payments', 'PaymentController');
    Route::resource('sourcesettings', 'SourceSettingsController');
    Route::resource('destinationsettings', 'DestinationSettingsController');
    Route::resource('destinationsettings', 'DestinationSettingsController');

    Route::get('customer/{customer}/dashboard', 'DashboardController@index')->name('customer.dashboard');
});

Route::group([
    'namespace' => 'App\Http\Controllers\Admin\Modules',
    'prefix' => config('admin.prefix'),
    'middleware' => ['auth', 'verified', HasAccessAdmin::class],
    'as' => 'admin.',
], function () {
    Route::resource('ackroshippingcodes', 'AckroShippingMethodController');
});

// AddOns ShopifyToAckro

// Shiping method
Route::group([
    'namespace' => 'App\AddOns\ShippingMethods\ShopifyToAckro\Controllers',
    'prefix' => config('admin.prefix'),
    'middleware' => ['auth', 'verified', HasAccessAdmin::class],
    'as' => 'admin.',
], function () {
    Route::get('customer/{customer}/stores/{store}/addons/{feature}/create', 'ShippingMethodController@create')->name('customer.stores.shippingmethod.create');
    Route::post('customer/{customer}/stores/{store}/addons/{feature}/store', 'ShippingMethodController@store')->name('customer.stores.shippingmethod.store');
    Route::get('customer/{customer}/stores/{store}/addons/{addonfeature}/edit/{mapping}', 'ShippingMethodController@edit')->name('customer.stores.shippingmethod.edit');
    Route::put('customer/{customer}/stores/{store}/addons/{addonfeature}/update/{mapping}', 'ShippingMethodController@update')->name('customer.stores.shippingmethod.update');
    Route::delete('customer/{customer}/stores/{store}/addons/{addonfeature}/destroy/{mapping}', 'ShippingMethodController@destroy')->name('customer.stores.shippingmethod.destroy');
});

