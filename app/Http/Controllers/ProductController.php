<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\QueryFilters\HighLow;
use App\QueryFilters\LowHigh;
use App\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class ProductController extends Controller
{
    public function index()
    {
        $pagination = 2;
        $categories = Category::all();

        if (request()->category) {
//            eager load
            $products = Product::with('categories')->whereHas('categories', function ($query) {
               $query->where('slug', request()->category);
            });
            $categoryName = optional($categories->where('slug', request()->category)->first())->name;
//            optional - checks if it is null
        } else {
//            $products = Product::where('featured', true);
            $products = Product::where('id', '!=', 0);
            $categoryName = 'Featured';
        }


//            $products = app(Pipeline::class)
//                ->send(Product::query())
//                ->through([
//                    HighLow::class,
//                    LowHigh::class,
//                ])
//                ->thenReturn()
//                ->get();
//
//            $products = (new Collection($products))->paginate($pagination);


        if (request()->sort == 'low_high') {
            $products = $products->orderBy('price')->paginate($pagination);
//            sotyBy - method applied to collections
//            orderBy = method for a query builder
        } elseif (request()->sort == 'high_low') {
            $products = $products->orderBy('price', 'DESC')->paginate($pagination);
        } else {
            $products = $products->paginate($pagination);
        }

        return view('product.index', compact('products', 'categories', 'categoryName'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        $mightAlsoLike = Product::where('id', '!=', $product->id)->mightAlsoLike()->get();
        return view('product.show', compact('product', 'mightAlsoLike'));
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
