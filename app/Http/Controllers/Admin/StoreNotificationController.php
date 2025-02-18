<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreNotifications;
use App\Models\UserNotifications;
use App\Models\Stores;
use App\Models\Customers;
use App\Models\EmailTemplates;
use App\Models\User;
use App\Http\Requests\StoreStoreNotificationRequest;
use App\Http\Requests\UpdateStoreNotificationRequest;

class StoreNotificationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        $this->authorize('adminViewAny', EmailTemplates::class);
        $StoreNotifications = (new StoreNotifications)->newQuery();

        $storenotifications = $StoreNotifications->paginate(5)->onEachSide(2);

        return view('admin.StoreNotification.index', compact('storenotifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(){
        $this->authorize('adminCreate', EmailTemplates::class);
        $stores = (new Stores)->newQuery()->get();
        $customers = (new Customers())->newQuery()->get();
        $emailtemplates = (new EmailTemplates())->newQuery()->get();
        return view('admin.StoreNotification.create', compact('stores', 'customers', 'emailtemplates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStoreNotificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreStoreNotificationRequest $request){
        $this->authorize('adminCreate', EmailTemplates::class);
        StoreNotifications::create([
            'EmailTemplateID' => $request->EmailTemplateID,
            'StoreID' => $request->StoreID,
            'CustomerID' => $request->CustomerID,
            'IsActive' => true,
        ]);

        return redirect()->route('StoreNotification.index')
                        ->with('message', 'Store notification created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\StoreNotifications  $storenotification
     * @return \Illuminate\View\View
     */
    public function edit(StoreNotifications $storenotification)
    {
        $this->authorize('adminUpdate', EmailTemplates::class);
        $stores = Stores::get();
        $customers = Customers::get();
        $emailtemplates = EmailTemplates::get();
        $users = User::get();
       
        return view('admin.StoreNotification.edit', compact('storenotification', 'stores', 'customers', 'emailtemplates', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStoreNotificationRequest  $request
     * @param  \Models\StoreNotifications  $storenotification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateStoreNotificationRequest $request, StoreNotifications $storenotification){
        $this->authorize('adminUpdate', EmailTemplates::class);
        $storenotification->update($request->all());

        if(!empty($request->UserIDS)){

            UserNotifications::where('StoreNotificationID', $storenotification->id)->delete();

            foreach($request->UserIDS as $UserID){
                UserNotifications::create([
                    'StoreNotificationID' => $storenotification->id,
                    'UserID' => $UserID,
                    'Active' => true,
                ]);
            }
           
        } else {
            
            UserNotifications::where('StoreNotificationID', $storenotification->id)->delete();
        }

        return redirect()->route('StoreNotification.index')
                        ->with('message', 'Store notification updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\StoreNotifications  $storenotification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(StoreNotifications $storenotification){
        $this->authorize('adminDelete', EmailTemplates::class);
        $storenotification->delete();

        return redirect()->route('StoreNotification.index')
                        ->with('message', __('Store notification field deleted successfully'));
    }
}
