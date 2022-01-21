<?php

namespace App\Observers;

use App\Models\Criteria;

class CriteriaObserver
{
    /**
     * Handle the Criteria "created" event.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return void
     */
    public function created(Criteria $criteria)
    {
        //
    }

    /**
     * Handle the Criteria "updated" event.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return void
     */
    public function updated(Criteria $criteria)
    {
        //
    }

    /**
     * Handle the Criteria "deleted" event.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return void
     */
    public function deleted(Criteria $criteria)
    {
        $criteria->details()->each(fn ($detail) => $detail->delete());
    }

    /**
     * Handle the Criteria "restored" event.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return void
     */
    public function restored(Criteria $criteria)
    {
        //
    }

    /**
     * Handle the Criteria "force deleted" event.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return void
     */
    public function forceDeleted(Criteria $criteria)
    {
        //
    }
}
