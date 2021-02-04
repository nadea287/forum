<div class="mb-3">
    <label for="name" class="form-label">name</label>
    <input name="name" type="text" class="form-control" value="{{ $product->name ?? old('name') }}">
    @error('name')
    <small class="text-danger font-weight-bold">
        {{ $message }}
    </small>
    @enderror
</div>
<div class="mb-3">
    <label for="slug" class="form-label">slug</label>
    <input name="slug" type="text" class="form-control" value="{{ $product->slug ?? old('slug') }}">
    @error('slug')
    <small class="text-danger font-weight-bold">
        {{ $message }}
    </small>
    @enderror
</div>
<div class="mb-3">
    <label for="details" class="form-label">details</label>
    <input name="details" type="text" class="form-control" value="{{ $product->details ?? old('details') }}">
    @error('details')
    <small class="text-danger font-weight-bold">
        {{ $message }}
    </small>
    @enderror
</div>
<div class="mb-3">
    <label for="price" class="form-label">price</label>
    <input name="price" type="number" class="form-control" value="{{ $product->price ?? old('price') }}">
    @error('price')
    <small class="text-danger font-weight-bold">
        {{ $message }}
    </small>
    @enderror
</div>
<div class="mb-3">
    <label for="description" class="form-label">description</label>
    <textarea name="description" id="" cols="80" rows="5" class="form-control">{{ $product->description ?? old('description')  }}</textarea>
    @error('description')
    <small class="text-danger font-weight-bold">
        {{ $message }}
    </small>
    @enderror
</div>
<div class="mb-3">
    <label for="cover_image" class="form-label">cover image</label>
    <input name="cover_image" type="file" class="form-control">
    @error('cover_image')
    <small class="text-danger font-weight-bold">
        {{ $message }}
    </small>
    @enderror
</div>
