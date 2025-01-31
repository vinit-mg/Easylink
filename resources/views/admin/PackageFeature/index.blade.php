<x-admin.wrapper>
    <x-slot name="title">
        {{ __('AddOn package features') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('admin.packagefeatures.create') }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add package features')}}</a>
                        </div> 
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Package name')}}</th>
                                    <th>{{__('Features name')}}</th>
                                    <th>{{__('type')}}</th>
                                    <th>{{__('source')}}</th>
                                    <th>{{__('destination')}}</th>
                                    <th>{{__('Created at')}}</th>
                                    <th>{{__('Updated at')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packagefeatures as $packagefeature)
                                    <tr>
                                        <td>  {{ $packagefeature->package->name }}</td>
                                        <td>  {{ $packagefeature->feature_name }}</td>
                                        <td>  {{ $packagefeature->type }}</td>
                                        <td>  {{ $packagefeature->source->name }}</td>
                                        <td>  {{ $packagefeature->destination->name }}</td>
                                        <td>  {{ $packagefeature->created_at }}</td>
                                        <td>  {{ $packagefeature->updated_at }}</td>
                                        <td>
                                            @canany(['adminUpdate', 'adminDelete', 'adminView'], $packagefeature)
                                                <form action="{{ route('admin.packagefeatures.destroy', $packagefeature->id) }}" method="POST">
                                                   
                                                    <div class="flex">
                                                        @can('adminView', $packagefeature)
                                                            <a href="{{route('admin.packagefeatures.show', $packagefeature->id)}}" class="btn btn-primary"><i class="bi bi-display"></i></a>
                                                        @endcan
                                                        @can('adminUpdate', $packagefeature)
                                                            <a href="{{route('admin.packagefeatures.edit', $packagefeature->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                        @endcan
                                                        
                                                        @can('adminDelete', $packagefeature)
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
                                @if($packagefeatures->isEmpty())
                                    <tr>
                                        <td colspan="8">
                                            {{ __('No package feature found') }}
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
