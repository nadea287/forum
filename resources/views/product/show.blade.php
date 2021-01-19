@extends('layouts.shop.shoplayout')
@section('content')
<div class="container">
    <div class="row justify-content-center pt-4">
        <div class="col-4">
            <img src="{{ asset('/images/product.jpg') }}" alt="">
        </div>
        <div class="col-3">
            <h3>{{ $product->name }}</h3>
            <small class="text-muted">{{ $product->details }}</small>
            <h3 class="font-weight-bold">{{ $product->presentPrice() }}</h3>
            <span>{{ $product->description }}</span>
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="name" value="{{ $product->name }}">
                <input type="hidden" name="price" value="{{ $product->price}}">
                <button type="submit" class="btn btn-outline-secondary">add to cart</button>
            </form>
        </div>
    </div>
    <div class="row pt-5 justify-content-center">
        <h3>you might also like</h3>
    </div>
    @include('product.partials.mightAlsoLike')
</div>
@endsection


