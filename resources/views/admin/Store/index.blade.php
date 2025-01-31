<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Stores') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('admin.stores.create') }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add store')}}</a>
                        </div> 
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Store name')}}</th>
                                    <th>{{__('Subject')}}</th>
                                    <th>{{__('Source')}}</th>
                                    <th>{{__('Destination')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stores as $store)
                                    <tr>
                                        <td>{{$store->name}}</td>
                                        <td>{{$store->customer->CompanyName}}</td>
                                        <td>{{$store->source->name}}</td>
                                        <td>{{$store->destination->name}}</td>
                                        <td> 
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" data-for='store'  data-id="{{$store->id}}" data-name="{{$store->name}}" type="checkbox" name="IsActive" id="IsActive" {{$store->IsActive ? 'checked' : ''}}>
                                            </div>
                                        </td>
                                        <td>
                                            @canany(['adminUpdate', 'adminDelete'], $store)
                                                <form action="{{ route('admin.stores.destroy', $store->uuid) }}" method="POST">
                                                    <div class="flex">
                                                        @can('adminView', $store)
                                                            <a href="{{route('admin.stores.manage', $store->uuid)}}" class="btn btn-primary"><i class="bi bi-gear"></i></a>
                                                        @endcan
                                                        @can('adminUpdate', $store)
                                                            <a class="btn btn-primary" href="{{route('admin.stores.edit', $store->uuid)}}"><i class="bi bi-pencil-square"></i></a>
                                                        @endcan
                                                        @can('adminDelete', $store)
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
                                @if($stores->isEmpty())
                                    <tr>
                                        <td colspan="5">
                                            {{ __('No stores found') }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <!-- End Table with stripped rows -->
                        {{ $stores->appends(request()->query())->links() }}

                    </div>
                </div>

            </div>
        </div>
      </section>
</x-admin.wrapper>
