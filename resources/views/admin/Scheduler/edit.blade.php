<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Store Schedulers') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                            <h5>{{__('Update Package')}}</h5>
                            <a class="btn btn-primary" href="{{route('admin.customer.stores.manage', [$customer->uuid, $store->uuid])}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to store')}}</a>
                        </div> 
                        <form class="row g-3" method="POST" action="{{ route('admin.customer.stores.scheduler.update', [$customer->uuid, $store->uuid, $scheduler->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="name" class="form-label">{{__('Feature Name')}}</label>
                                <select name="package_feature_id" id="package_feature_id" class="form-select">
                                    <option value="{{$scheduler->package_feature_id}}">{{$scheduler->PackageFeature->feature_name}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="name" class="form-label">{{__('Feature Name')}}</label>
                                @php
                                    $frequency = old('frequency', $scheduler->frequency);
                                @endphp
                                <select class="form-select" id="frequency" name="frequency">
                                    <option value="everyMinute" {{'everyMinute' == $frequency ? 'selected' : ''}}>Every Minute</option>
                                    <option value="everyFiveMinutes" {{'everyFiveMinutes' == $frequency ? 'selected' : ''}}>Every 5 Minutes</option>
                                    <option value="everyFifteenMinutes" {{'everyFifteenMinutes' == $frequency ? 'selected' : ''}}>Every 15 Minutes</option>
                                    <option value="everyThirtyMinutes" {{'everyThirtyMinutes' == $frequency ? 'selected' : ''}}>Every 30 Minutes</option>
                                    <option value="hourly" {{'hourly' == $frequency ? 'selected' : ''}}>Hourly</option>
                                    <option value="daily" {{'daily' == $frequency ? 'selected' : ''}}>Daily</option>
                                    <option value="weekly" {{'weekly' == $frequency ? 'selected' : ''}}>Weekly</option>
                                </select>
                                
                            </div>
                          
                            <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="IsActive" id="IsActive" {{$scheduler->IsActive ? 'checked' : '' }}>
                                    <label class="form-check-label" for="IsActive">{{__('Activate')}}</label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" fdprocessedid="ufar4">{{__('Update')}}</button>
                            </div>
                        </form>    
                    </div>
                </div>
    
            </div>
        </div>
      </section>
</x-admin.wrapper>
