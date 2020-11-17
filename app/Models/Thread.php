<?php

namespace App\Models;

use App\CommentableTrait;
use App\RecordsFeed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;
    use CommentableTrait, RecordsFeed;

    protected $fillable = [
      'subject',
      'thread',
    ];

    public static function boot()
    {
        parent::boot();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('tag_id');
    }

}
