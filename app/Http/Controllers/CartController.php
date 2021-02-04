<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateQuamtityRequest;
use App\Models\Product;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {
        $mightAlsoLike = Product::mightAlsoLike()->get();
        return view('cart.index', compact('mightAlsoLike'));
    }

    public function store(Request $request)
    {
        $duplicates = \Gloudemans\Shoppingcart\Facades\Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        if ($duplicates->isNotEmpty()) {
            session()->flash('success', 'item is already in your cart');
            return redirect()->route('cart.index');
        }
        $result = \Gloudemans\Shoppingcart\Facades\Cart::add($request->id, $request->name, 1, $request->price)
            ->associate(Product::class);
        if ($result) {
            session()->flash('success', 'item was added to the cart');
        }

        return redirect('cart');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
           'quantity' => 'required|numeric|between:1,5'
        ]);
        if ($validator->fails()) {
            session()->flash('error', 'quantity must be between 1 and 5');
            return response()->json(['error' => false], 400);
        }
        $item = \Gloudemans\Shoppingcart\Facades\Cart::update($id, $request->quantity);
        $itemPrice = presentPrice($item->subtotal);

        $result = [
            'price' => $itemPrice,
        ];

        return json_encode($result);
    }

    public function destroy($cart)
    {
        \Gloudemans\Shoppingcart\Facades\Cart::remove($cart);
    }
    public function switchToSaveForLater($product)
    {
        $item = \Gloudemans\Shoppingcart\Facades\Cart::get($product);
        \Gloudemans\Shoppingcart\Facades\Cart::remove($product);

        $duplicated = \Gloudemans\Shoppingcart\Facades\Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($product) {
            return $rowId === $product;
        });

        if ($duplicated->isNotEmpty()) {
            session()->flash('success', 'item is already in save for later');
            return redirect()->route('cart.index');
        }

        $result = \Gloudemans\Shoppingcart\Facades\Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)
            ->associate(Product::class);

        session()->flash('success', 'item has been saved for later');

        return Redirect::back();
    }
}
