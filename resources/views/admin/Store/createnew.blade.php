<x-admin.wrapper>
    <x-slot name="title">
      {{ __('Store') }}
    </x-slot>
    <section  class="section">
       <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="wizard">
                            <div class="wizard-inner">
                                <div class="connecting-line"></div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>{{__('Store Basic Information')}}</i></a>
                                    </li>
                                    <li role="presentation" class="disabled">
                                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>{{ __('Source Information')}}</i></a>
                                    </li>
                                    <li role="presentation" class="disabled">
                                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>{{ __('Destination Information')}}</i></a>
                                    </li>
                                </ul>
                            </div>
            
                            <form class="row g-3" method="POST" action="{{ route('admin.stores.store') }}">
                                <div class="tab-content" id="main_form">
                                    <div class="tab-pane active" role="tabpanel" id="step1">
                                        <h4 class="text-center">{{__('Store Basic Information')}}</Sect></h4>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <label for="CustomerId" class="form-label">{{__('Select Customer')}}</label>
                                                <select class="form-select" id="CustomerId" name="CustomerId">
                                                    <option>{{__('Select Customer')}}</option>
                                                    @foreach($customers as $Customer)
                                                    <option value="{{$Customer->id}}">{{__($Customer->CompanyName)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <label for="name" class="form-label">{{__('Store name')}}</label>
                                                <input type="text" class="form-control" name="name" id="name" fdprocessedid="wngp6">
                                            </div>
                                            
                                            
                                        </div>
                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="default-btn next-step">Continue to next step</button></li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane" role="tabpanel" id="step2">
                                        <h4 class="text-center">{{ __('Source Information')}}</h4>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="source" class="form-label">{{__('Source')}}</label>
                                                <select class="form-select" id="source" name="source">
                                                <option>{{__('Select Customer')}}</option>
                                                @foreach($sources as $source)
                                                    <option value="{{$source->id}}" data-desc= "{{$source->SourceName}}">{{__($source->SourceName)}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12">
                                            <label for="source_api_url" class="form-label">{{__('Api url')}}</label>
                                            <input type="text" class="form-control" name="source_api_url" id="source_api_url" >
                                            </div>
                                            <div class="col-sm-12">
                                            <label for="source_auth_type" class="form-label">{{__('Authentication type')}}</label>
                                            <select class="form-select" id="source_auth_type" name="source_auth_type">
                                                <option>{{__('Select authentication type')}}</option>
                                                <option value="source_basic">Basic</option>
                                                <option value="source_bearer">Bearer</option>
                                                <option value="source_api_key">Api Key</option>
                                                <option value="source_oauth1">oAuth 1.0</option>
                                            </select>
                                            </div>
                                            <div class="col-sm-12 source_keyfields source_basic">
                                            <label for="source_username" class="form-label">{{__('Username')}}</label>
                                            <input type="text" class="form-control" name="source_username" id="source_username" >
                                            </div>
                                            <div class="col-sm-12 source_keyfields source_basic">
                                            <label for="source_password" class="form-label">{{__('Password')}}</label>
                                            <input type="text" class="form-control" name="source_password" id="source_password" >
                                            </div>
                                            <div class="col-sm-12 source_keyfields source_bearer">
                                            <label for="source_token" class="form-label">{{__('Token')}}</label>
                                            <input type="text" class="form-control" name="source_token" id="source_token" >
                                            </div>
                                            <div class="col-sm-12 source_keyfields source_api_key">
                                            <label for="source_api_key" class="form-label">{{__('Api Key')}}</label>
                                            <input type="text" class="form-control" name="source_api_key" id="source_api_key" >
                                            </div>
                                            <div class="col-sm-12 source_keyfields source_oauth1">
                                            <label for="source_client_id" class="form-label">{{__('Client id')}}</label>
                                            <input type="text" class="form-control" name="source_client_id" id="source_client_id" >
                                            </div>
                                            <div class="col-sm-12 source_keyfields source_oauth1">
                                            <label for="source_client_secret" class="form-label">{{__('Client secret')}}</label>
                                            <input type="text" class="form-control" name="source_client_secret" id="source_client_secret" >
                                            </div>
                                                <!-- Dynamic Fields Section for Destination -->
                                            <div id="dynamicFieldsSection" style="display:none;" class="Shopify">
                                                <h4>Dynamic Fields for Shopify</h4>
                                                <div class="mb-3">
                                                    <label for="shopifyapiversion" class="form-label">Shopify Api Version</label>
                                                    <select id="shopifyapiversion" name="shopifyapiversion" class="form-select">
                                                        <option value="">Select a Version</option>
                                                    </select>
                                                    <small class="form-text text-muted">Api Version will be fetched using the API Key.</small>
                                                    <br>
                                                    <small class="form-text  shopifysuccess text-success" style="display: none">Api Version fetched successfully</small>
                                                    <br>
                                                    <button type="button" id="fatchshopifyapiversion" class="btn btn-primary" fdprocessedid="ufar4">Fetch Version</button>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                            <label for="source_additional_info" class="form-label">{{__('Additional information')}}</label>
                                            <textarea name="source_additional_info" id="source_additional_info"  class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="col-sm-12">
                                            <input type="hidden" name="testsource" id="testsourcefld" value="">
                                            <button type="button" class="btn btn-primary" id="testsource" fdprocessedid="ufar4">Test</button>
                                            </div>
                                        </div>
                        
                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="default-btn prev-step">Back</button></li>
                                            <li><button type="button" class="default-btn next-step skip-btn">Skip</button></li>
                                            <li><button type="button" class="default-btn next-step">Continue</button></li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane" role="tabpanel" id="step3">
                                        <h4 class="text-center">{{ __('Destination Information')}}</h4>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="destination" class="form-label">{{__('Destination')}}</label>
                                                <select class="form-select" id="destination" name="destination">
                                                <option>{{__('Select destination')}}</option>
                                                @foreach($destinations as $destination)
                                                    <option value="{{$destination->id}}" data-desc= "{{$destination->DestinationName}}">{{__($destination->DestinationName)}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12">
                                            <label for="destination_api_url" class="form-label">{{__('Api url')}}</label>
                                            <input type="text" class="form-control" name="destination_api_url" id="destination_api_url" >
                                            </div>
                                            <div class="col-sm-12">
                                            <label for="destination_auth_type" class="form-label">{{__('Authentication type')}}</label>
                                            <select class="form-select" id="destination_auth_type" name="destination_auth_type">
                                                <option>{{__('Select authentication type')}}</option>
                                                <option value="destination_basic">Basic</option>
                                                <option value="destination_bearer">Bearer</option>
                                                <option value="destination_api_key">Api Key</option>
                                                <option value="destination_oauth1">oAuth 1.0</option>
                                            </select>
                                            </div>
                                            <div class="col-sm-12 destination_keyfields destination_basic">
                                            <label for="destination_username" class="form-label">{{__('Username')}}</label>
                                            <input type="text" class="form-control" name="destination_username" id="destination_username" >
                                            </div>
                                            <div class="col-sm-12 destination_keyfields destination_basic">
                                            <label for="destination_password" class="form-label">{{__('Password')}}</label>
                                            <input type="text" class="form-control" name="destination_password" id="destination_password" >
                                            </div>
                                            <div class="col-sm-12 destination_keyfields destination_bearer">
                                            <label for="destination_token" class="form-label">{{__('Token')}}</label>
                                            <input type="text" class="form-control" name="destination_token" id="destination_token" >
                                            </div>
                                            <div class="col-sm-12 destination_keyfields destination_api_key">
                                            <label for="destination_api_key" class="form-label">{{__('Api Key')}}</label>
                                            <input type="text" class="form-control" name="destination_api_key" id="destination_api_key" >
                                            </div>
                                            <div class="col-sm-12 destination_keyfields destination_oauth1">
                                            <label for="destination_client_id" class="form-label">{{__('Client id')}}</label>
                                            <input type="text" class="form-control" name="destination_client_id" id="destination_client_id" >
                                            </div>
                                            <div class="col-sm-12 destination_keyfields destination_oauth1">
                                            <label for="destination_client_secret" class="form-label">{{__('Client secret')}}</label>
                                            <input type="text" class="form-control" name="destination_client_secret" id="destination_client_secret" >
                                            </div>
                        
                                            <!-- Dynamic Fields Section for Destination -->
                                            <div id="dynamicFieldsSection" style="display:none;" class="Ackro">
                                            <h4>Dynamic Fields for Ackro</h4>
                                            <div class="mb-3">
                                                <label for="ackroCustomerDropdown" class="form-label">Customer Name (Ackro)</label>
                                                <select id="ackroCustomerDropdown" name="ackroCustomer" class="form-select">
                                                    <option value="">Select a Customer</option>
                                                </select>
                                                <small class="form-text text-muted">Customer name will be fetched using the API Key.</small>
                                                <br>
                                                <small class="form-text  ackrosucess text-success" style="display: none">Customers fetched successfully</small>
                                                <br>
                                                <button type="button" id="fatchAcroCustomer" class="btn btn-primary" fdprocessedid="ufar4">Fetch Customer</button>
                                                
                                            </div>
                                            </div>
                        
                                            <div class="col-sm-12">
                                            <label for="destination_additional_info" class="form-label">{{__('Additional information')}}</label>
                                            <textarea name="destination_additional_info" id="destination_additional_info"  class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="col-sm-12">
                                            <input type="hidden" name="testdestination" id="testdestinationfld" value="">
                                            <button type="button" class="btn btn-primary" id="testdestination" fdprocessedid="ufar4">Test</button>
                                            </div>
                                        </div>
                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="default-btn prev-step">Back</button></li>
                                            <li><button type="button" class="default-btn next-step skip-btn">Skip</button></li>
                                            <li><button type="button" class="default-btn next-step">Continue</button></li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </section>
    <script>
        // ------------step-wizard-------------
       

    
    </script>
</x-admin.wrapper>
