<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Icecream extends Model implements Searchable
{
    use HasFactory;


    protected $fillable = [
        'flavour',
        'type',
        'form',
        'price',
        'quantity',
        'user_id',
        'stall_id',
        'stall_name',
        'votes'
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

    public function getSearchResult(): SearchResult
    {
        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->type,
        );
    }
}
