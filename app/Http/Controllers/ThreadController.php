<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThreadRequest;
use App\Http\Requests\UpdateThreadRequest;
use App\Models\Tag;
use App\Models\Thread;
use App\Policies\ThreadPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
//        if (request('tag')) {
//            $tag = Tag::find(request('tag'));
//            $threads = $tag->threads;
//            dump($threads);
//        } else {
//            $threads = Thread::all();
//        }
        return view('thread.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('thread.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

//        foreach ($thread->tags as $tag)
//        $tage = $tag->tag_id;
//        dd($tage);
//           $here = Tag::where('id', $tag)->get();
//        dd($here);
            $threadId = $thread->id;
            $tags = Tag::whereHas('threads', function ($query) use($threadId) {
//                $query->where('id', $threadId);
                $query->where('tag_thread.thread_id', $threadId);
            })->get();
            foreach($tags as $tag) {
                $tagId = $tag->id;
//                $same = Tag::whereIn('id', $tags)->pluck('id');
//                dd($same);
            }
//            dd($tag->id); id of tags of this particular thread



        return view('thread.edit', compact('thread', 'tagId'));
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
