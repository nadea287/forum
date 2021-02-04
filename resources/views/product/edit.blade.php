@extends('layouts.shop.shoplayout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <h5 class="py-4">create a product</h5>
            <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('product.partials.create_update_form')
                <div>
                    <span>current cover image</span>
                    <img src="{{ asset($product->coverImage()) }}" alt="" class="w-25">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">gallery images</label>
                    <input name="image[]" type="file" class="form-control" id="inpFile" multiple>
                    <div class="image-preview py-4" id="imagePreview">
                        {{--images preview here--}}
                    </div>
                    @error('image.*')
                    <small class="text-danger font-weight-bold">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <button type="submit" class="buttons standart-button" style="width: 100%; margin-bottom: 20px">Submit</button>
            </form>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('/js/cart.js') }}"></script>
    @endpush
@endsection
