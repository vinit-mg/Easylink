<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Payments') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                    <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                        <h5>{{__('Package')}}</h5>
                        <a class="btn btn-primary" href="{{route('admin.payments.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all Payments')}}</a>
                    </div> 
                   
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>{{__('Customer name')}}</strong></td>
                                <td class="text-primary">{{$payment->Customer->CompanyName}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Ammount')}}</strong></td>
                                <td>{{$payment->amount}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Payment method')}}</strong></td>
                                <td>{{$payment->payment_method}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Transaction id')}}</strong></td>
                                <td>{{$payment->transaction_id}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Description')}}</strong></td>
                                <td>{{$payment->description}}</td>
                            </tr>  
                            <tr>
                                <td><strong>{{__('Payment type')}}</strong></td>
                                <td>{{$payment->payment_type}}</td>
                            </tr>
                            @if($payment->payment_type == 'subscription')
                                <tr>
                                    <td><strong>{{__('Package name')}}</strong></td>
                                    <td class="text-primary">{{$payment->subscription->package->name}}</td>
                                </tr> 
                            @else
                                <tr>
                                    <td><strong>{{__('AddOn name')}}</strong></td>
                                    <td class="text-primary">{{$payment->AddOnPurchase->AddOn->name}}</td>
                                </tr>
                            @endif
                            <tr>
                                <td><strong>{{__('Status')}}</strong></td>
                                <td class="{{$payment->status}}">{{$payment->status}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Created date')}}</strong></td>
                                <td>{{$payment->created_at}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Updated date')}}</strong></td>
                                <td>{{$payment->updated_at}}</td>
                            </tr>
                        </tbody>
                    </table>
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
