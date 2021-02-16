<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Jobs\SendTransactionalEmail;
use App\Mail\OrderPlaces;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Traits\CheckoutTrait;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        if (auth()->user() && request()->is('guestCheckout')) {
            return redirect()->route('checkout.index');
        }

        return view('product.checkout')->with([
            'discount' => $this->getNumbers()->get('discount'),
            'newSubtotal' => $this->getNumbers()->get('newSubtotal'),
            'newTax' => $this->getNumbers()->get('newTax'),
            'newTotal' => $this->getNumbers()->get('newTotal'),
        ]);
    }

    public function store(CheckoutRequest $request)
    {
        $contents = Cart::content()->map(function ($item) {
            return $item->model->slug . ', ' . $item->qty;
        })->values()->toJson();
        try {
            $charge = Stripe::charges()->create([
               'amount' => $this->getNumbers()->get('newTotal'),
//               divide by 100 to make sure it is in USD
               'currency' => 'CAD',
               'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
//                save the order in the metadata cause we do not have a table in db
                'metadata' => [
//                  change the order ID after we start using DB
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);

            $order = $this->addToOrdersTable($request, null);
//            Mail::send(new OrderPlaces($order));

            SendTransactionalEmail::dispatch($order)
            ->delay(now()->addSeconds(5));

//            SUCCESS
            Cart::instance('default')->destroy();
            session()->forget('coupon');

            session()->flash('success', 'your paymen has been successfully accepted');
            return redirect()->route('confirmation.index');

        } catch (CardErrorException $e) {
            $this->addToOrdersTable($request, $e->getMessage());
            return back()->withErrors('Error!' . $e->getMessage());
        }
    }

    protected function addToOrdersTable($request, $error)
    {
        //insert into orders table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billibng_email' => $request->email,
            'billing_name' => $request->name,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => $this->getNumbers()->get('discount'),
            'billing_discount_code' => $this->getNumbers()->get('code'),
            'billing_subtotal' => $this->getNumbers()->get('newSubtotal'),
            'billing_tax' => $this->getNumbers()->get('tax'),
            'billing_total' => $this->getNumbers()->get('newTotal'),
            'error' => $error,
        ]);

        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }
        //insert into order_product(pivot table)

        return $order;
    }

    private function getNumbers()
    {
        $tax = config('cart.tax') / 100;
        //it comes from cart package (cart.php)

        $discount = session()->get('coupon')['discount'] ?? 0;
        $discFormat = number_format((float) str_replace(' ', '', $discount), 2);
//        Str::of($discount)->replace(' ', '');
        $newSubtotal = str_replace(',', '', number_format((float) str_replace(' ', '', Cart::subtotal()), 2)) - $discFormat;
        if ($newSubtotal < 0) {
            $newSubtotal = 0;
        }
        $newTax = $newSubtotal * number_format((float) $tax, 2);
        $newTotal = $newSubtotal + $newTax;
        $code = session()->get('coupon')['name'] ?? null;

        return collect([
           'tax' => $tax,
           'discount' => $discount,
           'newSubtotal' => $newSubtotal,
           'newTax' => $newTax,
           'newTotal' => $newTotal,
            'code' => $code,
        ]);
    }
}
