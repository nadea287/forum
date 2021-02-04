@extends('layouts.shop.shoplayout')
@section('content')
    <div class="row">
        <div class="col-6">
            <x-breadcrumb>
                <li class="breadcrumbs_item">
                    <a href="{{ route('products.index') }}" class="breadcrumbs_link">All Products</a>
                </li>
                <li class="breadcrumbs_item">
                    <a href="" class="breadcrumbs_link breadcrumbs_link_active">My Cart</a>
                </li>
            </x-breadcrumb>
        </div>
        <div class="col-6 offset-1 mb-4 cart-items">
            @if(\Gloudemans\Shoppingcart\Facades\Cart::count() > 0)
            <h3 class="font-weight-bold mt-4">{{ \Gloudemans\Shoppingcart\Facades\Cart::count() }}
                item(s) in the shopping cart
            </h3>
            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $item)
                <div class="cart-item-container">
                    <div class="cart-single-item">
                        {{--                    <div class="d-flex">--}}
                        <div class="cart-item-details">
                            <a href="{{ route('products.show', ['product' => $item->model->id,
                                                                     'slug' => $item->model->name]) }}">
                                <img src="{{ asset('/storage/' . $item->model->cover_image) }}" alt="">
                            </a>
                            <div class="cart-item-description">
                                <span>{{ $item->model->name }}</span>
                                <small class="text-muted">
                                    {{ \Illuminate\Support\Str::substr($item->model->details, 0, 50) }}
                                </small>
                            </div>
                        </div>
                        <div class="cart-item-right">
{{--                            <span class="font-weight-bold">{{ presentPrice($item->subtotal) }}</span>--}}
                            @include('cart.api.item-price')
{{--                            <select class="quantity" data-id="{{ $item->rowId }}" data-productQuantity="">--}}
{{--                                @for ($i = 1; $i < 5 + 1 ; $i++)--}}
{{--                                    <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>--}}
{{--                                @endfor--}}
{{--                            </select>--}}
                        </div>
                     </div>
                    <div class="cart-item-bottom">
                        <button class="cart-delete-item buttons"
                                id="{{ $item->rowId }}" data-redirect="{{ 1 }}">
                            remove
                        </button>
                        <form action="{{ route('cart.switchToSaveForLater',
                                    ['product' => $item->rowId]) }}" method="POST">
                            @csrf
                            <button type="submit" class="buttons">
                                save for later
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <span class="col-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Hic magni</span>
                           <div class="d-flex flex-column offset-3">
                               <span>
                                   Subtotal
                                   <strong>
                                      $ {{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}
                                   </strong>
                               </span>
                               <span>
                                   Tax (13%)
                                   <strong>
                                       {{ presentPrice(\Gloudemans\Shoppingcart\Facades\Cart::tax()) }}
                                   </strong>
                               </span>
                               <span>
                                   Total
                                   <strong>
                                      $ {{ \Gloudemans\Shoppingcart\Facades\Cart::total() }}
                                   </strong>
                               </span>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between pt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">continue shopping</a>
                    <a href="{{ route('checkout.index') }}" class="btn btn-warning">proceed to checkout</a>
                </div>
            @else
                <h3>no items</h3>
                <a href="{{ route('products.index') }}" class="btn btn-dark btn-sm">continue shopping</a>
            @endif
            <h3>save for later</h3>
                @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('saveForLater')->count() > 0)
                    <h3 class="font-weight-bold mt-4">
                        {{ \Gloudemans\Shoppingcart\Facades\Cart::instance('saveForLater')->count() }}
                        item(s) in the save for later
                    </h3>
                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::instance('saveForLater')->content() as $item)
                    <div class="col-10 mb-4 mt-4 border-bottom pb-3 saveforlater-item-container">
                         <div class="d-flex">
                                <a href="{{ url("/products/{$item->model->id}-" . Str::slug($item->model->name)) }}">
                                 <a href="{{ route('products.show', ['product' => $item->model->id,
                                            'slug' => $item->model->name]) }}">
                                <img src="{{ asset('/images/product.jpg') }}" alt="" style="width: 50px; height: 50px; margin-right: 10px">
                            </a>
                            <div class="d-flex flex-column">
                                <span>{{ $item->model->name }}</span>
                                <small class="text-muted">{{ $item->model->details }}</small>
                            </div>
                            <div class="d-flex flex-column ml-4 mr-4">
                                <button class="btn btn-outline-dark btn-sm saveforlater-delete-item"
                                        id="{{ $item->rowId }}" data-redirect="{{ 1 }}">
                                    remove
                                </button>
                                <form action="{{ route('switchForLater.moveToCart',
                                        ['product' => $item->rowId]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-warning btn-sm mt-2">
                                        move to cart
                                    </button>
                                </form>
                            </div>
                            <span class="font-weight-bold pl-4">{{ presentPrice($item->model->price) }}</span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <h3>you have no items saved for later</h3>
                @endif
        </div>
    </div>

    @include('layouts.partials.session-message')
    @include('product.partials.mightAlsoLike')

    @push('scripts')
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ asset('/js/delete-item.js') }}"></script>
        <script src="{{ asset('/js/session-message.js') }}"></script>
        <script src="{{ asset('/js/cart.js') }}"></script>
    @endpush
@endsection
