<?php

namespace App\Nova\Actions;


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
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\BooleanGroup;
use OptimistDigital\MultiselectField\Multiselect;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\FormData;
use Illuminate\Database\Eloquent\Builder;

class AddProductServicePriceDistrict extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;
    //public $showOnTableRow = true;

    public function uriKey()
    {
        return 'Add Product Service Price District';
    }
    public function name()
    {
        return __('Add Product Service Price District');
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


            $branch_areas = $fields->district;
            if ($fields->product_unit) {
                $uses_unit = $model->unit_id;
            } else {
                $uses_unit = $fields->unit;
            }
            foreach ($branch_areas as $branch_area => $value) {
                if ($value) {
                    $area = Branch_area::find($branch_area);

                    Productservice_price::updateOrCreate(
                        [
                            'product_id' => $model->id,
                            'from_branch_id' => $fields->from_branch_id,
                            'district' => $area->district,
                            'province' => $area->province,
                            'unit_id' => $uses_unit
                        ],
                        [
                            'price' => $fields->item_price

                        ]
                    );
                }
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

        $branch_area = DB::table('branch_areas')
            ->join('branches', 'branch_areas.branch_id', 'branches.id')
            ->where('branches.code', '<>', '001')
            ->pluck('branch_areas.district', 'branch_areas.id');

        return [

            Select::make(__('From branch'), 'from_branch_id')
                ->options($branches)
                ->displayUsingLabels()
                ->rules('required'),

            BooleanGroup::make('ไปอำเภอ', 'district')
                ->options($branch_area)
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
                ->step('0.01'),

        ];
    }
}
