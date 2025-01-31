<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Source settings') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('admin.sourcesettings.create') }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add Source Setting')}}</a>
                        </div> 
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Source')}}</th>
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
                              @foreach ($SourceSettings as $SourceSetting)
                                  <tr>
                                    <td>{{$SourceSetting->source->name}}</td>
                                    <td>{{$SourceSetting->package_feature->feature_name}}</td>
                                    <td>{{$SourceSetting->setting_name}}</td>
                                    <td>{{$SourceSetting->setting_key}}</td>
                                    <td>{{$SourceSetting->IsActive ? 'Active' : 'Inactive'}}</td>
                                    <td>{{$SourceSetting->created_at}}</td>
                                    <td>{{$SourceSetting->updated_at}}</td>
                                    <td>
                                        @canany(['adminUpdate', 'adminDelete', 'adminView'], $SourceSetting)
                                            <form action="{{ route('admin.sourcesettings.destroy', $SourceSetting->id) }}" method="POST">
                                               
                                                <div class="flex">
                                                    @can('adminView', $SourceSetting)
                                                        <a href="{{route('admin.sourcesettings.show', $SourceSetting->id)}}" class="btn btn-primary"><i class="bi bi-display"></i></a>
                                                    @endcan
                                                    @can('adminUpdate', $SourceSetting)
                                                        <a href="{{route('admin.sourcesettings.edit', $SourceSetting->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                    @endcan
                                                    
                                                    @can('adminDelete', $SourceSetting)
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
                              @if($SourceSettings->isEmpty())
                              <tr>
                                  <td colspan="8">
                                      {{ __('No source settings found') }}
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
