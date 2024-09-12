<?php

namespace App\Observers;

use App\Models\Delivery_costitem;

class DeliveryCostitemObserver
{
    public function creating(Delivery_costitem $delivery_costitem)
    {
        $delivery_costitem->user_id = auth()->user()->id;
    }

    public function updating(DeliverY_costitem $delivery_costitem)
    {
        $delivery_costitem->updated_by = auth()->user()->id;
    }
}
