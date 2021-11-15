<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Carbon\Carbon;

class Stall extends Model
{
    use HasFactory,Favoriteable;

    protected $fillable = [
        'name',
        'owner',
        'town',
        'postal_code',
        'street',
        'place_name',
        'photo',
        'user_id',
        'lat',
        'lon',
        'open',
        'close',
        'status'

    ];

    protected $hidden = [
        'photo',
        'photo_name',
        'created_at',
        'updated_at'
    ];


    public function setRateAttribute($rate)
    {
        $this->attributes['rate'] = number_format($rate, 2);
    }

    public function getOpenAttribute($open)
    {
        return date('H:i', strtotime($this->attributes['open']));
    }

    public function getCloseAttribute($open)
    {
        return date('H:i', strtotime($this->attributes['close']));
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
