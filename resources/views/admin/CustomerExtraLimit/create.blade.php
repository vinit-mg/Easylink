<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Store comapnies') }}
    </x-slot>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                            <h5>{{__('Create Customer')}}</h5>
                            <a href="{{ route('admin.customers.show', $customer->uuid) }}" class="btn btn-primary"><i class="bi bi-arrow-left me-1"></i> {{__('Back to customer')}}</a>
                        </div> 
                        <form class="row g-3" method="POST" action="{{ route('admin.customer.extralimits.store', $customer->uuid) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="CompanyName" class="form-label">{{__('Feature name')}}</label>
                                <select id="package_feature_id" name="package_feature_id" class="form-select">
                                    @foreach($PackageFeatures as $PackageFeature)
                                        <option value="{{$PackageFeature->id}}">{{$PackageFeature->feature_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="price" class="form-label">{{__('Additional limit')}}</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="additional_limit" id="additional_limit" min="0" step="1" value="{{old('additional_limit')}}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="price" class="form-label">{{__('Price')}}</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">DKK.</span>
                                    <input type="number" class="form-control" name="price" id="price" min="0" step="1.00" value="{{old('price')}}">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">{{__('create')}}</button>
                            </div>
                        </form>    
                    </div>
                </div>
    
            </div>
        </div>
    </section>
</x-admin.wrapper>
