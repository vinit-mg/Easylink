<x-admin.wrapper>
    <x-slot name="title">
      {{ __('Store settings') }}
    </x-slot>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                  <h5>{{__('Store setting')}}</h5>
                  <a class="btn btn-primary" href="{{route('admin.customers.show', $customer->uuid)}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to customer')}}</a>
                </div>
                @php
                    $originalString_source = $store->source->name;
                    $convertedString_source = strtolower(str_replace(' ', '_', $originalString_source));
                    $originalString_destination = $store->destination->name;
                    $convertedString_destination = strtolower(str_replace(' ', '_', $originalString_destination));
                @endphp
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="{{$convertedString_source}}_tab" data-bs-toggle="tab" data-bs-target="#{{$convertedString_source}}" type="button" role="tab" aria-controls="{{$convertedString_source}}" aria-selected="true">{{$originalString_source}}</button>
                        <button class="nav-link" id="{{$convertedString_destination}}_tab" data-bs-toggle="tab" data-bs-target="#{{$convertedString_destination}}" type="button" role="tab" aria-controls="{{$convertedString_destination}}" aria-selected="false">{{$originalString_destination}}</button>
                        <button class="nav-link" id="addon_tab" data-bs-toggle="tab" data-bs-target="#addon" type="button" role="tab" aria-controls="addon" aria-selected="false">{{__('AddOns')}}</button>
                        <button class="nav-link" id="permissions_tab" data-bs-toggle="tab" data-bs-target="#permissions" type="button" role="tab" aria-controls="permissions" aria-selected="false">{{__('Permissions')}}</button>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane mt-5 fade show active" id="{{$convertedString_source}}" role="tabpanel" aria-labelledby="{{$convertedString_source}}_tab">
                        <form class="row g-3" method="POST" action="{{ route('admin.customer.stores.settings.save',  [$customer->uuid,  $store->uuid]) }}">
                          @csrf
                          @foreach ($store->source->source_settings as $source_setting)
                            @if ($source_setting->setting_key =='shopify_order_transfer_payment_status')
                                <div class="col-sm-6">
                                    <h4 class="card-title">{{__($source_setting->setting_name)}}</h4>
                                    <div class="card-subtitle mb-3"> {{$source_setting->setting_description}} </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="{{$source_setting->setting_key}}" class="form-label" >{{__('Add payment state')}}</label>
                                    <select id="{{$source_setting->setting_key}}" class="form-control" name="{{$source_setting->setting_key}}[]" multiple="multiple">
                                      <option value="paid" {{in_array('paid',getStoreSetting($store->id, $source_setting->setting_key)) ? 'selected' : ''}}>{{__('Paid')}}</option>
                                      <option value="pending" {{in_array('pending',getStoreSetting($store->id, $source_setting->setting_key)) ? 'selected' : ''}}>{{__('Pending')}}</option>
                                      <option value="authorized" {{in_array('authorized',getStoreSetting($store->id, $source_setting->setting_key)) ? 'selected' : ''}}>{{__('Authorized')}}</option>
                                      <option value="partially_paid" {{in_array('partially_paid',getStoreSetting($store->id, $source_setting->setting_key)) ? 'selected' : ''}}>{{__('Partially paid')}}</option>
                                      <option value="partially_refunded" {{in_array('partially_refunded',getStoreSetting($store->id, $source_setting->setting_key)) ? 'selected' : ''}}>{{__('Partially refunded')}}</option>
                                      <option value="refunded" {{in_array('refunded',getStoreSetting($store->id, $source_setting->setting_key)) ? 'selected' : ''}}>{{__('Refunded')}}</option>
                                      <option value="voided" {{in_array('voided',getStoreSetting($store->id, $source_setting->setting_key)) ? 'selected' : ''}}>{{__('Voided')}}</option>
                                      <option value="expired" {{in_array('expired',getStoreSetting($store->id, $source_setting->setting_key)) ? 'selected' : ''}}>{{__('Expired')}}</option>
                                    </select>
                                </div>
                            @endif
                            @if ($source_setting->setting_key =='shopify_order_transfer_fulfillment_status')
                                <div class="col-sm-6">
                                    <h4 class="card-title">{{__($source_setting->setting_name)}}</h4>
                                    <div class="card-subtitle mb-3"> {{$source_setting->setting_description}} </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="{{$source_setting->setting_key}}" class="form-label" >{{__('Add fulfillment state')}}</label>
                                    <select id="{{$source_setting->setting_key}}" class="form-control" name="{{$source_setting->setting_key}}[]" multiple="multiple">
                                      <option value="unfulfilled" {{in_array('unfulfilled',getStoreSetting($store->id, $source_setting->setting_key)) ? 'selected' : ''}}>{{__('Unfulfilled')}}</option>
                                      <option value="fulfilled" {{in_array('fulfilled',getStoreSetting($store->id, $source_setting->setting_key)) ? 'selected' : ''}}>{{__('Fulfilled')}}</option>
                                      <option value="partial" {{in_array('partial',getStoreSetting($store->id, $source_setting->setting_key)) ? 'selected' : ''}}>{{__('Partial')}}</option>
                                      <option value="scheduled" {{in_array('scheduled',getStoreSetting($store->id, $source_setting->setting_key)) ? 'selected' : ''}}>{{__('Scheduled')}}</option>
                                      <option value="on_hold" {{in_array('on_hold',getStoreSetting($store->id, $source_setting->setting_key)) ? 'selected' : ''}}>{{__('On hold')}}</option>
                                    </select>
                                </div>
                            @endif
                            @if ($source_setting->setting_key =='shopify_payment_capture_on_order_update')
                              <div class="col-sm-6">
                                  <h4 class="card-title">{{__($source_setting->setting_name)}}</h4>
                                  <div class="card-subtitle mb-3"> {{$source_setting->setting_description}} </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="{{$source_setting->setting_key}}" name="{{$source_setting->setting_key}}" {{getStoreSetting($store->id, $source_setting->setting_key) ? 'checked' : ''}}>
                                    <label for="{{$source_setting->setting_key}}" class="form-label" >{{__('Enable payment capture')}}</label>
                                </div>
                              </div>
                            @endif
                          @endforeach 
                          <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary" fdprocessedid="ufar4">{{__('Save')}}</button>
                          </div>
                        </form>
                      </div>
                      <div class="tab-pane mt-5 fade" id="{{$convertedString_destination}}" role="tabpanel" aria-labelledby="{{$convertedString_destination}}_tab">
                        <form class="row g-3" method="POST" action="">
                          @foreach ($store->destination->destination_settings as $destination_setting)
                            @if ($destination_setting->setting_key =='ackro_order_update_status')
                                <div class="col-sm-6">
                                    <h4 class="card-title">{{__($destination_setting->setting_name)}}</h4>
                                    <div class="card-subtitle mb-3"> {{$destination_setting->setting_description}} </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="{{$destination_setting->setting_key}}" class="form-label" >{{__('Add order update state')}}</label>
                                    <select id="{{$destination_setting->setting_key}}" class="form-control" name="{{$destination_setting->setting_key}}[]" multiple="multiple">
                                      <option value="shipped">{{__('Shipped')}}</option>
                                      <option value="completed">{{__('Completed')}}</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 text-center">
                                  <button type="submit" class="btn btn-primary" fdprocessedid="ufar4">{{__('Save')}}</button>
                                </div>
                            @endif
                          @endforeach 
                        </form>
                      </div>
                      <div class="tab-pane mt-5 fade" id="addon" role="tabpanel" aria-labelledby="addon_tab">
                        @foreach ($store->enabledFeatures as $feature)
                          <div class="col-sm-12 addon-module">
                              <div class="d-flex justify-content-between align-items-center">
                                  <div>
                                    <h3>{{ $feature->name }}</h3>
                                    <div>{{$feature->addOn->description}}</div>
                                  </div>
                                  <div>
                                      <a href="{{ route('admin.customer.stores.load.addons', [$customer->uuid, $store->uuid, $feature->id]) }}" class="btn btn-primary"><i class="bi bi-gear"></i></a>
                                  </div>
                              </div>
                          </div>
                        @endforeach 
                      </div>
                      <div class="tab-pane mt-5 fade" id="permissions" role="tabpanel" aria-labelledby="permissions_tab">
                        <form class="row g-3" method="POST" action="{{ route('admin.customer.stores.permissions.save',[$customer->uuid, $store->uuid] ) }}" name="storepermissions">
                          @csrf
                          <ul class="list-group">

                            <li class="list-group-item active">{{__('Orders')}}</li>
                            @foreach ($features as $feature)
                              @if($feature->type != 'order')
                                @continue;
                              @endif
                              @php
                                $selected = '';
                              @endphp
                              @if($store->hasPermission($feature->feature_name))
                                @php
                                  $selected = 'checked';
                                @endphp
                              @endif
                              
                                <li class="list-group-item">
                                    <div class="form-check form-switch">
                                      <input class="form-check-input me-1" type="checkbox" name="store_permissions[]" {{$selected}} value="{{$feature->id}}">
                                      <label class="form-check-label" for="store_permission">{{ $feature->feature_name }}</label>
                                  </div>
                                </li>
                            @endforeach
                              
                            <li class="list-group-item active">{{__('Inventory')}}</li>
                            @foreach ($features as $feature)
                              @if($feature->type != 'inventory')
                                @continue;
                              @endif
                              @php
                                $selected = '';
                              @endphp
                              @if($store->hasPermission($feature->feature_name))
                                @php
                                  $selected = 'checked';
                                @endphp
                              @endif
                                <li class="list-group-item">
                                    <div class="form-check form-switch">
                                      <input class="form-check-input me-1" type="checkbox" name="store_permissions[]" {{$selected}} value="{{$feature->id}}">
                                      <label class="form-check-label" for="store_permission">{{ $feature->feature_name }}</label>
                                  </div>
                                </li>
                            @endforeach

                            <li class="list-group-item active">{{__('Customer')}}</li>
                            @foreach ($features as $feature)
                              @if($feature->type != 'customer')
                                @continue;
                              @endif
                              @php
                                $selected = '';
                              @endphp
                              @if($store->hasPermission($feature->feature_name))
                                @php
                                  $selected = 'checked';
                                @endphp
                              @endif
                              
                                <li class="list-group-item">
                                    <div class="form-check form-switch">
                                      <input class="form-check-input me-1" type="checkbox" name="store_permissions[]" {{$selected}} value="{{$feature->id}}">
                                      <label class="form-check-label" for="store_permission">{{ $feature->feature_name }}</label>
                                  </div>
                                </li>
                            @endforeach
                            @if($features->isEmpty())
                              <p>{{__('Permissions not assign to user');}}</p>
                            @else
                                <div>
                                  <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                                </div>
                            @endif
                          </ul>
                        </form>
                       
                      </div>
                    </div>
                  
                  </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </x-admin.wrapper>