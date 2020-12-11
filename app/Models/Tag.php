<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Tag extends Model
{
    use HasFactory;
//    protected $fillable = ['name'];
protected $guarded  = [];
    public function threads()
    {
        return $this->belongsToMany(Thread::class)->withPivot('thread_id');
    }

}
