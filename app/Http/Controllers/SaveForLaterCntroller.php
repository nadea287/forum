<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SaveForLaterCntroller extends Controller
{
    public function destroy($product)
    {
        \Gloudemans\Shoppingcart\Facades\Cart::instance('saveForLater')->remove($product);
    }

    public function moveToCart($product)
    {
        $item = \Gloudemans\Shoppingcart\Facades\Cart::instance('saveForLater')->get($product);
        \Gloudemans\Shoppingcart\Facades\Cart::instance('saveForLater')->remove($product);

        $duplicated = \Gloudemans\Shoppingcart\Facades\Cart::search(function (
            $cartItem,
            $rowId
        ) use ($product) {
            return $rowId === $product;
        });

        if ($duplicated->isNotEmpty()) {
            session()->flash('success', 'item is already in save for later');
            return redirect()->route('cart.index');
        }

        $result = \Gloudemans\Shoppingcart\Facades\Cart::instance('default')->add($item->id, $item->name, 1, $item->price)
            ->associate(Product::class);

        if ($result) {
            session()->flash('success', 'item has been moved to cart');
        }

        return Redirect::back();
    }
}
