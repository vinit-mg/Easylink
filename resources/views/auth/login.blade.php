<x-guest-layout>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
  
                <div class="d-flex justify-content-center py-4">
                  <a href="index.html" class="logo d-flex align-items-center w-auto">
                    <img src="assets/img/easylink-logo.svg" alt="">
                  </a>
                </div><!-- End Logo -->
  
                <div class="card mb-3">
  
                  <div class="card-body">
  
                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                      <p class="text-center small">Enter your username & password to login</p>
                    </div>
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <form method="POST" action="{{ route('login') }}" class="row g-3 needs-validation" novalidate>
                    @csrf

                        <div class="col-12">
                            <label for="email" class="form-label">{{__('Email')}}</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <input type="email" name="email" class="form-control " id="email" required autofocus autocomplete="username" value="{{old('email')}}">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
    
                        <div class="col-12">
                            <label for="password" class="form-label">{{__('Password')}}</label>
                            <input type="password" name="password" class="form-control" id="password" value="{{old('password')}}" required autocomplete="current-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
    
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me" value="true">
                                <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit"> {{ __('Log in') }}</button>
                        </div>
                        <div class="col-12">
                            @if (Route::has('password.request'))
                                <p class="small mb-0"><a  href="{{ route('password.request') }}"> {{ __('Forgot your password?') }}</a></p>
                            @endif
                        </div>
                    </form>
  
                  </div>
                </div>
  
                <div class="credits">
                  Designed by <a href="#">Easylink</a>
                </div>
  
              </div>
            </div>
          </div>
  
        </section>
      </div>
</x-guest-layout>
