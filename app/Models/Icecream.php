<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\IcecreamService;

class Icecream extends Model
{
    use HasFactory;


    protected $fillable = [
        'flavour',
        'type',
        'form',
        'price',
        'quantity',
    ];

    public function stalls()
    {
        return $this->belongsTo(Stall::class);
    }


    public function showIcecream($id)
    {
        $icecream = new IcecreamService;

        return $icecream->showIcecreamById($id);
    }

    public function storeIcecream($user,array $data, $id)
    {
        $icecream = new IcecreamService;

        $icecream->storeMyIcecream($user, $data, $id);
    }

    public function updateIcecream(array $data, $id)
    {
        $icecream = new IcecreamService;

        $icecream->updateMyIcecream($data, $id);
    }

    public function destroyIcream($id)
    {
        $icecream = new IcecreamService;

        $icecream->destroyMyIcecream($id);
    }
}
