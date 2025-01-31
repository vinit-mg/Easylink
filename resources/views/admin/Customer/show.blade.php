<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Customers') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                    <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                        <a class="btn btn-primary" href="{{route('admin.customers.index')}}">{{__('See Customer usage')}} <i class="bi bi-arrow-right me-1"></i></a>
                        <a class="btn btn-primary" href="{{route('admin.customers.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all customers')}}</a>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <table class="table">
                                <tr>
                                    <td class="table-active">{{__('Customer no.')}}</td>
                                    <td>{{$customer->CustomerNo}}</td>
                                </tr>
                                <tr>
                                    <td class="table-active">{{__('Company name')}}</td>
                                    <td>{{$customer->CompanyName}}</td>
                                </tr>
                                <tr>
                                    <td class="table-active">{{__('Address')}}</td>
                                    <td>{{$customer->Address}}</td>
                                </tr>
                                <tr>
                                    <td class="table-active">{{__('Zip code')}}</td>
                                    <td>{{$customer->ZipCode}}</td>
                                </tr>
                                <tr>
                                    <td class="table-active">{{__('Town')}}</td>
                                    <td>{{$customer->Town}}</td>
                                </tr>
                                <tr>
                                    <td class="table-active">{{__('Country')}}</td>
                                    <td>{{$customer->Country}}</td>
                                </tr>   
                                <tr>
                                    <td class="table-active">{{__('CVR-no.')}}</td>
                                    <td>{{$customer->CVR_no}}</td>
                                </tr> 
                                <tr>
                                    <td class="table-active">{{__('Phone. No.')}}</td>
                                    <td>{{$customer->PhoneNo}}</td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-sm-6">
                            <table class="table">
                                <tr>
                                    <td class="table-active">{{__('Status')}}</td>
                                    <td>{{$customer->IsActive ? __('Active') : __('Inactive')}}</td>
                                </tr>
                                <tr>
                                    <td class="table-active">{{__('Dealer')}}</td>
                                    <td>{{$customer->Dealer}}</td>
                                </tr>

                            </table>
                        </div>

                        <div class="col-sm-12 mt-4 bg-light">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4>{{__('Stores')}}</h4>
                                <a href="{{ route('admin.customer.stores.create', $customer->uuid) }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add Stores')}}</a>
                            </div>

                            <table class="table">
                                <thead>
                                    <th>{{__('Store name')}}</th>
                                    <th>{{__('Source')}}</th>
                                    <th>{{__('Dstination')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($customer->stores as $store)
                                        <tr>
                                            <td>{{$store->name}}</td>
                                            <td>{{$store->source->name}}</td>
                                            <td>{{$store->destination->name}}</td>
                                            <td>
                                                @canany(['adminUpdate', 'adminDelete'], $store)
                                                    <form action="{{ route('admin.customer.stores.destroy', [$customer->uuid, $store->uuid]) }}" method="POST">
                                                        <div class="flex">
                                                            @can('adminView', $store)
                                                                <a href="{{route('admin.customer.stores.manage', [$customer->uuid, $store->uuid])}}" class="btn btn-primary"><i class="bi bi-gear"></i></a>
                                                            @endcan
                                                            @can('adminUpdate', $store)
                                                                <a class="btn btn-primary" href="{{route('admin.customer.stores.edit', [$customer->uuid, $store->uuid])}}"><i class="bi bi-pencil-square"></i></a>
                                                            @endcan
                                                            @can('adminDelete', $store)
                                                            @csrf
                                                            @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                            @endcan
                                                        </div>
                                                    </form>
                                                @endcanany
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12 mt-4 bg-light">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4>{{__('Subscriptions')}}</h4>
                                <a href="{{ route('admin.customer.subscriptions.create', $customer->uuid )}}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add Subscription')}}</a>
                            </div>
                            <table class="table">
                                <thead>
                                    <th>{{__('Solution name')}}</th>
                                    <th>{{__('Monthly fee DKK')}}</th>
                                    <th>{{__('Billing cycle')}}</th>
                                    <th>{{__('Start date')}}</th>
                                    <th>{{__('End date')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($customer->subscriptions as $subscription)
                                        <tr>
                                            <td>{{ $subscription->package->name }}</td>
                                            <td>{{ $subscription->package->base_price_monthly }} DKK</td>
                                            <td>{{ $subscription->billing_cycle }}</td>
                                            <td>{{ $subscription->start_date }}</td>
                                            <td>{{ $subscription->end_date }}</td>
                                            <td>{{ $subscription->status }}</td>
                                            <td>
                                                @canany(['adminUpdate', 'adminDelete', 'adminView'], $subscription)
                                                    <form action="{{ route('admin.customer.subscriptions.destroy', [$customer->uuid, $subscription->id]) }}" method="POST">
                                                    
                                                        <div class="flex">
                                                            @can('adminView', $subscription)
                                                                <a href="{{route('admin.customer.subscriptions.show', [$customer->uuid, $subscription->id])}}" class="btn btn-primary"><i class="bi bi-display"></i></a>
                                                            @endcan
                                                            @can('adminUpdate', $subscription)
                                                                <a href="{{route('admin.customer.subscriptions.edit', [$customer->uuid, $subscription->id])}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                            @endcan
                                                            
                                                            @can('adminDelete', $subscription)
                                                            @csrf
                                                            @method('DELETE')
                                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                            @endcan
                                                        </div>
                                                    </form>
                                                @endcanany
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12 mt-4 bg-light">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4>{{__('Users')}}</h4>
                                <a href="{{ route('admin.customers.create') }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add Users')}}</a>
                            </div>
                            <table class="table">
                                <thead>
                                    <th>{{__('User name')}}</th>
                                    <th>{{__('Username')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Role')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($customer->CustomerUsers as $CustomerUser)
                                        <tr>
                                            <td>{{ $CustomerUser->user->name }}</td>
                                            <td>{{ $CustomerUser->user->username }}</td>
                                            <td>{{ $CustomerUser->user->email  }}</td>
                                            <td>
                                                @foreach ($CustomerUser->user->getRoleNames() as $role)
                                                    <p>{{$role}}</p>
                                                @endforeach
                                            </td>
                                            <td>
                                                @canany(['adminUpdate', 'adminDelete', 'adminView'], $CustomerUser->user)
                                                <form action="{{ route('admin.user.destroy', $CustomerUser->user->id) }}" method="POST">
                                                
                                                    <div class="flex">
                                                        @can('adminView', $CustomerUser->user)
                                                            <a href="{{route('admin.user.show', $CustomerUser->user->id)}}" class="btn btn-primary"><i class="bi bi-display"></i></a>
                                                        @endcan
                                                        @can('adminUpdate', $CustomerUser->user)
                                                            <a href="{{route('admin.user.edit', $CustomerUser->user->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                        @endcan
                                                        
                                                        @can('adminDelete', $CustomerUser->user)
                                                        @csrf
                                                        @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                        @endcan
                                                    </div>
                                                </form>
                                            @endcanany
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
