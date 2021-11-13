<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Icecream extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'flavour',
        'type',
        'form',
        'price',
        'quantity',
        'user_id',
        'stall_id',
        'stall_name',
        'stall_location',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'votes' => 'integer'
    ];


    public function stalls()
    {
        return $this->belongsTo(Stall::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
