@include('layouts.partials.appheader')
<div class="container">
    <div class="row d-flex justify-content-around">
        @foreach($products as $product)
            <div class="card my-4" style="width: 18rem;">
                <a href="{{ route('products.show', ['product' => $product->id]) }}">
                    <img src="{{ asset('/images/product.jpg') }}" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ \Illuminate\Support\Str::substr($product->description, 0, 20) }} ...</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{ $product->presentPrice() }}</li>
                </ul>
                <div class="card-body">
                    <a href="{{ route('products.show', ['product' => $product->id]) }}" class="card-link">details</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        <div class="col-3 mb-4">
            <a href="{{ route('products.index') }}" class="btn btn-secondary btn-block">see more</a>
        </div>
    </div>
</div>
