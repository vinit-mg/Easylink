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
                        <h5>{{__('AddOn Feature')}}</h5>
                        <a class="btn btn-primary" href="{{route('admin.addonfeatures.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all AddOn features')}}</a>
                    </div> 
                   
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>{{__('Feature name')}}</strong></td>
                                <td>{{$addonfeature->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('AddOn name')}}</strong></td>
                                <td>{{$addonfeature->AddOn->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Source')}}</strong></td>
                                <td>{{$addonfeature->source->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Destination')}}</strong></td>
                                <td>{{$addonfeature->destination->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Created date')}}</strong></td>
                                <td>{{$addonfeature->created_at}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Updated date')}}</strong></td>
                                <td>{{$addonfeature->updated_at}}</td>
                            </tr>
                        </tbody>
                    </table>
              </div>
            </div>
          </div>
        </div>
      </section>
</x-admin.wrapper>
