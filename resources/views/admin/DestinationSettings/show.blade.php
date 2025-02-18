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
                        <h5>{{__('Destination setting')}}</h5>
                        <a class="btn btn-primary" href="{{route('admin.destinationsettings.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all destination settings')}}</a>
                    </div> 
                   
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>{{__('Destination')}}</strong></td>
                                <td>{{$destinationsetting->destination->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Package feature')}}</strong></td>
                                <td>{{$destinationsetting->package_feature->feature_name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Setting name')}}</strong></td>
                                <td>{{$destinationsetting->setting_name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Setting key')}}</strong></td>
                                <td>{{$destinationsetting->setting_key}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Setting description')}}</strong></td>
                                <td>{{$destinationsetting->setting_description}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Status')}}</strong></td>
                                <td>{{$destinationsetting->IsActive ? 'Active' : 'Inactive'}}</td>
                            </tr> 
                            <tr>
                                <td><strong>{{__('Created date')}}</strong></td>
                                <td>{{$destinationsetting->created_at}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Updated date')}}</strong></td>
                                <td>{{$destinationsetting->updated_at}}</td>
                            </tr>
                        </tbody>
                    </table>
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
