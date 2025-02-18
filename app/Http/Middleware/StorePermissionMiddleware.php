<?php
namespace App\Http\Middleware;

use App\Http\Classes\CustomerStore;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StorePermissionMiddleware
{
    public function handle(Request $request, Closure $next, string $permission)
    {
        // $CustomerStore = new CustomerStore();
       
        // // Get store ID dynamically (adjust based on your user-store structure)
        // $store = $CustomerStore->getCurrentStore();
        // $storeId = $store->id;
        // if (!$storeId) {
        //     abort(403, 'No store associated with the user.');
        // }

        // // Check if the store has the required permission
        // if (!$CustomerStore->currentuser->hasStorePermission($permission, $storeId)) {
        //     abort(403, 'Unauthorized action.');
        // }


        return $next($request);
    }
}