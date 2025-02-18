<?php

namespace App\Http\Controllers;

use App\Models\CustomerSubscriptions;
use Illuminate\Support\Facades\Auth;


class SubscriptionController extends Controller
{
    public function index()
    {
        
        $currentuser = Auth::user();
        return view('subscriptions', compact('currentuser'));
        
       
        // return view('admin.crud.index', compact('crud'));
    }
}
