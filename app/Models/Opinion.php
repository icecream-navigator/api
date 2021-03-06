<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;

    protected $fillable = [
        'opinion',
        'author',
        'author_avatar',

    ];

    protected $hidden = [
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',

    ];

    public function stalls()
    {
        return $this->belongsTo(Stall::class);
    }
}
