<x-app-layout>
    <x-slot name="header">
        {{ __('Errors') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2>{{$store->name}} {{__('View Order')}}</h2>
                    </div>
                    <div class="card-body">
                      @foreach($response['response'] as $error)
                      <div class="alert alert-danger" role="alert">
                        {{$error['message']}}
                      </div>
                      @endforeach
                    </div>
                </div>

            </div>
        </div>
      </section>
</x-app-layout>
