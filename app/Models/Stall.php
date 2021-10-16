<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\StallService;

class Stall extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner',
        'location',
    ];

    public function icecreams()
    {
        return $this->hasMany(Icecream::class);
    }

    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }


    public function showStall($id)
    {
        $stall = new StallService;

        return $stall->showStallById($id);
    }

    public function showOpinions($id)
    {
        $stall = new StallService;

        return $stall->showStallWithOpinions($id);
    }

    public function storeStall($user, array $data)
    {
        $stall = new StallService;

        $stall->storeMyStall($user, $data);
    }

    public function destroyStall($id)
    {
        $stall = new StallService;

        $stall->destroyMyStall($id);
    }




}
