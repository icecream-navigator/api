<?php

namespace App\Observers;

use App\Models\Stall;

class StallObserver
{
    /**
     * Handle the Stall "created" event.
     *
     * @param  \App\Models\Stall  $stall
     * @return void
     */
    public function created(Stall $stall)
    {
        foreach($stall->all() as $model)
        {
            $startTime   = $model->open;
            $endTime     = $model->close;
            $currentTime = \Carbon\Carbon::now();


            if($currentTime->betweenExcluded($startTime, $endTime))
            {
                $model->status = 'Open';
                $model->update();

            }
            else{
                $model->status = 'Closed';
                $model->update();
            }
        }
    }

    /**
     * Handle the Stall "updated" event.
     *
     * @param  \App\Models\Stall  $stall
     * @return void
     */
    public function updated(Stall $stall)
    {
        $this->created($stall);
    }

    /**
     * Handle the Stall "deleted" event.
     *
     * @param  \App\Models\Stall  $stall
     * @return void
     */
    public function deleted(Stall $stall)
    {
        $this->created($stall);
    }

    /**
     * Handle the Stall "restored" event.
     *
     * @param  \App\Models\Stall  $stall
     * @return void
     */
    public function restored(Stall $stall)
    {
        //
    }

    /**
     * Handle the Stall "force deleted" event.
     *
     * @param  \App\Models\Stall  $stall
     * @return void
     */
    public function forceDeleted(Stall $stall)
    {
        //
    }
}
