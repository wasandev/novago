<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\FormData;
use Illuminate\Database\Eloquent\Builder;


use Laravel\Nova\Http\Requests\NovaRequest;
use Manmohanjit\BelongsToDependency\BelongsToDependency;
use SebastianBergmann\CodeCoverage\Filter;

class Charter_route extends Resource
{
    //public static $displayInNavigation = false;
    public static $group = "6.งานขนส่งแบบเหมา";
    public static $priority = 1;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Charter_route';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name',  'to_district', 'to_province'
    ];

    public static function label()
    {
        return 'เส้นทางขนส่งเหมาคัน';
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
            Boolean::make(__('Status'), 'status')
                ->sortable()
                ->default(true),
            Text::make(__('Name'), 'name')
                ->sortable()
                ->exceptOnForms(),
            //Belongsto::make('สาขาต้นทาง', 'branch', 'App\Nova\Branch'),
            Belongsto::make('อำเภอต้นทาง', 'branch_area', 'App\Nova\Branch_area')
                //->searchable()
                ->sortable()
                ->showCreateRelationButton(),
            BelongsTo::make('ไปจังหวัด', 'province_name', 'App\Nova\Province')
                    ->sortable()
                    ->searchable()
                    ->rules('required'),
                   
            BelongsTo::make('ไปอำเภอ','district_name','App\Nova\District')
                    ->dependsOn(['province_name'], function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                            
                            $province = $formData->province_name ;
                            
                            if ($province) {
                                $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($province) {
                                                   
                                    $query->where('province_id',$province );
                                });
                                
                            }
                        }
                    )
                    ->rules('required')
                    ->withSubtitles()
                    ->sortable(),
            

            Number::make(__('Distance'), 'distance')
                ->step('0.01')
                ->sortable()
                ->exceptOnForms()
                ->hideFromIndex(),
            BelongsTo::make(__('Created by'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user_update', 'App\Nova\User')
                ->OnlyOnDetail(),
            DateTime::make(__('Updated At'), 'updated_at')
                ->onlyOnDetail(),
            //HasMany::make('ต้นทุนขนส่งแบบเหมาคัน', 'charter_route_costs', 'App\Nova\Charter_route_cost'),
            HasMany::make('ราคาค่าขนส่งแบบเหมาคัน', 'charter_prices', 'App\Nova\Charter_price'),
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
        return [
            new Filters\ToProvince,
        ];
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

    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/resources/' . static::uriKey();
    }

    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/resources/' . static::uriKey();
    }
}
