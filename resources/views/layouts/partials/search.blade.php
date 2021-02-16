<form action="{{ route('product.search') }}" method="GET" role="search">
    <div class="search-box">
        <input type="text" name="query" value="{{ request()->input('query') }}" placeholder="search">
        <button type="submit" class="buttons">
            <i class="fa fa-search" aria-hidden="true"></i>
        </button>
    </div>
    @error('query')
    <small class="text-danger font-weight-bold">
        {{ $message }}
    </small>
    @enderror
</form>
