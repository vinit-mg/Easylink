<x-app-layout>
    <x-slot name="header">
        {{ __('Orders') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>{{$store->name}} {{__('View Order')}}</h2>
                    </div>
                    <div class="card-body">
                        @if(session()->has('message'))
                            <div role="alert" class="alert alert-success">
                                <span>{{ session()->get('message') }}</span>
                            </div>
                        @endif
                        @if (!$response['error'])
                            @php
                                $order = $response['response'];
                            @endphp
                            <div class="col-sm-12">
                                <h4>{{__('Order').' '.$order['name']}}</h4>
                            </div>
                        @else
                            <p>Something went wrong</p>
                        @endif
                    </div>
                    <div class="card-footer">
                        <form action="" method="POST">
                            <div class="flex">
                                @php
                                    $orderId = Str::afterLast($order['id'], '/');
                                @endphp
                                @if($store->hasPermission('Order Transfer Manually')) 
                                    <a href="{{ route('orders.transfer', [$orderId]) }}" class="btn btn-success btn-sm">
                                        {{__('Transfer order to Ackro')}}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
      </section>
</x-app-layout>
