<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Packages') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                    <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                        <h5>{{__('Package')}}</h5>
                        <a class="btn btn-primary" href="{{route('admin.packages.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all packages')}}</a>
                    </div> 
                    <div class="d-flex justify-content-around text-center">
                        <div class="card mb-4 box-shadow">
                            <div class="card-header"><h4 class="my-0 font-weight-normal">{{$package->name}}</h4></div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">{{$package->base_price_monthly}} Kr. <small class="text-muted">/ Monthly</small></h1>
                            </div>
                        </div>
                        <div class="card mb-4 box-shadow">
                            <div class="card-header"><h4 class="my-0 font-weight-normal">{{$package->name}}</h4></div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">{{$package->base_price_yearly}} Kr. <small class="text-muted">/ Yearly</small></h1>
                            </div>
                        </div>
                    </div>  
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
