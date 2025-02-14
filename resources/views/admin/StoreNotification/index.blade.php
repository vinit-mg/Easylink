<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Store notification') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <button type="button" class="btn update-btn btn-primary rounded-pill mt-3" fdprocessedid="tuoo0e">Add store notification</button>
                        </div> 
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>{{__('Template name')}}</th>
                                    <th>{{__('Store name')}}</th>
                                    <th>{{__('Customer name')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($storenotifications as $storenotification)
                                    <tr>
                                        <td> {{ $storenotification->emailtemplate->TemplateName }}</td>
                                        <td> {{ $storenotification->Customer->CompanyName }}</td>
                                        <td>  {{ $storenotification->store->StoreName }}</td>
                                        <td>
                                            @canany(['adminUpdate', 'adminDelete'], $EmailTemplate)
                                            <x-admin.grid.td>
                                                <form action="{{ route('admin.storenotification.destroy', $storenotification->id) }}" method="POST">
                                                   
                                                    <div class="flex">
                                                        @can('adminUpdate', $EmailTemplate)
                                                            <a href="{{route('admin.storenotification.edit', $storenotification->id)}}"><i class="bi bi-pencil-square"></i></a>
                                                        @endcan
                                                        @can('adminDelete', $EmailTemplate)
                                                        @csrf
                                                        @method('DELETE')
                                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                        @endcan
                                                    </div>
                                                </form>
                                            </x-admin.grid.td>
                                            @endcanany
                                        </td>
                                    </tr>
                                @endforeach
                                @if($storenotifications->isEmpty())
                                    <tr>
                                        <td colspan="3">
                                            {{ __('No store notification found') }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <!-- End Table with stripped rows -->
                        {{ $storenotifications->appends(request()->query())->links() }}

                    </div>
                </div>

            </div>
        </div>
      </section>
</x-admin.wrapper>
