<?php


namespace App;


use App\Models\Feed;

trait RecordsFeed
{
    //we can decalare boot inside the trat (boot + name of trait)
    protected static function bootRecordsFeed()
    {
        static::created(function ($thread) {
            $thread->recordFeed('created');
        });
    }

    public function recordFeed($event)
    {
        $this->feeds()->create([
            'user_id' => auth()->user()->id,
            'type' => $event . '_' . strtolower(class_basename($this)),
        ]);
    }

    public function feeds()
    {
        return $this->morphMany(Feed::class, 'feedable');
    }
}
