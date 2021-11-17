<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Stall;
use Carbon\Carbon;

class SetStallStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stall:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set Stall status based on open and close times';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Stall $stall)
    {
        foreach($stall->all() as $model)
        {
            $startTime   = $model->open;
            $endTime     = $model->close;
            $currentTime = \Carbon\Carbon::now('UTC');
            $start = Carbon::createFromTimeString($startTime);
            $end = Carbon::createFromTimeString($endTime)->addDay();



            if($currentTime->between($start, $end))
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
}
