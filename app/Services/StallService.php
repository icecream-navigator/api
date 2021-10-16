<?php

namespace App\Services;

use App\Models\Stall;


class StallService
{
    public function showStallById($id)
    {

        $stall = Stall::with('icecreams')
            ->where('id', $id)
            ->get();

        return $stall;
    }

    public function showStallWithOpinions($id)
    {
        $stall = Stall::with('opinions')
            ->where('id', $id)
            ->get();

        return $stall;
    }

    public function storeMyStall($user, $data)
    {
        $stall = new Stall;

        $stall->owner = $user->name;

        $stall->fill($data);

        $stall->save();
    }

    public function destroyMyStall($id)
    {
        $stall = Stall::findOrFail($id);

        $stall->delete();
    }
}


?>
