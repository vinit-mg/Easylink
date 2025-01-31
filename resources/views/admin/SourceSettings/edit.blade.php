<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Source Settings') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                  <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                    <h5>{{__('Update Source Setting')}}</h5>
                    <a class="btn btn-primary" href="{{route('admin.sourcesettings.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all source settings')}}</a>
                  </div> 
                  <form class="row g-3" method="POST" action="{{ route('admin.sourcesettings.update', $sourcesetting->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="source_id" class="form-label">{{__('Source')}}</label>
                        <select name="source_id" id="source_id" class="form-select">
                            @foreach ($Sources as $Source)
                                <option value="{{$Source->id}}" {{$sourcesetting->source_id == $Source->id ? 'selected' : ''}}>{{$Source->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="package_feature_id" class="form-label">{{__('Package feature ')}}</label>
                        <select name="package_feature_id" id="package_feature_id" class="form-select">
                            @foreach ($PackageFeatures as $PackageFeature)
                                <option value="{{$PackageFeature->id}}" {{$sourcesetting->package_feature_id == $PackageFeature->id ? 'selected' : ''}}>{{$PackageFeature->feature_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="setting_name" class="form-label">{{__('Setting name')}}</label>
                        <input type="text" name="setting_name" id="setting_name" class="form-control" value="{{$sourcesetting->setting_name}}">
                    </div>  
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="setting_key" class="form-label">{{__('Setting key')}}</label>
                        <input type="text" name="setting_key" id="setting_key" class="form-control" value="{{$sourcesetting->setting_key}}">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="setting_description" class="form-label">{{__('Setting description')}}</label>
                        <textarea name="setting_description" id="setting_description" class="form-control">{{$sourcesetting->setting_description}}</textarea>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="IsActive" name="IsActive" {{$sourcesetting->IsActive ? 'checked' : '' }}>
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
