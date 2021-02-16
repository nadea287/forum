@component('mail::message')
    # Order Received

    Thank you for your order!

    ++Order ID: {{ $order->id }} <br>
    ++Order Email: {{ $order->billibng_email }} <br>
    ++Order Billing Name: {{ $order->billing_name }} <br>
    ++Order Total: ${{ round($order->billing_total, 2) }} <br>

    ++Items Ordered

    @foreach($order->products as $product)
        Name: {{ $product->name }}
        Price: ${{ $product->price, 2 }}
        Quantity: {{ $product->pivot->quantity }}
    @endforeach

    You can get further details about your order by logging into our website.

    @component('mail::button', ['url' => config('app.url'), 'color' => 'gray'])
        Go to Website
    @endcomponent

    Thank you again for choosing us!

    Regards,<br>
    {{ config('app.name') }}
@endcomponent



