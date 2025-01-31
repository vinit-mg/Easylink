<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Ackro Shipping Codes') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                  <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                    <h5>{{__('Create ackro shipping code')}}</h5>
                    <a class="btn btn-primary" href="{{route('admin.ackroshippingcodes.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all ackro shipping code')}}</a>
                  </div> 
                  <form class="row g-3" method="POST" action="{{ route('admin.ackroshippingcodes.store') }}">
                    @csrf
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="name" class="form-label">{{__('Name')}}</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="code" class="form-label">{{__('Code')}}</label>
                        <input type="text" class="form-control" name="code" id="code">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="IsActive" name="IsActive">
                            <label for="IsActive" class="form-label">{{__('Active')}}</label>
                        </div>
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
