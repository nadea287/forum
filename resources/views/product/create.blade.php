@extends('layouts.shop.shoplayout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <h5 class="py-4">create a product</h5>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('product.partials.create_update_form')
                <button type="submit" class="buttons standart-button" style="width: 100%; margin-bottom: 20px">Submit</button>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('/js/cart.js') }}"></script>
    @endpush

@endsection
