<?php

namespace App\Nova\Actions;

use App\Models\Unit;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class SetProductUnit extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;
    public $onlyOnIndex = true;

    public function uriKey()
    {
        return 'set-product-unit';
    }
    public function name()
    {
        return __('Set product unit');
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
            $model->unit_id = $fields->product_unit;
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
        $units = Unit::all()->pluck('name', 'id');

        return [

            Select::make(__('Unit'), 'product_unit')
                ->options($units)
                ->searchable()
                ->displayUsingLabels()

        ];
    }
}
