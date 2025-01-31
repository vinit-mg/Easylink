<x-admin.wrapper>
    <x-slot name="title">
        {{ __('AddOn Features') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                  <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                    <h5>{{__('Update AddOn Features')}}</h5>
                    <a class="btn btn-primary" href="{{route('admin.addonfeatures.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all AddOn Features')}}</a>
                  </div> 
                  <form class="row g-3" method="POST" action="{{ route('admin.addonfeatures.update', $addonfeature->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="name" class="form-label">{{__('Feature name')}}</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$addonfeature->name}}">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="add_on_id" class="form-label">{{__('Select AddOn')}}</label>
                        <select name="add_on_id" id="add_on_id" class="form-select">
                            <option> Select AddOn</option>
                            @foreach($AddOns as $AddOn)
                                <option value="{{$AddOn->id}}" {{$addonfeature->add_on_id == $AddOn->id ? 'selected' : ''}}>{{$AddOn->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="source_id" class="form-label">{{__('Select source')}}</label>
                        <select name="source_id" id="source_id" class="form-select">
                            <option> Select source</option>
                            @foreach($Sources as $Source)
                                <option value="{{$Source->id}}" {{$addonfeature->source_id == $Source->id ? 'selected' : ''}}>{{$Source->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="destination_id" class="form-label">{{__('Select destination')}}</label>
                        <select name="destination_id" id="destination_id" class="form-select">
                            <option> Select destination</option>
                            @foreach($Destinations as $Destination)
                                <option value="{{$Destination->id}}" {{$addonfeature->destination_id == $Destination->id ? 'selected' : ''}}>{{$Destination->name}}</option>
                            @endforeach
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
