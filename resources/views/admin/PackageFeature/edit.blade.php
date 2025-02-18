<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Package Features') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                  <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                    <h5>{{__('Update Package Features')}}</h5>
                    <a class="btn btn-primary" href="{{route('admin.packagefeatures.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all package Features')}}</a>
                  </div> 
                  <form class="row g-3" method="POST" action="{{ route('admin.packagefeatures.update', $packagefeature->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="package_id" class="form-label">{{__('Select Package')}}</label>
                        <select name="package_id" id="package_id" class="form-select">
                            <option> Select Package</option>
                            @foreach($Packages as $Package)
                                <option value="{{$Package->id}}" {{$packagefeature->package_id  == $Package->id? 'selected' : '' }}>{{$Package->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="source_id" class="form-label">{{__('Select source')}}</label>
                        <select name="source_id" id="source_id" class="form-select">
                            <option> Select source</option>
                            @foreach($Sources as $Source)
                                <option value="{{$Source->id}}" {{$packagefeature->source_id  == $Source->id ? 'selected' : '' }}>{{$Source->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="destination_id" class="form-label">{{__('Select destination')}}</label>
                        <select name="destination_id" id="destination_id" class="form-select">
                            <option> Select destination</option>
                            @foreach($Destinations as $Destination)
                                <option value="{{$Destination->id}}" {{$packagefeature->destination_id  == $Destination->id ? 'selected' : '' }}>{{$Destination->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="feature_name" class="form-label">{{__('Feature name')}}</label>
                        <input type="text" class="form-control" name="feature_name" id="feature_name" value="{{$packagefeature->feature_name}}">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="type" class="form-label">{{__('Type')}}</label>
                        <select name="type" id="type" class="form-select">
                            <option> Select type</option>
                            <option value="order" {{$packagefeature->type  == 'order' ? 'selected' : '' }}>{{__('Order')}}</option>
                            <option value="inventory"  {{$packagefeature->type  == 'inventory' ? 'selected' : '' }}>{{__('Inventory')}}</option>
                            <option value="product"  {{$packagefeature->type  == 'product' ? 'selected' : '' }}>{{__('Product')}}</option>
                            <option value="customer"  {{$packagefeature->type  == 'customer' ? 'selected' : '' }}>{{__('Customer')}}</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="included_in_package" id="included_in_package" {{$packagefeature->included_in_package ? 'checked' : '' }}>
                            <label class="form-check-label" for="included_in_package">{{__('Default included in a package')}}</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="include_scheduler" id="include_scheduler" {{$packagefeature->include_scheduler ? 'checked' : '' }}>
                            <label class="form-check-label" for="include_scheduler">{{__('included in a scheduler')}}</label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="default_limit" class="form-label">{{__('Default limit')}}</label>
                        <input type="number" class="form-control" name="default_limit" id="default_limit" value="{{$packagefeature->default_limit}}">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" fdprocessedid="ufar4">{{__('update')}}</button>
                    </div>
                </form>    
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
