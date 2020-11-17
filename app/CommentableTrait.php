<?php


namespace App;


use App\Models\Comment;
use App\Notifications\RepliedToThread;

trait CommentableTrait
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

    public function addComment($body)
    {
        $create_comment = $this->comments()->create([
            'user_id' => auth()->user()->id,
            'body' => $body,
        ]);
        $this->user->notify(new RepliedToThread($this));


        return $create_comment;
    }

}
