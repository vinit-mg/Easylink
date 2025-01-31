<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Shipping methods mappings') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                            <a href="{{ route('admin.customer.stores.shippingmethod.create', [$customer->uuid, $store->uuid, $AddOnFeature->id]) }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add shipping method')}}</a>
                            <a href="{{ route('admin.customer.stores.manage', [$customer->uuid, $store->uuid]) }}" class="btn btn-primary"><i class="bi bi-arrow-left me-1"></i> {{__('Back to manage store')}}</a>
                        </div> 
                        <div class="card-title">
                           
                        </div> 
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Store name')}}</th>
                                    <th>{{__('Shopify method name')}}</th>
                                    <th>{{__('Ackro code')}}</th>
                                    <th>{{__('IsActive')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($ShopifyAckroShippingMethodMappings as $ShopifyAckroShippingMethodMapping)
                                <tr>
                                    <td>{{$ShopifyAckroShippingMethodMapping->store->name}}</td>
                                    <td>{{$ShopifyAckroShippingMethodMapping->shopify_shipping_method_name}}</td>
                                    <td>{{$ShopifyAckroShippingMethodMapping->ackro_shippping_code->code}}</td>
                                    <td>{{$ShopifyAckroShippingMethodMapping->IsActive ? __('Active') : __('Inactive')}}</td>
                                    <td>
                                        @canany(['adminUpdate', 'adminDelete', 'adminView'], $ShopifyAckroShippingMethodMapping)
                                            <form action="{{ route('admin.customer.stores.shippingmethod.destroy', [$customer->uuid, $store->uuid, $AddOnFeature->id, $ShopifyAckroShippingMethodMapping->id]) }}" method="POST">
                                               
                                                <div class="flex">
                                                   
                                                    @can('adminUpdate', $ShopifyAckroShippingMethodMapping)
                                                        <a href="{{route('admin.customer.stores.shippingmethod.edit', [$customer->uuid, $store->uuid, $AddOnFeature->id, $ShopifyAckroShippingMethodMapping->id])}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                    @endcan
                                                    
                                                    @can('adminDelete', $ShopifyAckroShippingMethodMapping)
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
      </section>
</x-admin.wrapper>
