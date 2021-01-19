@extends('layouts.shop.shoplayout')
<script src="https://js.stripe.com/v3/"></script>
@section('content')
    <h3>checkout</h3>
    <hr>
    <div class="row">
        <div class="col-6">
            <h4>billing details</h4>
            <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input name="email" type="email" class="form-control" id="inputEmail4"
                               value="{{ old('email') }}" required>
                        @error('email')
                        <small class="text-danger font-weight-bold">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Name</label>
                        <input name="name" type="text" class="form-control"
                               value="{{ old('name') }}" required>
                        @error('name')
                        <small class="text-danger font-weight-bold">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" name="address" class="form-control" id="address"
                           placeholder="1234 Main St" value="{{ old('address') }}" required>
                    @error('address')
                    <small class="text-danger font-weight-bold">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" name="city" class="form-control" id="city"
                               value="{{ old('city') }}" required>
                        @error('city')
                        <small class="text-danger font-weight-bold">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState">Province</label>
                        <input type="text" name="province" class="form-control" id="province"
                               value="{{ old('province') }}" required>
                        @error('province')
                        <small class="text-danger font-weight-bold">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="postalcode">Postal Code</label>
                        <input type="text" name="postalcode" class="form-control" id="postalcode"
                               value="{{ old('postalcode') }}" required>
                        @error('postalcode')
                        <small class="text-danger font-weight-bold">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState">Phone</label>
                        <input type="text" name="phone" class="form-control"
                               value="{{ old('phone') }}" required>
                        @error('phone')
                        <small class="text-danger font-weight-bold">
                            {{ $message }}
                        </small>
                        @enderror
                    </div>
                </div>

                <h5 class="font-weight-bold mt-4">Payment Details</h5>
                <div class="form-group">
                    <label for="name_on_card">Name on Card</label>
                    <input type="text" name="name_on_card" class="form-control" id="name_on_card"
                           value="{{ old('name_on_card') }}" required>
                    @error('name_on_card')
                    <small class="text-danger font-weight-bold">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="card-element">
                        Card or debit card
                    </label>
                    <div id="card-element">
{{--                        Stripe elements will be inserted here--}}
                    </div>
{{--                    Display form errors--}}
                    <div id="card-errors" role="alert"></div>
                </div>
                <button type="submit" class="btn btn-secondary btn-block" id="comlete-order">Complete Order</button>
            </form>
        </div>
        <div class="col-5 offset-1">
            <h4 class="font-weight-bold border-bottom pb-3">Your Order</h4>
                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $item)
                    <div class="pr-1 pt-4 light-slider d-flex">
                        <a href="">
                            <img src="{{ asset('/images/product.jpg') }}" alt="" style="width: 50px; height: 50px; margin-right: 10px">
                        </a>
                        <h6 class="pr-3">{{ $item->model->name }}</h6>
                        <small class="font-weight-bold">{{ presentPrice($item->subtotal) }}</small>
                        <span class="offset-1">{{ $item->qty }}</span>
                    </div>
                @endforeach
            <div class="card mt-4">
                <div class="d-flex">
                    <div class="d-flex flex-column">
                           <span>
                               Subtotal
                               <strong>
                                  $ {{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}
                               </strong>
                           </span>
                        <span>
                            @if(session()->has('coupon'))
                                discount {{ session()->get('coupon')['name'] }}
                                <form action="{{ route('coupon.destroy') }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="buttons">remove</button>
                                </form>
                                <strong>- {{ presentPrice($discount) }}</strong>
                                <hr>
                                <span>new subtotal</span>
                                <strong>{{ presentPrice($newSubtotal) }}</strong>
                            @endif
                        </span>
                        <span>
                               Tax (13%)
                               <strong>
                                   {{ presentPrice($newTax) }}
                               </strong>
                           </span>
                        <span>
                               Total
                               <strong>
                                  $ {{ presentPrice($newTotal) }}
                               </strong>
                           </span>
                    </div>
            </div>
            </div>
            @if(! session()->has('coupon'))
                <div>
                    <form action="{{ route('coupon.store') }}" method="POST">
                        @csrf
                        <input type="text" name="coupon_code" id="coupon_code">
                        <button type="submit" class="btn btn-outline-secondary btn-sm">apply</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
    @include('layouts.partials.session-message')

    @push('scripts')
        <script src="{{ asset('/js/checkout.js') }}"></script>
        <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
    @endpush
@endsection
