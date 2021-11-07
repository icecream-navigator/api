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
        'user_id',
        'rate',
        'rates_time'
    ];

    protected $hidden = [
        'photo',
        'photo_name',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'rate'       => 'float',
        'rates_time' => 'integer'
    ];

    public function setRateAttribute($rate)
    {
        $this->attributes['rate'] = number_format($rate, 2);
    }

    public function icecreams()
    {
        return $this->hasMany(Icecream::class);
    }

    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
