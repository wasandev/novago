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

class PrintWaybill extends Action
{
    use InteractsWithQueue, Queueable;

    public function uriKey()
    {
        return 'print-waybill';
    }
    public function name()
    {
        return __('Print Waybill');
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
            if ($model->waybill_status == 'loading') {
                return Action::danger('ไม่สามารถพิมพ์ใบกำกับสินค้าที่ยังไม่ยืนยันรายการ');
            }
            return Action::openInNewTab('/waybill/preview/' . $model->id);
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
