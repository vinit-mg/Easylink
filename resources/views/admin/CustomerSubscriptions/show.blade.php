<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Subscription') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                    <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                        <h5>{{__('Package')}}</h5>
                        <a class="btn btn-primary" href="{{route('admin.customersubscriptions.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all subscriptions')}}</a>
                    </div> 
                   
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>{{__('Customer name')}}</strong></td>
                                <td>{{$customersubscription->Customer->CompanyName}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Package name')}}</strong></td>
                                <td>{{$customersubscription->package->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Billing cycle')}}</strong></td>
                                <td>{{$customersubscription->billing_cycle}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Price')}}</strong></td>

                                @if ($customersubscription->billing_cycle == 'monthly')
                                    <td>{{$customersubscription->package->base_price_monthly}} {{__('Kr.')}}</td>
                                @else
                                    <td>{{$customersubscription->package->base_price_yearly}} {{__('Kr.')}}</td>
                                @endif
                               
                            </tr>
                            <tr>
                                <td><strong>{{__('Start date')}}</strong></td>
                                <td>{{$customersubscription->start_date}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('End date')}}</strong></td>
                                <td>{{$customersubscription->end_date}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Status')}}</strong></td>
                                <td>{{$customersubscription->status}}</td>
                            </tr>
                        </tbody>
                    </table>
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
