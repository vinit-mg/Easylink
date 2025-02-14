<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Update Subscriptions') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                  <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                    <h5>{{__('Update subscription')}}</h5>
                    <a class="btn btn-primary" href="{{route('admin.customers.show', $customer->uuid)}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to customer')}}</a>
                  </div> 
                  <form class="row g-3" method="POST" action="{{ route('admin.customer.subscriptions.update', [$customer->uuid, $subscription->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="Customer_id" class="form-label">{{__('Ssubscription Customer')}}</label>
                        <select name="Customer_id" id="Customer_id" class="form-select" disabled>
                            <option value="{{$customer->id}}">{{$customer->CompanyName}}</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="package_id" class="form-label">{{__('Select subscription package')}}</label>
                        <select name="package_id" id="package_id" class="form-select">
                            <option> Select subscription plan</option>
                            @foreach($Packages as $Package)
                                <option value="{{$Package->id}}" {{$subscription->package_id == $Package->id ? 'selected' : ''}}>{{$Package->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="billing_cycle" class="form-label">{{__('Billing cycle')}}</label>
                        <select name="billing_cycle" id="billing_cycle" class="form-select">
                            <option>Select billing cycle</option>
                            <option value="monthly" {{$subscription->billing_cycle == 'monthly' ? 'selected' : ''}}>{{__('Monthly')}}</option>
                            <option value="yearly" {{$subscription->billing_cycle == 'yearly' ? 'selected' : ''}}>{{__('Yearly')}}</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="start_date" class="form-label">{{__('Start date')}}</label>
                        <input type="datetime-local" class="form-control" name="start_date" id="start_date" value="{{$subscription->start_date}}">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="end_date" class="form-label">{{__('End date')}}</label>
                        <input type="datetime-local" class="form-control" name="end_date" id="end_date" value="{{$subscription->end_date}}">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="status" class="form-label">{{__('Status')}}</label>
                        <select name="status" id="status" class="form-select">
                            <option>Select status</option>
                            <option value="active" {{$subscription->status == 'active' ? 'selected' : ''}}>{{__('Active')}}</option>
                            <option value="pending" {{$subscription->status == 'pending' ? 'selected' : ''}}>{{__('Pending')}}</option>
                            <option value="expired" {{$subscription->status == 'expired' ? 'selected' : ''}}>{{__('Expired')}}</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" fdprocessedid="ufar4">{{__('Update')}}</button>
                    </div>
                </form>    
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
