<div class="row justify-content-center d-flex">
@foreach($mightAlsoLike as $product)
    <div class="pr-5 light-slider">
        <a href="{{ $product->path() }}">
            <img src="{{ asset('/images/product.jpg') }}" alt="">
        </a>
        <h6>{{ $product->name }}</h6>
        <small class="font-weight-bold">{{ $product->presentPrice() }}</small>
    </div>
@endforeach
</div>

