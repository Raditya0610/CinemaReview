<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'film_id', 'content', 'rating'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
