<?php

namespace App\Services;

use App\Models\Icecream;
use App\Models\Stall;

class IcecreamService
{

    public function showIcecreamById($id)
    {

        $icecream = Icecream::where('id', $id);

        return $icecream;
    }

    public function storeMyIcecream($user, $data, $id)
    {

        $icecream = new Icecream;

        $stall = Stall::findOrFail($id);

        $icecream->user_id = $user->id;

        $icecream->stall_id = $id;

        $icecream->fill($data);

        $icecream->save();



    }

    public function updateMyIcecream($data, $id)
    {
        $icecream = Icecream::findOrFail($id);

        $icecream->update($data);

    }

    public function destroyMyIcecream($id)
    {
        $icecream = Icecream::findOrFail($id);

        $icecream->delete();
    }
}













?>
