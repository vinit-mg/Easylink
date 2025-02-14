<x-admin.wrapper>
    <x-slot name="title">
        {{ __('AddOn Purchases') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('admin.addonpurchase.create') }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add AddOn Purchases')}}</a>
                        </div> 
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Customer name')}}</th>
                                    <th>{{__('AddOn name')}}</th>
                                    <th>{{__('Quantity')}}</th>
                                    <th>{{__('Total price')}}</th>
                                    <th>{{__('Purchased at')}}</th>
                                    <th>{{__('Created at')}}</th>
                                    <th>{{__('Updated at')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($addOnPurchases as $addOnPurchase)
                                    <tr>
                                        <td>  {{ $addOnPurchase->Customer_subscription->Customer->CompanyName }}</td>
                                        <td>  {{ $addOnPurchase->addOn->name }}</td>
                                        <td>  {{ $addOnPurchase->quantity }}</td>
                                        <td>  {{ $addOnPurchase->total_price }}</td>
                                        <td>  {{ $addOnPurchase->purchased_at }}</td>
                                        <td>  {{ $addOnPurchase->created_at }}</td>
                                        <td>  {{ $addOnPurchase->updated_at }}</td>
                                        <td>
                                            @canany(['adminUpdate', 'adminDelete', 'adminView'], $addOnPurchase)
                                                <form action="{{ route('admin.addonpurchase.destroy', $addOnPurchase->id) }}" method="POST">
                                                   
                                                    <div class="flex">
                                                        @can('adminView', $addOnPurchase)
                                                            <a href="{{route('admin.addonpurchase.show', $addOnPurchase->id)}}" class="btn btn-primary"><i class="bi bi-display"></i></a>
                                                        @endcan
                                                        @can('adminUpdate', $addOnPurchase)
                                                            <a href="{{route('admin.addonpurchase.edit', $addOnPurchase->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                        @endcan
                                                        
                                                        @can('adminDelete', $addOnPurchase)
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
                                @if($addOnPurchases->isEmpty())
                                    <tr>
                                        <td colspan="3">
                                            {{ __('No AddOn purchase found') }}
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
