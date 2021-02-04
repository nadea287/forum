{{--@extends('layouts.bloglayout')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}

@include('layouts.partials.appheader')
<div class="authentication-section container-fluid pr-0 pl-0">
    <div class="proto-container">
        <div class="protos"></div>
        <div class="protos"></div>
        <div class="protos"></div>
        <div class="protos"></div>
    </div>
    <div class="basic-container">
        <div class="inner">
            <div class="inner-left">
                <div class="content">
                    <h1>Complete <span>UI Design Course</span></h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Aperiam blanditiis doloremque error eum fugit maiores obcaecati odio possimus quos rem?</p>
                    <p class="light">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Commodi quae quaerat sunt. Consectetur, ducimus, tempore!</p>
                </div>
            </div>
            <div class="inner-right">
              <div class="inner-right-content login-form">
                  <h5>Login</h5>
                  <form method="POST" action="{{ route('login') }}">
                      @csrf
                      <div class="form-actions">
                          <div class="txtb">
                              <input id="email" type="email"
                                     class=" @error('email') is-invalid @enderror" name="email"
                                     value="{{ old('email') }}" required autocomplete="email" autofocus>
                              <span class="login-form-span"></span>
                          </div>
                          @error('email')
                          <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                          @enderror
                          <div class="txtb">
                              <input id="password" type="password"
                                     class="@error('password') is-invalid @enderror"
                                     name="password" required autocomplete="current-password">
                              <span class="login-form-span"></span>
                          </div>
                          @error('password')
                          <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                          @enderror
                      </div>
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="remember"
                                 id="remember" {{ old('remember') ? 'checked' : '' }}>
                          <label class="form-check-label" for="remember">
                              Remember Me
                          </label>
                      </div>
                      <button type="submit" class="buttons cta form-button">
                          Login
                      </button>

                      <div class="forgot-password">
                          @if (Route::has('password.request'))
                              <a class="btn btn-link" href="{{ route('password.request') }}">
                                  {{ __('Forgot Your Password?') }}
                              </a>
                          @endif
                              <a href="{{ route('guestCheckout.index') }}">Checkout as Guest</a>
                      </div>
                  </form>
              </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{ asset('/js/session-message.js') }}"></script>
@endpush
@include('layouts.blogfooter')
