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
                        <h5>{{__('Source Setting')}}</h5>
                        <a class="btn btn-primary" href="{{route('admin.sourcesettings.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all source settings')}}</a>
                    </div> 
                   
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>{{__('Source')}}</strong></td>
                                <td>{{$sourcesetting->source->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Package feature')}}</strong></td>
                                <td>{{$sourcesetting->package_feature->feature_name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Setting name')}}</strong></td>
                                <td>{{$sourcesetting->setting_name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Setting key')}}</strong></td>
                                <td>{{$sourcesetting->setting_key}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Setting description')}}</strong></td>
                                <td>{{$sourcesetting->setting_description}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Status')}}</strong></td>
                                <td>{{$sourcesetting->IsActive ? 'Active' : 'Inactive'}}</td>
                            </tr> 
                            <tr>
                                <td><strong>{{__('Created date')}}</strong></td>
                                <td>{{$sourcesetting->created_at}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Updated date')}}</strong></td>
                                <td>{{$sourcesetting->updated_at}}</td>
                            </tr>
                        </tbody>
                    </table>
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
