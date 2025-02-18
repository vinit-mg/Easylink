<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2>{{__('Subscription')}}</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>{{__('Package name')}}</th>
                                <th>{{__('Customer name')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Status')}}</th>
                                <th class="d-flex justify-content-center">{{__('Actions')}}</th>
                            </thead>
                            <tbody>
                                @foreach ($currentuser->CustomerUsers as $CustomerUser)
                                    @foreach ($CustomerUser->Customer->subscriptions as $subscription)
                                        <tr>
                                            <td>{{$subscription->package->name}}</td>
                                            <td>{{$subscription->Customer->CompanyName}}</td>
                                            <td>{{$subscription->billing_cycle == 'monthly' ? $subscription->package->base_price_monthly.' DKK'  : $subscription->package->base_price_yearly.' DKK'}} / {{$subscription->billing_cycle}}</td>
                                            <td>{{$subscription->status}}</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="dropdown dropstart">
                                                        <a href="javascript:void(0)" class="link text-dark" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-three-dots"></i>
                                                        </a>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <li>
                                                            <a class="dropdown-item" href="javascript:void(0)">{{__('Cancel subscription')}}</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>{{__('AddOns')}}</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>{{__('AddOn name')}}</th>
                                <th>{{__('Customer name')}}</th>
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Total')}}</th>
                                <th>{{__('Purchased at')}}</th>
                                <th class="d-flex justify-content-center">{{__('Actions')}}</th>
                            </thead>
                            <tbody>
                                @foreach ($currentuser->CustomerUsers as $CustomerUser)
                                    @foreach ($CustomerUser->Customer->subscriptions as $subscription)
                                        @foreach ($subscription->AddOnPurchase as $AddOnPurchase)
                                            <tr>
                                                <td>{{$AddOnPurchase->AddOn->name}}</td>
                                                <td>{{$CustomerUser->Customer->CompanyName}}</td>
                                                <td>{{$AddOnPurchase->quantity}}</td>
                                                <td>{{$AddOnPurchase->addon_price}}</td>
                                                <td>{{$AddOnPurchase->total_price}}</td>
                                                <td>{{$AddOnPurchase->purchased_at}}</td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="dropdown dropstart">
                                                            <a href="javascript:void(0)" class="link text-dark" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bi bi-three-dots"></i>
                                                            </a>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <li>
                                                                <a class="dropdown-item" href="javascript:void(0)">{{__('Deactivate AddOn')}}</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>{{__('Invoices')}}</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>{{__('Invoice number')}}</th>
                                <th>{{__('Customer name')}}</th>
                                <th>{{__('Type')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Due date')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Actions')}}</th>
                            </thead>
                            <tbody>
                                @foreach ($currentuser->invoices as $invoice)
                                    <tr>
                                        <td><a href="{{route('subscriptions.invoicedetail', $invoice->id)}}">#{{$invoice->invoice_number}}</a></td>
                                        <td>{{$invoice->Customer->CompanyName}}</td>
                                        <td>
                                            @if (!empty($invoice->subscription->package))
                                                {{__('Package')}}
                                            @else
                                                {{__('AddOn')}}
                                            @endif
                                           
                                        </td>
                                        <td>{{$invoice->status}}</td>
                                        <td>{{$invoice->due_date}}</td>
                                        <td>{{$invoice->total_amount}}</td>
                                        <td>
                                            <a href=""><i class="bi bi-file-earmark-pdf"></i></a>
                                            <a href=""><i class="bi bi-eye-fill"></i></a>
                                        </td>
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</x-app-layout>

