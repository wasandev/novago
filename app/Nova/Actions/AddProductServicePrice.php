<?php

namespace App\Nova\Actions;

use App\Models\SubDistrict;
use App\Models\District;
use App\Models\Branch_area;
use App\Models\Branch;
use App\Models\Unit;
use App\Models\Productservice_price;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\FormData;
use Illuminate\Database\Eloquent\Builder;

class AddProductServicePrice extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;
    //public $showOnTableRow = true;

    public function uriKey()
    {
        return 'Add Product Service Price';
    }
    public function name()
    {
        return __('Add Product Service Price');
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


            $branch_areas = Branch_area::where('branch_id', $fields->to_branch_id)->get();
            if ($fields->product_unit) {
                $uses_unit = $model->unit_id;
            } else {
                $uses_unit = $fields->unit;
            }

            foreach ($branch_areas as $branch_area) {

                Productservice_price::updateOrCreate(
                    [
                        'product_id' => $model->id,
                        'from_branch_id' => $fields->from_branch_id,
                        'district' => $branch_area->district,
                        'province' => $branch_area->province,
                        'unit_id' => $uses_unit
                    ],
                    [
                        'price' => $fields->item_price

                    ]
                );
            }
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {


        $branches  = Branch::all()->pluck('name', 'id');

        $units = Unit::all()->pluck('name', 'id');

        return [

            Select::make(__('From branch'), 'from_branch_id')
                ->options($branches)
                ->displayUsingLabels()
                ->rules('required'),
            Select::make(__('To branch'), 'to_branch_id')
                ->options($branches)
                ->displayUsingLabels()
                ->rules('required'),
            Boolean::make(__('Used product unit'), 'product_unit')
                ->default(true),
            Select::make(__('Unit'), 'unit')
                ->options($units)
                ->displayUsingLabels()
                ->searchable()              
                 ->hide()
                ->dependsOn('product_unit', function (Select $field, NovaRequest $request, FormData $formData) {
                        if ($formData->product_unit) {
                            $field->show()->rules('required');
                        }
                        }),
            Number::make(__('Shipping cost'), 'item_price')
                ->step('0.01')
                ->rules('required'),



        ];
    }
}
