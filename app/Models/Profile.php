<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image: '/profile/vEqHv71XVdKjX5kM5EpWjuvwaknfknGMGqe8HxaJ.jpeg';
        return '/storage/' . $imagePath;
    }
}
