<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    use HasFactory;

    protected $fillable = [
      'author_id',
      'target_id',
      'type',
    ];

    static protected $allowed = ['solution'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function target()
    {
        return $this->belongsTo(Comment::class, 'target_id');
    }

    public static function isAllowed($key)
    {
        return in_array($key, Flag::$allowed);
    }

}
