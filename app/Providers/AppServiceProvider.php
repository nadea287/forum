<?php

namespace App\Providers;

use App\Models\Tag;
use App\Models\Thread;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('layouts.partials.thread-list', function ($view) {
//            $tagId = Tag::find(1);
//            $tags = Tag::whereHas('threads', function ($query) use ($tagId) {
//                $query->where('tag_thread.tag_id', $tagId);
//                dd($query);
//            })->get();
//            dd($tags->count());
            if (request('tag')) {
                $tag = Tag::find(request('tag'));
                $threads = $tag->threads;
            } else {
                $threads = Thread::orderBy('id', 'DESC')->paginate(10);
            }
           $view->with('threads', $threads);
        });

        View::composer('layouts.partials.leftbanner', function ($view) {
            $tagId = Tag::select('id')->get();
            foreach ($tagId as $id) {
                $count = DB::table('tag_thread')->whereIn('tag_id', $id)->count();
//                dd($count);
            }
            $view->with('count', $count);
        });
    }
}
