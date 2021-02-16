<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSearchResult;
use App\Http\Requests\SearchRequest;
use App\Models\Product;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $q = $request->input('q');
        if (!empty($q)) {
            $threads = Thread::where('subject', 'LIKE', "%$q%")
                ->orWhere('thread', 'LIKE', "%$q%")
                ->paginate(10);
//                ->get();
            if (count($threads) > 0) {
//                return view('layouts.partials.thread-list')->withDetails( $thread )->withQuery( $q );
                return view('thread.search-result', compact('threads'));
            }
        }
//        return view('thread.search-result', compact('threads'))->withMessage('nothing');
    }

    public function productSearch(ProductSearchResult $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%$query%")->get();

        //11.38

        return view('product.search-results', compact('products'));
    }
}
