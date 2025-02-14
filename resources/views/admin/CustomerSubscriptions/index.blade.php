<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Store Subscriptions') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('admin.customersubscriptions.create') }}" class="btn update-btn btn-primary rounded-pill mt-3">{{__('Add Subscriptions')}}</a>
                        </div> 
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Customer name')}}</th>
                                    <th>{{__('Package name')}}</th>
                                    <th>{{__('Billing cycle')}}</th>
                                    <th>{{__('Created at')}}</th>
                                    <th>{{__('Updated at')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($CustomerSubscriptions as $subscription)
                                    <tr>
                                        <td>  {{ $subscription->Customer->CompanyName }}</td>
                                        <td>  {{ $subscription->package->name }}</td>
                                        <td>  {{ $subscription->billing_cycle }}</td>
                                        <td>  {{ $subscription->created_at }}</td>
                                        <td>  {{ $subscription->updated_at }}</td>
                                        <td>
                                            @canany(['adminUpdate', 'adminDelete', 'adminView'], $subscription)
                                                <form action="{{ route('admin.customersubscriptions.destroy', $subscription->id) }}" method="POST">
                                                   
                                                    <div class="flex">
                                                        @can('adminView', $subscription)
                                                            <a href="{{route('admin.customersubscriptions.show', $subscription->id)}}" class="btn btn-primary"><i class="bi bi-display"></i></a>
                                                        @endcan
                                                        @can('adminUpdate', $subscription)
                                                            <a href="{{route('admin.customersubscriptions.edit', $subscription->id)}}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                                        @endcan
                                                        
                                                        @can('adminDelete', $subscription)
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
                                @if($CustomerSubscriptions->isEmpty())
                                    <tr>
                                        <td colspan="6">
                                            {{ __('No Customer subscriptions found') }}
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
