@extends('layouts.shop.shoplayout')
@section('content')
<div class="container">
    <div class="row justify-content-center pt-4 single-product-show">
        <div>
            <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="buttons standart-button">edit</a>
        </div>
        <div class="col-4">
            <div class="product-section-image">
                <img src="{{ asset($product->coverImage()) }}" alt="" id="current-image" class="seletcted-img">
            </div>
            <div class="product-section-images">
                <div class="product-section-thumbnail seletcted-img">
                    <img src="{{ asset($product->coverImage()) }}" alt="">
                </div>
                @foreach($product->images as $image)
                    <div class="product-section-thumbnail">
                        <img src="{{ asset($image->image) }}" alt="">
                    </div>
                @endforeach
            </div>
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

<script>
    (function () {
       const currentImage = document.querySelector('#current-image');
       const images = document.querySelectorAll('.product-section-thumbnail');

       images.forEach((element) => element.addEventListener('click', thumbnailClick));

       function thumbnailClick(e) {
               currentImage.classList.remove('seletcted-img');
               currentImage.addEventListener('transitionend', () => {
               currentImage.src = this.querySelector('img').src;
               currentImage.classList.add('seletcted-img');
           });

           images.forEach((element) => element.classList.remove('seletcted-product'));
           this.classList.add('seletcted-product');
       }

    })();
</script>
@endsection


