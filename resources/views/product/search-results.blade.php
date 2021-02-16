@extends('layouts.shop.shoplayout')
@section('content')
<div class="container">
    <div class="col-6">
        <x-breadcrumb>
            <li class="breadcrumbs_item">
                <a href="{{ route('products.index') }}" class="breadcrumbs_link">All Products</a>
            </li>
            <li class="breadcrumbs_item">
                <a href="" class="breadcrumbs_link breadcrumbs_link_active">Search</a>
            </li>
        </x-breadcrumb>
    </div>
    <div class="row">
        <div class="col-10">
            <h3>Search Results</h3>
            <p>{{ $products->count() }} result(s) for '{{ request()->input('query') }}'</p>
            @foreach($products as $product)
                <div>{{ $product->name }}</div>
            @endforeach
        </div>
    </div>
    </div>
{{--    {{ $products->appends(request()->input())->links() }}--}}
@endsection
