<x-admin.wrapper>
    <x-slot name="title">
        {{ __('Customer users') }}
    </x-slot>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                  <div class="align-items-center card-title d-lg-flex d-md-block justify-content-between">
                    <h5>{{__('Create user')}}</h5>
                    <a class="btn btn-primary" href="{{route('admin.customers.show', $customer->uuid)}}"><i class="bi bi-arrow-left me-1"></i>{{__('Back to customer')}}</a>
                  </div> 
                  <form class="row g-3" method="POST" action="{{ route('admin.customer.users.update', [$customer->uuid, $user->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="name" class="form-label">{{__('Name')}}</label>
                        <input type="text" class="form-control" name="Name" id="Name" value="{{$user->name}}">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="username" class="form-label">{{__('Username')}}</label>
                        <input type="text" class="form-control" name="username" id="username" value="{{$user->username}}">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="email" class="form-label">{{__('Email')}}</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="password" class="form-label">{{__('Password')}}</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="password_confirmation" class="form-label">{{__('Password Confirmation')}}</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="roles" class="form-label">{{__('Roles')}}</label>
                        <div>
                            @foreach($roles as $role)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="role" {{$user->hasRole($role->name) ? 'checked' : ''}} value="{{$role->name}}">
                                    <label class="form-check-label" for="role">{{$role->name}}</label>
                                </div>
                            @endforeach
                          
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
