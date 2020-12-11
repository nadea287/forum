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
                    <h1>Lorem <span>Lorem ipsum dolor</span></h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Aperiam blanditiis doloremque error eum fugit maiores obcaecati odio possimus quos rem?</p>
                    <p class="light">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Commodi quae quaerat sunt. Consectetur, ducimus, tempore!</p>
                </div>
            </div>
            <div class="inner-right">
                <div class="inner-right-content login-form">
                    <h5>Register</h5>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-actions">
                            <div class="txtb">
                                <input id="name" type="text" @error('name') class="is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                                <span class="login-form-span"></span>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="txtb">
                                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                                <span class="login-form-span"></span>
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="txtb">
                                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                                <span class="login-form-span"></span>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="txtb">
                                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                <span class="login-form-span"></span>
                            </div>
                        </div>
                        <button type="submit" class="buttons cta form-button">
                            Register
                        </button>
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
