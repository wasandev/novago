<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Query\Search\SearchableRelation;
use Laravel\Nova\Http\Requests\NovaRequest;

class SubDistrict extends Resource
{
    //public static $displayInNavigation = false;
    public static $group = '1.งานสำหรับผู้ดูแลระบบ';
    public static $globallySearchable = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\SubDistrict';

    public static function availableForNavigation(Request $request)
     {
        return $request->user()->hasPermissionTo('edit sub-districts');
     }
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public function subtitle()
    {
        $province_district = \App\Models\District::where('id', $this->district_id)->first();
        $province = \App\Models\Province::find($province_district->province_id);

        return  $this->district->name . ' ' . $province->name;
    }
    public static function searchableColumns()
    {
        return [
            'name',
            new SearchableRelation('district', 'name')
        ];
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'district.name'
    ];

    public static function label()
    {
        return 'ข้อมูลตำบล';
    }
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('จังหวัด', function () {
                return $this->district->province->name;
            }),

            BelongsTo::make('อำเภอ', 'district', 'App\Nova\District')
                ->sortable()
                ->searchable(),
            Text::make('ตำบล', 'name')->sortable(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
