<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Shipping method AddOn') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                  <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                    <h5>{{__('Edit Shipping method')}}</h5>
                    <a class="btn btn-primary" href="{{route('admin.customer.stores.load.addons', [$customer->uuid, $store->uuid, $addonfeature->id])}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all Shipping methods')}}</a>
                  </div> 
                  <form class="row g-3" method="POST" action="{{ route('admin.customer.stores.shippingmethod.update',[$customer->uuid, $store->uuid,  $addonfeature->id, $mapping->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-sm-5">
                        <label for="shopify_shipping_method_name" class="form-label">{{__('Shopify shipping method name')}}</label>
                        <input type="text" class="form-control" name="shopify_shipping_method_name" id="shopify_shipping_method_name" value="{{$mapping->shopify_shipping_method_name}}">
                    </div>
                    <div class="col-sm-4">
                        <label for="ackro_shippping_code_id" class="form-label">{{__('Ackro shipping code')}}</label>
                        <select name="ackro_shippping_code_id" class="form-select" id="ackro_shippping_code_id">
                            @foreach ($AckroShippingCodes as $AckroShippingCode)
                                <option value="{{$AckroShippingCode->id}}" {{$AckroShippingCode->id == $mapping->ackro_shippping_code_id ? 'selected' : ''}}>{{$AckroShippingCode->name.'('.$AckroShippingCode->code.')'}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label for="drop_point" class="form-label">{{__('Drop point')}}</label>
                        <select name="drop_point" class="form-select" id="drop_point">
                            <option value="not_applicable" {{$mapping->drop_point == 'not_applicable' ? 'selected' : ''}}>{{__('Not applicable')}}</option>
                            <option value="dynamic" {{$mapping->drop_point == 'dynamic' ? 'selected' : ''}}>{{__('Dynamic')}}</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-center">
                      <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" name="IsActive" id="IsActive" {{$mapping->IsActive ? 'checked' : ''}}>
                          <label class="form-check-label" for="IsActive">{{__('Activate?')}}</label>
                      </div>
                  </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                    </div>
                </form>    
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
