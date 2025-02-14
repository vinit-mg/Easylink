<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\User;

class CustomersController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
   
    public function index(){
        $this->authorize('adminViewAny', Customers::class);
        $Customers = (new Customers)->newQuery();
       
        if (request()->has('search')) {
            $Customers->where('name', 'Like', '%'.request()->input('search').'%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $Customers->orderBy($attribute, $sort_order);
        } else {
            $Customers->latest();
        }

        $customers = $Customers->paginate(20)->onEachSide(2);

        return view('admin.Customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(){
        $this->authorize('adminCreate', Customers::class);
        $users = User::role('customer-admin')->get();
        return view('admin.Customer.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCustomerRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCustomerRequest $request){
        
       
        $this->authorize('adminCreate', Customers::class);

        $image = $request->file('CompanyLogo'); // Retrieve the uploaded file
        $imageName = time() . '.' . $image->extension(); // Get the extension
        
        $image->storeAs('uploads', $imageName, 'public');
        $imageUrl = 'storage/uploads/' . $imageName;

        $customer = Customers::create([
            'CompanyName' => $request->CompanyName,
            'CompanyLogo' => $imageUrl,
            'AccessURL' => $request->AccessURL,
            'CustomerNo' => $request->CustomerNo,
            'Address' => $request->Address,
            'ZipCode' => $request->ZipCode,
            'Town' => $request->Town,
            'Country' => $request->Country,
            'CVR_no' => $request->CVR_no,
            'PhoneNo' => $request->PhoneNo,
            'Dealer' => $request->Dealer,
            'IsActive' => true,
            'IsDefault' => false,
        ]);

        if(!empty($request->users)){
            $customer->CustomerUsers()->create([
                'user_id' => $request->user
            ]);
        }
       
        return redirect()->route('admin.customers.index')
                        ->with('message',__('Customer created successfully.'));
    }

    public function show(Customers $customer){
       
        $this->authorize('adminView', Customers::class);

        return view('admin.Customer.show', compact('customer'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BalajiDharma\LaravelMenu\Models\Customers  $customer
     * @return \Illuminate\View\View
     */
    public function edit(Customers $customer){
        
        $this->authorize('adminUpdate', Customers::class);
        $users = User::role('customer-admin')->get();
        return view('admin.Customer.edit', compact('customer', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCustomerRequest  $request
     * @param  \BalajiDharma\LaravelMenu\Models\Customers  $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCustomerRequest $request, Customers $customer){
      
        $this->authorize('adminUpdate', Customers::class);

        $customer->update($request->except('users'));

        $customer->CustomerUsers()->delete();
        if(!empty($request->user)){
            $customer->CustomerUsers()->create([
                'user_id' => $request->user
            ]);
        }

        return redirect()->route('admin.customers.index')
                        ->with('message', 'customers updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BalajiDharma\LaravelMenu\Models\Customers  $Customers
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Customers $customer){
        $this->authorize('adminDelete', Customers::class);
        $customer->delete();

     
       
        return redirect()->route('admin.customers.index')
                        ->with('message', __('Customer deleted successfully'));
    }
}
