<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Payments') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Table with stripped rows -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{__('Customer Name')}}</th>
                                    <th>{{__('Ammount')}}</th>
                                    <th>{{__('Payment type')}}</th>
                                    <th>{{__('Created at')}}</th>
                                    <th>{{__('Updated at')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td>  {{ $payment->Customer->CompanyName }}</td>
                                        <td>  {{ $payment->amount }}</td>
                                        <td>  {{ $payment->payment_type }}</td>
                                        <td>  {{ $payment->created_at }}</td>
                                        <td>  {{ $payment->updated_at }}</td>
                                        <td>
                                            @canany(['adminView'], $payment)
                                                <div class="flex">
                                                    @can('adminView', $payment)
                                                        <a href="{{route('admin.payments.show', $payment->id)}}" class="btn btn-primary"><i class="bi bi-display"></i></a>
                                                    @endcan
                                                </div>
                                            @endcanany
                                        </td>
                                    </tr>
                                @endforeach
                                @if($payments->isEmpty())
                                    <tr>
                                        <td colspan="6">
                                            {{ __('No payments found') }}
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
