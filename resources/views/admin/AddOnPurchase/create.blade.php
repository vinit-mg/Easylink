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
                    <h5>{{__('Create AddOns Purchase')}}</h5>
                    <a class="btn btn-primary" href="{{route('admin.customers.show', $customer->uuid)}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back customer')}}</a>
                  </div> 
                  <form class="row g-3" method="POST" action="{{ route('admin.customer.addonpurchase.store', $customer->uuid) }}">
                    @csrf
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="add_on_id" class="form-label">{{__('Select AddOn')}}</label>
                        <select name="add_on_id" id="add_on_id" class="form-select">
                            <option value="">{{__('Select AddOn')}}</option>
                            @foreach ($AddOns as $AddOn)
                                <option value="{{$AddOn->id}}" {{old('add_on_id')==$AddOn->id ? 'selected' : ''}}>{{$AddOn->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="type" class="form-label">{{__('Quantity')}}</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="{{old('quantity')}}">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="addon_price" class="form-label">{{__('AddOn price')}}</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Kr.</span>
                            <input type="number" name="addon_price" class="form-control" min="0" step="1.00" value="{{old('addon_price')}}">
                            <span class="input-group-text">/Unit</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="total_price" class="form-label">{{__('AddOn total price')}}</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Kr.</span>
                            <input type="number" name="total_price" id="total_price" class="form-control" min="0" step="1.00" value="{{old('total_price')}}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="purchased_at" class="form-label">{{__('Purchased date')}}</label>
                        <input type="datetime-local" class="form-control" name="purchased_at" id="purchased_at" value="{{old('purchased_at')}}">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" fdprocessedid="ufar4">{{__('Create')}}</button>
                    </div>
                </form>    
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
