<div class="wrap-select">
    <form class="select-qty">
    <span class="font-weight-bold cart-item-price" id="">{{ presentPrice($itemPrice ?? $item->subtotal) }}</span>
        <select class="quantity" id="{{ $item->rowId }}" data-id="{{ $item->rowId }}"
                data-productQuantity="" name="quantity">
                @for ($i = 1; $i < 5 + 1 ; $i++)
                    <option {{ $item->qty == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
    </form>
</div>
