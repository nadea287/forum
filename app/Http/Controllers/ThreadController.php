<?php

namespace App\Http\Controllers;

use App\Helpers\CollectionHelper;
use App\Http\Requests\StoreThreadRequest;
use App\Http\Requests\UpdateThreadRequest;
use App\Models\Tag;
use App\Models\Thread;
use App\Policies\ThreadPolicy;
use App\QueryFilters\Desc;
use App\QueryFilters\MonthOld;
use App\QueryFilters\WeekOld;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
            $threads = app(Pipeline::class)
                ->send(Thread::query())
                ->through([
                    Desc::class,
                    WeekOld::class,
                    MonthOld::class,
                ])
                ->thenReturn()
                ->get();

            $threads = (new Collection($threads))->paginate(10);
            if (request('tag')) {
                $tag = Tag::find(request('tag'));
                $threads = $tag->threads;
                $threads = (new Collection($threads))->paginate(2);
                session()->forget('place');
            } else {
                Session::flash('place', 'thread');
            }
            return view('thread.index', compact('threads'));
    }

    public function create()
    {
        return view('thread.create');
    }

    public function store(StoreThreadRequest $request)
    {
        $data = $request->validated();
        $thread = auth()->user()->threads()->create($data);
        $thread->tags()->attach($data['tag']);

        session()->flash('success', 'Thread was created!');

        return redirect('/thread');
    }

    public function show(Thread $thread)
    {
        return view('thread.show', compact('thread'));
    }

    public function edit(Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread = $thread->load('tags');
        $tagsRest = Tag::whereHas('threads', function ($query) use($thread) {
            $query->where('tag_thread.thread_id', '!=', $thread->id);
        })->get();

        return view('thread.edit', compact('thread', 'tagsRest'));
    }

    public function update(UpdateThreadRequest $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $data = $request->validated();
        $thread->update($data);

        $thread->tags()->sync($data['tag']);
        session()->flash('success', 'Thread was updated');

        return redirect("/thread/$thread->id");

//        You may use one of these two functions, sync() attach() and the difference in a nutshell is that Sync will get array as its first argument and sync it with pivot table (remove and add the passed keys in your array) which means if you got 3,2,1 as valued within your junction table, and passed sync with values of, 3,4,2, sync automatically will remove value 1 and add the value 4 for you. where Attach will take single ID value
    }

    public function destroy(Thread $thread)
    {
        $thread->delete();
        $thread->comments()->delete();
    }
}
