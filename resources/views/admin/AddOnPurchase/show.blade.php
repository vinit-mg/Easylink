<x-admin.wrapper>
    <x-slot name="title">
        {{ __('AddOns Purchase') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                    <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                        <h5>{{__('AddOn Purchase')}}</h5>
                        <a class="btn btn-primary" href="{{route('admin.customers.show', $customer->uuid)}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to customer')}}</a>
                    </div> 
                   
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>{{__('Customer name')}}</strong></td>
                                <td>{{$addonpurchase->Customer->CompanyName}}</td>
                            </tr> 
                            <tr>
                                <td><strong>{{__('AddOn name')}}</strong></td>
                                <td>{{$addonpurchase->addOn->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Quantity')}}</strong></td>
                                <td>{{$addonpurchase->quantity}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Price')}}</strong></td>
                                <td>{{$addonpurchase->addon_price}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Total Price')}}</strong></td>
                                <td>{{$addonpurchase->total_price}}</td>
                            </tr>
                        </tbody>
                    </table>
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
