<x-admin.wrapper>
    <x-slot name="title">
        {{ __('AddOn addon features') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('admin.addonfeatures.create') }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add addon features')}}</a>
                        </div> 
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Feature name')}}</th>
                                    <th>{{__('AddOn name')}}</th>
                                    <th>{{__('source')}}</th>
                                    <th>{{__('destination')}}</th>
                                    <th>{{__('Created at')}}</th>
                                    <th>{{__('Updated at')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($addonfeatures as $addonfeature)
                                    <tr>
                                        <td>  {{ $addonfeature->name }}</td>
                                        <td>  {{ $addonfeature->addOn->name }}</td>
                                        <td>  {{ $addonfeature->source->name }}</td>
                                        <td>  {{ $addonfeature->destination->name }}</td>
                                        <td>  {{ $addonfeature->created_at }}</td>
                                        <td>  {{ $addonfeature->updated_at }}</td>
                                        <td>
                                            @canany(['adminUpdate', 'adminDelete', 'adminView'], $addonfeature)
                                                <form action="{{ route('admin.addonfeatures.destroy', $addonfeature->id) }}" method="POST">
                                                   
                                                    <div class="flex">
                                                        @can('adminView', $addonfeature)
                                                            <a href="{{route('admin.addonfeatures.show', $addonfeature->id)}}" class="btn btn-primary"><i class="bi bi-display"></i></a>
                                                        @endcan
                                                        @can('adminUpdate', $addonfeature)
                                                            <a href="{{route('admin.addonfeatures.edit', $addonfeature->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                        @endcan
                                                        
                                                        @can('adminDelete', $addonfeature)
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
                                @if($addonfeatures->isEmpty())
                                    <tr>
                                        <td colspan="7">
                                            {{ __('No AddOn feature found') }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
      </section>
</x-admin.wrapper>
