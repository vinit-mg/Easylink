<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Store Packages') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                  <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                    <h5>{{__('Update Package')}}</h5>
                    <a class="btn btn-primary" href="{{route('admin.packages.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all packages')}}</a>
                  </div> 
                  <form class="row g-3" method="POST" action="{{ route('admin.packages.update', $package->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="name" class="form-label">{{__('Package Name')}}</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$package->name}}">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="price" class="form-label">{{__('Monthly base price')}}</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text">Kr.</span>
                          <input type="number" class="form-control" min="0" step="1.00" name="base_price_monthly" value="{{$package->base_price_monthly}}">
                        </div>
                    </div>  
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="price" class="form-label">{{__('Yearly base price')}}</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text">Kr.</span>
                          <input type="number" class="form-control" min="0" step="1.00" name="base_price_yearly" value="{{$package->base_price_yearly}}">
                        </div>
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
