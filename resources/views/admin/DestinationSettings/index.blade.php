<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Destination settings') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('admin.destinationsettings.create') }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add Destination Setting')}}</a>
                        </div> 
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Destination')}}</th>
                                    <th>{{__('Package feature')}}</th>
                                    <th>{{__('Setting name')}}</th>
                                    <th>{{__('Setting key')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('created at')}}</th>
                                    <th>{{__('Updated at')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($DestinationSettings as $DestinationSetting)
                                  <tr>
                                    <td>{{$DestinationSetting->destination->name}}</td>
                                    <td>{{$DestinationSetting->package_feature->feature_name}}</td>
                                    <td>{{$DestinationSetting->setting_name}}</td>
                                    <td>{{$DestinationSetting->setting_key}}</td>
                                    <td>{{$DestinationSetting->IsActive ? 'Active' : 'Inactive'}}</td>
                                    <td>{{$DestinationSetting->created_at}}</td>
                                    <td>{{$DestinationSetting->updated_at}}</td>
                                    <td>
                                        @canany(['adminUpdate', 'adminDelete', 'adminView'], $DestinationSetting)
                                            <form action="{{ route('admin.destinationsettings.destroy', $DestinationSetting->id) }}" method="POST">
                                               
                                                <div class="flex">
                                                    @can('adminView', $DestinationSetting)
                                                        <a href="{{route('admin.destinationsettings.show', $DestinationSetting->id)}}" class="btn btn-primary"><i class="bi bi-display"></i></a>
                                                    @endcan
                                                    @can('adminUpdate', $DestinationSetting)
                                                        <a href="{{route('admin.destinationsettings.edit', $DestinationSetting->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                    @endcan
                                                    
                                                    @can('adminDelete', $DestinationSetting)
                                                    @csrf
                                                    @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                    @endcan
                                                </div>
                                            </form>
                                        @endcanany
                                    </td>
                                  </tr>
                              @endforeach
                              @if($DestinationSettings->isEmpty())
                              <tr>
                                  <td colspan="8">
                                      {{ __('No Destinations settings found') }}
                                  </td>
                              </tr>
                          @endif
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
      </section>
</x-admin.wrapper>
