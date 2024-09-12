<?php

namespace App\Nova\Actions;


use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Http\Requests\NovaRequest;

class SetCustomerProductPriceActive extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;
    public $onlyOnIndex = true;

    public function uriKey()
    {
        return 'Set Customer Product Price Active';
    }
    public function name()
    {
        return __('Set Customer Product Price Active');
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
            if ($model->active) {
                $model->active = 0;
            } else {
                $model->active = 1;
            }

            $model->save();
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {


        return [

            //Boolean::make('ใข้งาน', 'item_price'),



        ];
    }
}
