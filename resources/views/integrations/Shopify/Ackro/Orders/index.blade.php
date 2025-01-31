<x-app-layout>
    <x-slot name="header">
        {{ __('Orders') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">{{__('Orders Trnasfred Limit')}}</div>
                    <div class="card-body">
                        <div id="ordserslimit"></div>
                        <script>
                            var options = {
                                series: [{{$options['features']['order_transfer_limit'] + $options['features']['order_transfer_extra_limit']}}, {{$options['features']['order_transfer_limit']}}, {{$options['features']['order_transfer_extra_limit']}}, 400],
                                chart: {
                                    width: 380,
                                    type: 'donut',
                                },
                                plotOptions: {
                                    pie: {
                                        startAngle: -90,
                                        endAngle: 270
                                    }
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                fill: {
                                    type: 'gradient',
                                },
                                legend: {
                                    formatter: function(val, opts) {
                                        return val + " - " + opts.w.globals.series[opts.seriesIndex]
                                    }
                                },
                                labels: ["Total Orders", "Orders per month", "Extra orders", "Total used"],
                                responsive: [{
                                    breakpoint: 480,
                                    options: {
                                        chart: {
                                            width: 200
                                        },
                                        legend: {
                                            position: 'bottom'
                                        }
                                    }
                                }]
                            };
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#ordserslimit"), options).render();
                            });
                        </script>
                    </div>
               </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">{{__('Orders report')}}</div>
                    <div class="card-body">
                        <div id="ordersreport"></div>
                        <script>
                            var optionsSpark3 = {
                                series: [{
                                    data:[10, 41, 35, 51, 49, 62, 69, 91, 148]
                                }],
                                chart: {
                                    type: 'area',
                                    height: 160,
                                    sparkline: {
                                        enabled: true
                                    },
                                },
                                stroke: {
                                    curve: 'straight'
                                },
                                fill: {
                                    opacity: 0.3
                                },
                                xaxis: {
                                    crosshairs: {
                                        width: 1
                                    },
                                },
                                yaxis: {
                                    min: 0
                                },
                                labels: ["Total Orders", "Orders per month", "Extra orders", "Total used"],
                                title: {
                                    text: '172 Orders',
                                    offsetX: 0,
                                    style: {
                                        fontSize: '24px',
                                    }
                                },
                                subtitle: {
                                    text: 'Transfred',
                                    offsetX: 0,
                                    style: {
                                        fontSize: '14px',
                                    }
                                }
                            };
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#ordersreport"), optionsSpark3).render();
                            });
                        </script>
                    </div>
               </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>{{$store->name}} {{__('Store Orders')}}</h2>
                    </div>
                    <div class="card-body">
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('ORDER NO.')}}</th>
                                    <th>{{__('CREATED')}}</th>
                                    <th>{{__('CUSTOMER NAME')}}</th>
                                    <th>{{__('TOTAL')}}</th>
                                    <th>{{__('WEBSHOP STATUS')}}</th>
                                    <th>{{__('FULLFILLMENT STATUS')}}</th>
                                    <th>{{__('UPDATED')}}</th>
                                    <th>{{__('ACTIONS')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$response['error'])
                                    @foreach($response['response']['edges'] as $order)
                                        <tr>
                                            <td> {{ $order['node']['name'] }} </td>
                                            <td>  {{$order['node']['createdAt']}} </td>
                                            <td>   @if (isset($order['node']['customer']['displayName']))
                                                {{ $order['node']['customer']['displayName'] }}
                                            @endif</td>
                                            <td>    {{ $order['node']['totalPrice'] }} {{$order['node']['currencyCode']}}</td>
                                            <td>   {{ $order['node']['displayFinancialStatus'] }} </td>
                                            <td>   {{ $order['node']['displayFulfillmentStatus'] }} </td>
                                            <td>  {{ $order['node']['updatedAt'] }} </td>
                                            <td> 
                                                <form action="" method="POST">
                                                    <div class="flex">
                                                        @php
                                                            $orderId = Str::afterLast($order['node']['id'], '/');
                                                            $orderNumber = Str::replaceFirst('#','', $order['node']['name']);
                                                        @endphp
                                                        @if($store->hasPermission('View Order'))
                                                            <a href="{{ route('orders.view', [$orderId]) }}" class="btn btn-outline-primary btn-sm">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                        @endif
                                                        @if($store->hasPermission('List orders report'))
                                                            <a href="{{ route('orders.log', [$orderId]) }}" class="btn btn-outline-dark btn-sm">
                                                                <i class="bi bi-card-list"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        <!-- End Table with stripped rows -->

                    </div>
                    <div class="card-footer">
                        @if($response['response']['pageInfo']['hasPreviousPage'])
                        @php
                            $cursor = end($response['response']['edges'])['cursor'];
                        @endphp
                        <a href="{{ route('orders') }}?page={{$cursor}}&rel=before">< Prev </a>
                    @endif
                    @if($response['response']['pageInfo']['hasNextPage'])
                        @php
                            $cursor = end($response['response']['edges'])['cursor'];
                        @endphp
    
                        <a href="{{ route('orders') }}?page={{$cursor}}&rel=after">Next ></a>
                    @endif
                    </div>
                </div>

            </div>
        </div>
      </section>
</x-app-layout>
