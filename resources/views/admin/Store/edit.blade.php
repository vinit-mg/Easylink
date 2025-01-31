<x-admin.wrapper>
    <x-slot name="title">
      {{ __('Store') }}
    </x-slot>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                  <h5>{{__('Create Store')}}</h5>
                  <a class="btn btn-primary" href="{{ route('admin.customers.show', $customer->uuid) }}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to customer')}}</a>
                </div> 
                <form class="row g-3" method="POST" action="{{ route('admin.customer.stores.update',  [$customer->uuid, $store->uuid]) }}">
                  @csrf
                  @method('PUT')
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <label for="customer_id" class="form-label">{{__('Select Customer')}}</label>
                    <select class="form-select" id="customer_id" name="customer_id"  disabled>
                      <option value="{{$customer->id}}">{{__($customer->CompanyName)}}</option>
                    </select>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                      <label for="name" class="form-label">{{__('Store name')}}</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{$store->name}}" fdprocessedid="wngp6">
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                      <h4 class="mb-3"><strong>{{ __('Source Information')}}</strong></h4>
                      <div class="row g-3">
                        <div class="col-sm-12">
                          <label for="source" class="form-label">{{__('Source')}}</label>
                          <select class="form-select" id="source" name="source">
                            <option>{{__('Select Customer')}}</option>
                            @foreach($sources as $source)
                              <option value="{{$source->id}}"  {{ $source->id == $store->source_id  ? 'selected' : '' }} data-desc= "{{$source->name}}">{{__($source->name)}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-sm-12">
                          <label for="source_api_url" class="form-label">{{__('Api url')}}</label>
                          <input type="text" class="form-control" value="{{$store->source_auth->api_url}}" name="source_api_url" id="source_api_url" >
                        </div>
                        <div class="col-sm-12">
                          <label for="source_auth_type" class="form-label">{{__('Authentication type')}}</label>
                          <select class="form-select" id="source_auth_type" name="source_auth_type">
                            <option>{{__('Select authentication type')}}</option>
                            <option value="source_basic" {{$store->source_auth->type == 'source_basic' ? 'selected' : ''}}>Basic</option>
                            <option value="source_bearer" {{$store->source_auth->type == 'source_bearer' ? 'selected' : ''}}>Bearer</option>
                            <option value="source_api_key" {{$store->source_auth->type == 'source_api_key' ? 'selected' : ''}}>Api Key</option>
                            <option value="source_oauth1" {{$store->source_auth->type == 'source_oauth1' ? 'selected' : ''}}>oAuth 1.0</option>
                          </select>
                        </div>
                        <div class="col-sm-12 source_keyfields source_basic {{$store->source_auth->type == 'source_basic' ? 'active' : ''}}">
                          <label for="source_username" class="form-label">{{__('Username')}}</label>
                          <input type="text" class="form-control" name="source_username" id="source_username" value="{{$store->source_auth->username}}">
                        </div>
                        <div class="col-sm-12 source_keyfields source_basic {{$store->source_auth->type == 'source_basic' ? 'active' : ''}}">
                          <label for="source_password" class="form-label">{{__('Password')}}</label>
                          <input type="text" class="form-control" name="source_password" id="source_password" value="{{$store->source_auth->password}}">
                        </div>
                        <div class="col-sm-12 source_keyfields source_bearer {{$store->source_auth->type == 'source_bearer' ? 'active' : ''}}">
                          <label for="source_token" class="form-label">{{__('Token')}}</label>
                          <input type="text" class="form-control" name="source_token" id="source_token" value="{{$store->source_auth->token}}">
                        </div>
                        <div class="col-sm-12 source_keyfields source_api_key {{$store->source_auth->type == 'source_api_key' ? 'active' : ''}}">
                          <label for="source_api_key" class="form-label">{{__('Api Key')}}</label>
                          <input type="text" class="form-control" name="source_api_key" id="source_api_key" value="{{$store->source_auth->api_key}}">
                        </div>
                        <div class="col-sm-12 source_keyfields source_oauth1 {{$store->source_auth->type == 'source_oauth1' ? 'active' : ''}}">
                          <label for="source_client_id" class="form-label">{{__('Client id')}}</label>
                          <input type="text" class="form-control" name="source_client_id" id="source_client_id" value="{{$store->source_auth->client_id}}">
                        </div>
                        <div class="col-sm-12 source_keyfields source_oauth1 {{$store->source_auth->type == 'source_oauth1' ? 'active' : ''}}">
                          <label for="source_client_secret" class="form-label">{{__('Client secret')}}</label>
                          <input type="text" class="form-control" name="source_client_secret" id="source_client_secret" value="{{$store->source_auth->client_secret}}">
                        </div>
                           <!-- Dynamic Fields Section for Destination -->
                          <div id="dynamicFieldsSection" style="{{$store->source_auth->requires_dynamic_url ? 'display:block' : 'display:none'}}" class="Shopify">
                            <h4>Dynamic Fields for Shopify</h4>
                            <div class="mb-3">
                                <label for="shopifyapiversion" class="form-label">Shopify Api Version</label>
                                <select id="shopifyapiversion" name="shopifyapiversion" class="form-select">
                                    <option value="">Select a Version</option>
                                    @foreach($store->source_auth->DynamicFields as $DynamicField)
                                        @if($DynamicField->field_name == 'shopifyapiversion')
                                            <option value="{{$DynamicField->field_value}}" selected>{{$DynamicField->field_value}}</option>
                                        @endif
                                    @endforeach
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
                          <textarea name="source_additional_info" id="source_additional_info"  class="form-control" cols="30" rows="10">{{$store->source_auth->additional_info}}</textarea>
                        </div>
                        <div class="col-sm-12">
                          <input type="hidden" name="testsource" id="testsourcefld" value="">
                          <button type="button" class="btn btn-primary" id="testsource" fdprocessedid="ufar4">Test</button>
                        </div>
                      </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <h4 class="mb-3"><strong>{{ __('Destination Information')}}</strong></h4>
                    <div class="row g-3">
                      <div class="col-sm-12">
                          <label for="destination" class="form-label">{{__('Destination')}}</label>
                          <select class="form-select" id="destination" name="destination">
                            <option>{{__('Select destination')}}</option>
                            @foreach($destinations as $destination)
                              <option value="{{$destination->id}}" {{$destination->id == $store->destination_id ? 'selected' : ''}} data-desc= "{{$destination->name}}">{{__($destination->name)}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="col-sm-12">
                        <label for="destination_api_url" class="form-label">{{__('Api url')}}</label>
                        <input type="text" class="form-control" name="destination_api_url" id="destination_api_url" value="{{$store->destination_auth->api_url}}">
                      </div>
                      <div class="col-sm-12">
                        <label for="destination_auth_type" class="form-label">{{__('Authentication type')}}</label>
                        <select class="form-select" id="destination_auth_type" name="destination_auth_type">
                          <option>{{__('Select authentication type')}}</option>
                          <option value="destination_basic" {{$store->destination_auth->type == 'source_basic' ? 'selected' : ''}}>Basic</option>
                          <option value="destination_bearer" {{$store->destination_auth->type == 'destination_bearer' ? 'selected' : ''}}>Bearer</option>
                          <option value="destination_api_key" {{$store->destination_auth->type == 'destination_api_key' ? 'selected' : ''}}>Api Key</option>
                          <option value="destination_oauth1" {{$store->destination_auth->type == 'destination_oauth1' ? 'selected' : ''}}>oAuth 1.0</option>
                        </select>
                      </div>
                      <div class="col-sm-12 destination_keyfields destination_basic {{$store->destination_auth->type == 'source_basic' ? 'active' : ''}}">
                        <label for="destination_username" class="form-label">{{__('Username')}}</label>
                        <input type="text" class="form-control" name="destination_username" id="destination_username" value="{{$store->destination_auth->username}}">
                      </div>
                      <div class="col-sm-12 destination_keyfields destination_basic {{$store->destination_auth->type == 'source_basic' ? 'active' : ''}}">
                        <label for="destination_password" class="form-label">{{__('Password')}}</label>
                        <input type="text" class="form-control" name="destination_password" id="destination_password" value="{{$store->destination_auth->password}}">
                      </div>
                      <div class="col-sm-12 destination_keyfields destination_bearer {{$store->destination_auth->type == 'destination_bearer' ? 'active' : ''}}">
                        <label for="destination_token" class="form-label">{{__('Token')}}</label>
                        <input type="text" class="form-control" name="destination_token" id="destination_token" value="{{$store->destination_auth->token}}">
                      </div>
                      <div class="col-sm-12 destination_keyfields destination_api_key {{$store->destination_auth->type == 'destination_api_key' ? 'active' : ''}}">
                        <label for="destination_api_key" class="form-label">{{__('Api Key')}}</label>
                        <input type="text" class="form-control" name="destination_api_key" id="destination_api_key" value="{{$store->destination_auth->api_key}}">
                      </div>
                      <div class="col-sm-12 destination_keyfields destination_oauth1 {{$store->destination_auth->type == 'destination_oauth1' ? 'active' : ''}}">
                        <label for="destination_client_id" class="form-label">{{__('Client id')}}</label>
                        <input type="text" class="form-control" name="destination_client_id" id="destination_client_id" value="{{$store->destination_auth->client_id}}">
                      </div>
                      <div class="col-sm-12 destination_keyfields destination_oauth1 {{$store->destination_auth->type == 'destination_oauth1' ? 'active' : ''}}">
                        <label for="destination_client_secret" class="form-label">{{__('Client secret')}}</label>
                        <input type="text" class="form-control" name="destination_client_secret" id="destination_client_secret" value="{{$store->destination_auth->client_secret}}">
                      </div>
  
                       <!-- Dynamic Fields Section for Destination -->
                      <div id="dynamicFieldsSection" style="{{$store->destination_auth->requires_dynamic_url ? 'display:block' : 'display:none'}}" class="Ackro">
                        <h4>Dynamic Fields for Ackro</h4>
                        <div class="mb-3">
                            <label for="ackroCustomerDropdown" class="form-label">Customer Name (Ackro)</label>
                            <select id="ackroCustomerDropdown" name="ackroCustomer" class="form-select">
                                <option value="">Select a Customer</option>
                                @foreach($store->destination_auth->DynamicFields as $DynamicField)
                                        @if($DynamicField->field_name == 'ackroCustomer')
                                            <option value="{{$DynamicField->field_value}}" selected>{{$DynamicField->field_value}}</option>
                                        @endif
                                    @endforeach
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
                        <textarea name="destination_additional_info" id="destination_additional_info"  class="form-control" cols="30" rows="10">{{$store->source_auth->additional_info}}</textarea>
                      </div>
                      <div class="col-sm-12">
                        <input type="hidden" name="testdestination" id="testdestinationfld" value="">
                        <button type="button" class="btn btn-primary" id="testdestination" fdprocessedid="ufar4">Test</button>
                      </div>
                    </div>
                  </div>    
                  <div class="text-center">
                      <button type="submit" class="btn btn-primary" fdprocessedid="ufar4">Update</button>
                  </div>
              </form>    
            </div>
          </div>
        </div>
      </div>
    </section>
  </x-admin.wrapper>
  <script>
      
  </script>