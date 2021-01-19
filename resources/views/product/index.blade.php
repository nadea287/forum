@extends('layouts.shop.shoplayout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-2">
            <h4>by category</h4>
            <ul>
                @foreach($categories as $category)
                    <li class="{{ setActiveCategory($category->slug) }}">
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-10">
            <div>
                <h3>{{ $categoryName }}</h3>
                <div>
                    <strong>price</strong>
                    <a href="{{ route('products.index', ['category' => request()->category,
                            'sort' => 'low_high']) }}">low to high</a>
                    <a href="{{ route('products.index', ['category' => request()->category,
                            'sort' => 'high_low']) }}">high to low</a>
                </div>
            </div>
            <div class="row d-flex justify-content-around">
                @forelse($products as $product)
                    <div class="card my-4" style="width: 18rem;">
                        <a href="{{ $product->path() }}">
                            <img src="{{ asset('/images/product.jpg') }}" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">
                                {{ \Illuminate\Support\Str::substr($product->description, 0, 20) }} ...
                            </p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $product->presentPrice() }}</li>
                        </ul>
                        <div class="card-body">
                            <a href="{{ $product->path() }}" class="card-link">details</a>
                        </div>
                    </div>
                    @empty
                    <span>no items found</span>
                @endforelse
            </div>
        </div>

    </div>
    </div>
    {{ $products->appends(request()->input())->links() }}
@endsection
