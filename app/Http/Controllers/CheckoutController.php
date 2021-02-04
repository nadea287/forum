<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
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
//            SUCCESS
            Cart::instance('default')->destroy();
            session()->forget('coupon');

            session()->flash('success', 'your paymen has been successfully accepted');
            return redirect()->route('confirmation.index');

        } catch (CardErrorException $e) {
            return back()->withErrors('Error!' . $e->getMessage());
        }
    }

    private function getNumbers()
    {
        $tax = config('cart.tax') / 100;
        //it comes from cart package (cart.php)

        $discount = session()->get('coupon')['discount'] ?? 0;
        $discFormat = number_format((float) str_replace(' ', '', $discount), 2);
//        Str::of($discount)->replace(' ', '');
        $newSubtotal = str_replace(',', '', number_format((float) str_replace(' ', '', Cart::subtotal()), 2)) - $discFormat;
        $newTax = $newSubtotal * number_format((float) $tax, 2);
        $newTotal = $newSubtotal + $newTax;

        return collect([
           'tax' => $tax,
           'discount' => $discount,
           'newSubtotal' => $newSubtotal,
           'newTax' => $newTax,
           'newTotal' => $newTotal,
        ]);
    }
}
