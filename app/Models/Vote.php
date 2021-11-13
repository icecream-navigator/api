<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'icecream_id',
    ];


    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function icecreams()
    {
        return $this->belongsTo(Icecream::class);
    }
}
