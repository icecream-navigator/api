<?php

namespace App\Services;

use App\Models\Opinion;
use App\Models\Stall;


class OpinionService
{
    public function storeMyOpinion($user, array $data, $id)
    {
        $stall = Stall::findOrFail($id);

        $opinion = new Opinion;

        $opinion->author        = $user->name;
        $opinion->author_avatar = $user->avatar;
        $opinion->stall_id      = $stall->id;

        $opinion->fill($data);

        $opinion->save();

        return $opinion;
    }
}






?>
