<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\ReplyToCommentRequest;
use App\Models\Comment;
use App\Models\Thread;
use App\Notifications\RepliedToThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use function PHPUnit\Framework\isEmpty;

class CommentController extends Controller
{
    public function store(CreateCommentRequest $request, Thread $thread)
    {
        $data = $request->validated();
//        $create_comment = $thread->comments()->create([
//           'user_id' => auth()->user()->id,
//           'body' => $data['body'],
//        ]);

        $create_comment = $thread->addComment($data['body']);

//        $thread->user->notify(new RepliedToThread($thread));
//        session()->flash('success','Comment Was Created');

//        return Redirect::back();
        $response_message = [
          'comment' => $create_comment->orderBy('id', 'DESC')->first(),
            'user_name' => auth()->user()->name,
//            'message' => 'Comment Added',
        ];

        return json_encode($response_message);
    }

    public function replyToComment(ReplyToCommentRequest $request, Comment $comment)
    {
        $data = $request->validated();

//        $create_reply = $comment->comments()->create([
//           'user_id' => auth()->user()->id,
//           'body' => $data['body'],
//        ]);

        $created_reply = $comment->addComment($data['body']);

        $response_message = [
          'reply' => $created_reply->orderBy('id', 'DESC')->first(),
            'user_name' => auth()->user()->name,
        ];

        return json_encode($response_message);
    }

    public function markAsRead()
    {
//        dd(auth()->user()->unreadNotifications());
        auth()->user()->unreadNotifications->markAsRead();
        if (!isEmpty(auth()->user()->notifications())) {
        auth()->user()->notifications()
            ->where('notifiable_id', auth()->user()->id)
            ->get()
            ->first()
            ->delete();
            }

    }
}
