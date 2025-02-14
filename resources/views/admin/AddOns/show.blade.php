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
                        <h5>{{__('Package')}}</h5>
                        <a class="btn btn-primary" href="{{route('admin.addon.index')}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to all subscriptions')}}</a>
                    </div> 
                   
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>{{__('Name')}}</strong></td>
                                <td>{{$addon->name}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Price')}}</strong></td>
                                <td>{{$addon->price}}</td>
                            </tr>
                            <tr>
                                <td><strong>{{__('Description')}}</strong></td>
                                <td>{{$addon->description}}</td>
                            </tr>
                        </tbody>
                    </table>
              </div>
            </div>
  
          </div>
        </div>
      </section>
</x-admin.wrapper>
