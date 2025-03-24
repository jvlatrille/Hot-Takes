<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Sauce extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'name',
        'manufacturer',
        'description',
        'mainPepper',
        'imageUrl',
        'heat',
        'likes',
        'dislikes',
        'usersLiked',
        'usersDisliked'
    ];

    protected $casts = [
        'usersLiked' => 'array',
        'usersDisliked' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
