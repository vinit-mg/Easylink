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
                            <a href="{{ route('admin.customers.index') }}" class="btn btn-primary"><i class="bi bi-arrow-left me-1"></i> {{__('Back to all customers')}}</a>
                        </div> 
                        <form class="row g-3" method="POST" action="{{ route('admin.customers.update', $customer->uuid) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="CompanyName" class="form-label">{{__('Company Name')}}</label>
                                <input type="text" name="CompanyName" class="form-control" id="CompanyName" value="{{ old('CompanyName', $customer->CompanyName) }}">
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="CompanyLogo" class="form-label">{{__('Company Logo')}}</label>
                                <input class="form-control" name="CompanyLogo" type="file" id="formFile" value="{{ old('CompanyLogo', $customer->CompanyLogo) }}">
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="AccessURL" class="form-label">{{__('Website')}}</label>
                                <input type="text" name="AccessURL" class="form-control" id="AccessURL" value="{{ old('AccessURL', $customer->AccessURL) }}">
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="CustomerNo" class="form-label">{{__('Customer no.')}}</label>
                                <input type="text" name="CustomerNo" class="form-control"  value="{{ old('CustomerNo', $customer->CustomerNo) }}">
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="Address" class="form-label">{{__('Address')}}</label>
                                <input type="text" name="Address" class="form-control" value="{{ old('Address', $customer->Address) }}">
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="ZipCode" class="form-label">{{__('Zip code')}}</label>
                                <input type="text" name="ZipCode" class="form-control" value="{{ old('ZipCode', $customer->ZipCode) }}">
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="Town" class="form-label">{{__('Town')}}</label>
                                <input type="text" name="Town" class="form-control" value="{{ old('Town', $customer->Town) }}">
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="Country" class="form-label">{{__('Country')}}</label>
                                <input type="text" name="Country" class="form-control" value="{{ old('Country', $customer->Country) }}">
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="CVR_no" class="form-label">{{__('CVR-no.')}}</label>
                                <input type="text" name="CVR_no" class="form-control" value="{{ old('CVR_no', $customer->CVR_no) }}">
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="PhoneNo" class="form-label">{{__('Phone. No.')}}</label>
                                <input type="text" name="PhoneNo" class="form-control" value="{{ old('PhoneNo', $customer->PhoneNo) }}">
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="Dealer" class="form-label">{{__('Dealer')}}</label>
                                <input type="text" name="Dealer" class="form-control" value="{{ old('Dealer', $customer->Dealer) }}">
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="AccessURL" class="form-label">{{__('Users')}}</label>
                                <select class="form-select" name="user">
                                    @foreach ($users as $user)
                                        @php $selected = false; @endphp
                                        @foreach ($customer->CustomerUsers as $CustomerUser)
                                            @if($CustomerUser->user_id == $user->id)
                                                @php $selected = true; @endphp
                                                @continue
                                            @endif
                                        @endforeach
                                        <option value="{{$user->id}}" {{$selected ? 'selected' : ''}}>{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                            </div>
                        </form>    
                    </div>
                </div>
    
            </div>
        </div>
    </section>
</x-admin.wrapper>
