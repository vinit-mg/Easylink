<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Ackro Shipping Codes') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('admin.ackroshippingcodes.create') }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add ackro shipping code')}}</a>
                        </div> 
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Code')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Created at')}}</th>
                                    <th>{{__('Updated at')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($AckroShippingCodes as $AckroShippingCode)
                                    <tr>
                                        <td>  {{ $AckroShippingCode->name }}</td>
                                        <td>  {{ $AckroShippingCode->code }}</td>
                                        <td>  {{ $AckroShippingCode->IsActive ? __('Active') : __('InActive') }}</td>
                                        <td>  {{ $AckroShippingCode->created_at }}</td>
                                        <td>  {{ $AckroShippingCode->updated_at }}</td>
                                        <td>
                                            @canany(['adminUpdate', 'adminDelete', 'adminView'], $AckroShippingCode)
                                                <form action="{{ route('admin.ackroshippingcodes.destroy', $AckroShippingCode->id) }}" method="POST">
                                                   
                                                    <div class="flex">
                                                        @can('adminView', $AckroShippingCode)
                                                            <a href="{{route('admin.ackroshippingcodes.show', $AckroShippingCode->id)}}" class="btn btn-primary"><i class="bi bi-display"></i></a>
                                                        @endcan
                                                        @can('adminUpdate', $AckroShippingCode)
                                                            <a href="{{route('admin.ackroshippingcodes.edit', $AckroShippingCode->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                        @endcan
                                                        
                                                        @can('adminDelete', $AckroShippingCode)
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
                                @if($AckroShippingCodes->isEmpty())
                                    <tr>
                                        <td colspan="7">
                                            {{ __('No Ackro Shipping Code found') }}
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
