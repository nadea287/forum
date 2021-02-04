<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdustImages;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\QueryFilters\HighLow;
use App\QueryFilters\LowHigh;
use App\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $pagination = 5;
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
        return view('product.create');
    }

    public function store(StoreProdustImages $request)
    {
        if (! is_dir(public_path('/storage/product'))) {
            mkdir(public_path('/storage/product'), 0777);
        }

        $coverImage = $request->cover_image;
        $uploadImg = $coverImage->store('product', 'public');

        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'details' => $request->details,
            'price' => $request->price,
            'description' => $request->description,
            'cover_image' => $uploadImg,
        ]);

//        if ($product) {
////            if (! is_dir(public_path('/storage/product'))) {
////                mkdir(public_path('/storage/product'), 0777);
////            }
//            $images = \Illuminate\Support\Collection::wrap($request->file('image'));
//            $images->each(function ($image) use ($product) {
//                $basename = Str::random();
//                $original = $basename . '.' . $image->getClientOriginalExtension();
//                $image->move(public_path('/storage/product/'), $original);
//                ProductImage::create([
//                    'product_id' => $product->id,
//                    'image' => '/storage/product/' . $original,
//                ]);
//            });
//
//        }
            session()->flash('success', 'product was created');
            return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        $mightAlsoLike = Product::where('id', '!=', $product->id)->mightAlsoLike()->get();
        return view('product.show', compact('product', 'mightAlsoLike'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        if (request('cover_image')) {
            $coverImage = $request->cover_image;
            $uploadImg = $coverImage->store('product', 'public');
            $imageArray = ['cover_image' => $uploadImg];
            $product->update(array_merge(
               $imageArray ?? []
            ));
        }
        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'details' => $request->details,
            'price' => $request->price,
            'description' => $request->description,
        ]);

                if ($product) {
//            if (! is_dir(public_path('/storage/product'))) {
//                mkdir(public_path('/storage/product'), 0777);
//            }
            $images = \Illuminate\Support\Collection::wrap($request->file('image'));
            $images->each(function ($image) use ($product) {
                $basename = Str::random();
                $original = $basename . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/storage/product/'), $original);
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => '/storage/product/' . $original,
                ]);
            });

        }
    }

    public function destroy(Product $product)
    {
        //
    }
}
