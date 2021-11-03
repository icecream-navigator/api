<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

class Stall extends Model
{
    use HasFactory,Favoriteable;

    protected $fillable = [
        'name',
        'owner',
        'location',
        'photo',
        'photo_url',
        'photo_name',
        'user_id'
    ];

    protected $hidden = [
        'photo',
        'photo_name'
    ];

    public function icecreams()
    {
        return $this->hasMany(Icecream::class);
    }

    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }
}
