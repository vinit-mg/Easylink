<x-admin.wrapper>
    <x-slot name="title">
        {{ __('AddOns') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('admin.addon.create') }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add AddOn')}}</a>
                        </div> 
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('AddOn name')}}</th>
                                    <th>{{__('AddOn price')}}</th>
                                    <th>{{__('Created at')}}</th>
                                    <th>{{__('Updated at')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($addOns as $addOn)
                                    <tr>
                                        <td>  {{ $addOn->name }}</td>
                                        <td>  {{ $addOn->price }}</td>
                                        <td>  {{ $addOn->created_at }}</td>
                                        <td>  {{ $addOn->updated_at }}</td>
                                        <td>
                                            @canany(['adminUpdate', 'adminDelete', 'adminView'], $addOn)
                                                <form action="{{ route('admin.addon.destroy', $addOn->id) }}" method="POST">
                                                   
                                                    <div class="flex">
                                                        @can('adminView', $addOn)
                                                            <a href="{{route('admin.addon.show', $addOn->id)}}" class="btn btn-primary"><i class="bi bi-display"></i></a>
                                                        @endcan
                                                        @can('adminUpdate', $addOn)
                                                            <a href="{{route('admin.addon.edit', $addOn->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                        @endcan
                                                        
                                                        @can('adminDelete', $addOn)
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
                                @if($addOns->isEmpty())
                                    <tr>
                                        <td colspan="3">
                                            {{ __('No addOns found') }}
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
