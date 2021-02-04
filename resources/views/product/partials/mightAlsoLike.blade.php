<div class="row justify-content-center d-flex">
@foreach($mightAlsoLike as $product)
    <div class="pr-5 light-slider">
        <a href="{{ $product->path() }}">
            <img src="{{ asset($product->coverImage()) }}" alt="" class="w-50">
        </a>
        <h6>{{ $product->name }}</h6>
        <small class="font-weight-bold">{{ $product->presentPrice() }}</small>
    </div>
@endforeach
</div>

