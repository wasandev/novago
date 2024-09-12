<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class PrintOrderMobile extends Action
{
    use InteractsWithQueue, Queueable;
    public $withoutActionEvents = true;
    public function uriKey()
    {
        return 'print-order-mobile';
    }
    public function name()
    {
        return __('Print Order Mobile');
    }


    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            if ($model->order_status == 'new') {
                return Action::danger('ไม่สามารถพิมพ์ใบรับส่งที่ยังไม่ยืนยันรายการ');
            }
            $orderheaderController =  new \App\Http\Controllers\OrderHeaderController();
            //$path = $orderheaderController->preview($model->id);

            return Action::openInNewTab('/orderheader/preview/' . $model->id);
            //return Action::push('/resources/order_orders');
        }
    }
    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }
}
