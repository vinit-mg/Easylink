<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Subscription') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                    <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                        <h5>{{__('Package')}}</h5>
                        <a class="btn btn-primary" href="{{route('admin.packagefeatures.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all package features')}}</a>
                    </div> 
                   
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>{{__('Package name')}}</strong></td>
                                <td>{{$packagefeature->package->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Feature name')}}</strong></td>
                                <td>{{$packagefeature->feature_name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Type')}}</strong></td>
                                <td>{{$packagefeature->type}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Source')}}</strong></td>
                                <td>{{$packagefeature->source->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Destination')}}</strong></td>
                                <td>{{$packagefeature->destination->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Included in pacakage')}}</strong></td>
                                <td>{{$packagefeature->included_in_package ? 'Yes' : 'No'}}</td>
                            </tr> 
                            <tr>
                                <td><strong>{{__('Included in scheduler')}}</strong></td>
                                <td>{{$packagefeature->include_scheduler ? 'Yes' : 'No'}}</td>
                            </tr> 
                            <tr>
                                <td><strong>{{__('Default limit')}}</strong></td>
                                <td>{{$packagefeature->default_limit}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Created date')}}</strong></td>
                                <td>{{$packagefeature->created_at}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Updated date')}}</strong></td>
                                <td>{{$packagefeature->updated_at}}</td>
                            </tr>
                        </tbody>
                    </table>
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
