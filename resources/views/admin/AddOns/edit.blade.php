<x-admin.wrapper>
    <x-slot name="title">
        {{ __('AddOns') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                  <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                    <h5>{{__('Update AddOn')}}</h5>
                    <a class="btn btn-primary" href="{{route('admin.addon.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all AddOns')}}</a>
                  </div> 
                  <form class="row g-3" method="POST" action="{{ route('admin.addon.update', $addon->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="name" class="form-label">{{__('Name')}}</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$addon->name}}">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="price" class="form-label">{{__('Price')}}</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Kr.</span>
                            <input type="number" class="form-control" name="price" id="price" min="0" step="1.00" value="{{$addon->price}}">
                            <span class="input-group-text">/Unit</span>
                          </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="description" class="form-label">{{__('Description')}}</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$addon->description}}</textarea>
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
