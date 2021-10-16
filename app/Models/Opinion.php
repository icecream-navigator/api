<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\OpinionService;

class Opinion extends Model
{
    use HasFactory;

    protected $fillable = [
        'opinion',
        'author',
        'author_avatar',

    ];

    public function stalls()
    {
        return $this->belongsTo(Stall::class);
    }

    public function storeOpinion($user, array $data, $id)
    {
        $opinion = new OpinionService;

        return $opinion->storeMyOpinion($user, $data,$id);
    }


}
