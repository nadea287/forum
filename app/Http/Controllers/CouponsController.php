<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CouponsController extends Controller
{
    public function store(Request $request)
    {
        $coupon = Coupon::findByCode($request->coupon_code);
        if (!$coupon) {
            session()->flash('error', 'invalid coupon code, please try again');
            return Redirect::back();
        }
        //store the information in a session
        //put the info in a session key called 'coupon'
        session()->put('coupon', [
            'name' => $coupon->code,
            'discount' => $coupon->discount(Cart::subtotal()),
        ]);

        session()->flash('success', 'coupon discount has been applied');
        return Redirect::back();

    }


    public function destroy()
    {
        session()->forget('coupon');

        session()->flash('success', 'coupon has been removed');
        return Redirect::back();
    }
}
