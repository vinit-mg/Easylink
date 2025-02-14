<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Destination Settings') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                  <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                    <h5>{{__('Update Destination Setting')}}</h5>
                    <a class="btn btn-primary" href="{{route('admin.destinationsettings.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all destination settings')}}</a>
                  </div> 
                  <form class="row g-3" method="POST" action="{{ route('admin.destinationsettings.update', $destinationsetting->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="destination_id" class="form-label">{{__('Destination')}}</label>
                        <select name="destination_id" id="destination_id" class="form-select">
                            @foreach ($Destinations as $Destination)
                                <option value="{{$Destination->id}}" {{$destinationsetting->destination_id == $Destination->id ? 'selected' : ''}}>{{$Destination->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="package_feature_id" class="form-label">{{__('Package feature ')}}</label>
                        <select name="package_feature_id" id="package_feature_id" class="form-select">
                            @foreach ($PackageFeatures as $PackageFeature)
                                <option value="{{$PackageFeature->id}}" {{$destinationsetting->package_feature_id == $PackageFeature->id ? 'selected' : ''}}>{{$PackageFeature->feature_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="setting_name" class="form-label">{{__('Setting name')}}</label>
                        <input type="text" name="setting_name" id="setting_name" class="form-control" value="{{$destinationsetting->setting_name}}">
                    </div>  
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="setting_key" class="form-label">{{__('Setting key')}}</label>
                        <input type="text" name="setting_key" id="setting_key" class="form-control" value="{{$destinationsetting->setting_key}}">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="setting_description" class="form-label">{{__('Setting description')}}</label>
                        <textarea name="setting_description" id="setting_description" class="form-control">{{$destinationsetting->setting_description}}</textarea>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="IsActive" name="IsActive" {{$destinationsetting->IsActive ? 'checked' : '' }}>
                            <label for="IsActive" class="form-label">{{__('Active')}}</label>
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
