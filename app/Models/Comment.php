<?php

namespace App\Models;

use App\CommentableTrait;
use App\RecordsFeed;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use CommentableTrait, RecordsFeed;

    protected $fillable = [
      'user_id',
      'body',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wasFlaged()
    {
        return $this->hasMany(Flag::class, 'target_id');
    }

    public function hasSolution()
    {
        return $this->wasFlaged()->where('type', 'solution');
    }

}
