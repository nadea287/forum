@extends('layouts.shop.shoplayout')
@section('content')
    @include('layouts.partials.session-message')
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
                    <div class="thankyou-section">
                        <h5>Thank you!</h5>
                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, quas!</span>
                        <a href="{{ route('products.index') }}" class="buttons standart-button">continue shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('/js/session-message.js') }}"></script>
    @endpush
@endsection
