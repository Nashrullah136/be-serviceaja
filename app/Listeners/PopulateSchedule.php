<?php

namespace App\Listeners;

use App\Events\MotorCreated;
use App\Models\Schedule;
use App\Models\Sparepart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PopulateSchedule implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  App\Events\MotorCreated  $event
     * @return void
     */
    public function handle(MotorCreated $event)
    {
        Sparepart::all()->each(function ($sparepart) use($event) {
            $schedule = new Schedule();
            $schedule->sparepart_id = $sparepart->id;
            $schedule->motor_id = $event->motor_id;
            $schedule->update = $event->purchase_date;
            $schedule->save();
        });
    }
}
