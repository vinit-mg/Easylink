<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Store comapnies') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('admin.customers.create') }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add Customer')}}</a>
                        </div> 
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Customer no.')}}</th>
                                    <th>{{__('Company name')}}</th>
                                    <th>{{__('Company logo')}}</th>
                                    <th>{{__('Country')}}</th>
                                    <th>{{__('Zip code')}}</th>
                                    <th>{{__('City')}}</th>
                                    <th>{{__('CVR-no')}}</th>
                                    <th>{{__('Dealer')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $Customer)
                                    <tr>
                                        <td>  {{ $Customer->CustomerNo }}</td>
                                        <td>  {{ $Customer->CompanyName }}</td>
                                        <td>  <img width="150" src="{{asset( $Customer->CompanyLogo)}}"> </td>
                                        <td>  {{ $Customer->Country }}</td>
                                        <td>  {{ $Customer->ZipCode }}</td>
                                        <td>  {{ $Customer->Town }}</td>
                                        <td>  {{ $Customer->CVR_no }}</td>
                                        <td>  {{ $Customer->Dealer }}</td>
                                        <td>  {{ $Customer->IsActive ? __('Active') : __('Inactive')}}</td>
                                        <td>
                                            @canany(['adminUpdate', 'adminDelete'], $Customer)
                                                <form action="{{ route('admin.customers.destroy', $Customer->uuid) }}" method="POST">
                                                   
                                                    <div class="flex">
                                                        @can('adminView', $Customer)
                                                            <a href="{{route('admin.customers.show', $Customer->uuid)}}" class="btn btn-primary"><i class="bi bi-display"></i></a>
                                                        @endcan
                                                        @can('adminUpdate', $Customer)
                                                            <a href="{{route('admin.customers.edit', $Customer->uuid)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                        @endcan
                                                        @can('adminDelete', $Customer)
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
                                @if($customers->isEmpty())
                                    <tr>
                                        <td colspan="3">
                                            {{ __('No customers found') }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <!-- End Table with stripped rows -->
                        {{ $customers->appends(request()->query())->links() }}

                    </div>
                </div>

            </div>
        </div>
      </section>
</x-admin.wrapper>
