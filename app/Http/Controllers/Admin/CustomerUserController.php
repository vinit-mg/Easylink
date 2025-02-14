<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\CustomerUsers;
use BalajiDharma\LaravelAdminCore\Grid\UserGrid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class CustomerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('adminViewAny', User::class);
        $users = (new User)->newQuery()->with(['roles']);

        $crud = (new UserGrid)->list($users);

        return view('admin.crud.index', compact('crud'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(Customers $customer)
    {
        $this->authorize('adminCreate', User::class);

        $roles = Role::whereNotIn('name', ['super-admin', 'softinform-admin'])->get();;
        
        return view('admin.CustomerUser.create', compact('customer', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateRequest $request, Customers $customer)
    {
        $this->authorize('adminCreate', User::class);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // ✅ Hash password here
        ]);

        $roleName = $request->input('role', 'customer-user'); // Default role if not provided

        $role = Role::where('name', $roleName)->first();

        if ($role) {
            $user->assignRole($role);
        }

        // Assign user to customer in 'CustomerUsers' table
        CustomerUsers::create([
            'customer_id' => $customer->id,
            'user_id' => $user->id,
        ]);


        return redirect()->route('admin.customers.show', $customer->uuid)
            ->with('message', __('User created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        $this->authorize('adminView', $user);
        $crud = (new UserGrid)->show($user);

        return view('admin.crud.show', compact('crud'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Customers $customer, User $user)
    {
        $this->authorize('adminUpdate', $user);

        $roles = Role::whereNotIn('name', ['super-admin', 'softinform-admin'])->get();;
        
        return view('admin.CustomerUser.edit', compact('customer', 'roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, Customers $customer, User $user)
    {
        $this->authorize('adminUpdate', $user);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password, // Only hash and update password if provided
        ]);
            
        // Update role only if provided
        if ($request->filled('role')) {
            $user->syncRoles([$request->role]); // Removes previous roles & assigns the new one
        }

        return redirect()->route('admin.customers.show', $customer->uuid)
            ->with('message', __('User updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $this->authorize('adminDelete', $user);
        $user->delete();

        return redirect()->route('admin.user.index')
            ->with('message', __('User deleted successfully'));
    }

    /**
     * Show the user a form to change their personal information & password.
     *
     * @return \Illuminate\View\View
     */
    public function accountInfo()
    {
        $user = \Auth::user();

        return view('admin.user.account_info', compact('user'));
    }

    /**
     * Save the modified personal information for a user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accountInfoStore(Request $request)
    {
        $request->validateWithBag('account', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.\Auth::user()->id],
        ]);

        $user = \Auth::user()->update($request->except(['_token']));

        if ($user) {
            $message = 'Account updated successfully.';
        } else {
            $message = 'Error while saving. Please try again.';
        }

        return redirect()->route('admin.account.info')->with('account_message', __($message));
    }

    /**
     * Save the new password for a user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePasswordStore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'old_password' => ['required'],
            'new_password' => ['required', Rules\Password::defaults()],
            'confirm_password' => ['required', 'same:new_password', Rules\Password::defaults()],
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($validator->failed()) {
                return;
            }
            if (! Hash::check($request->input('old_password'), \Auth::user()->password)) {
                $validator->errors()->add(
                    'old_password', __('Old password is incorrect.')
                );
            }
        });

        $validator->validateWithBag('password');

        $user = \Auth::user()->update([
            'password' => Hash::make($request->input('new_password')),
        ]);

        if ($user) {
            $message = 'Password updated successfully.';
        } else {
            $message = 'Error while saving. Please try again.';
        }

        return redirect()->route('admin.account.info')->with('password_message', __($message));
    }
}
