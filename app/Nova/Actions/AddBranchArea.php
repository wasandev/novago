<?php

namespace App\Nova\Actions;


use App\Models\District;
use App\Models\Province;
use App\Models\Branch_area;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class AddBranchArea extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $onlyOnDetail = true;


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

            $districts = District::all()->where('province.name', $fields->province);


            foreach ($districts as $district) {
                Branch_area::updateOrCreate([
                    'branch_id' => $model->id,
                    'district' => $district->name,
                    'province' => $district->province->name,
                    'deliverydays' => '3'
                ]);
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
        $provinces = Province::all()->pluck('name', 'name');
        return [
            Select::make('เลือกจังหวัด', 'province')->options($provinces)
                ->displayUsingLabels()
                ->searchable()
        ];
    }

    public function uriKey()
    {
        return 'Add Branch Area';
    }
    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Add Branch Area');
    }
}
