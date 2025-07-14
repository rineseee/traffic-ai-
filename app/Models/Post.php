<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Post.php
    protected $fillable = [
        'title',
        'description', // ose 'content' në varësi të fushës
        'traffic_type',
        'location',
        'datetime',
        'priority',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);

    }


}
