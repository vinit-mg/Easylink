<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Store Packages') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('admin.packages.create') }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add Package')}}</a>
                        </div> 
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Package Name')}}</th>
                                    <th>{{__('Monthly Price')}}</th>
                                    <th>{{__('Yearly Price')}}</th>
                                    <th>{{__('Created at')}}</th>
                                    <th>{{__('Updated at')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packages as $package)
                                    <tr>
                                        <td>  {{ $package->name }}</td>
                                        <td>  {{ $package->base_price_monthly }}</td>
                                        <td>  {{ $package->base_price_yearly }}</td>
                                        <td>  {{ $package->created_at }}</td>
                                        <td>  {{ $package->updated_at }}</td>
                                        <td>
                                            @canany(['adminUpdate', 'adminDelete', 'adminView'], $package)
                                                <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST">
                                                   
                                                    <div class="flex">
                                                        @can('adminView', $package)
                                                            <a href="{{route('admin.packages.show', $package->id)}}" class="btn btn-primary"><i class="bi bi-display"></i></a>
                                                        @endcan
                                                        @can('adminUpdate', $package)
                                                            <a href="{{route('admin.packages.edit', $package->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                        @endcan
                                                        
                                                        @can('adminDelete', $package)
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
                                @if($packages->isEmpty())
                                    <tr>
                                        <td colspan="5">
                                            {{ __('No packages found') }}
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
