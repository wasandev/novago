<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Actions\ExportAsCsv;

class Cartype extends Resource
{
    //public static $displayInNavigation = false;
    public static $group = "3.งานด้านรถบรรทุก";
    public static $priority = 1;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Cartype';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    public static function availableForNavigation(Request $request)
    {
        return $request->user()->hasPermissionTo('edit cartypes');
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'payload'
    ];
    public static function label()
    {
        return 'ข้อมูลประเภทรถ';
    }

    public static function singularLabel()
    {
        return 'ประเภทรถ';
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
            Text::make(__('Name'), 'name')->sortable(),
            Number::make(__('Payload(Kg.)'), 'payload')
                ->sortable()
                ->displayUsing(function ($value) {
                    return number_format($value, 2, '.', ',');
                })
                ->step(0.01),
            Number::make('จำนวนรถ', function() {
                return $this->cars->count('id');                
            })->exceptOnForms(),
           
            BelongsTo::make(__('Created by'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')
                
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user_update', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Updated At'), 'updated_at')
                
                ->onlyOnDetail(),
            HasMany::make(__('Car'), 'cars', 'App\Nova\Car')
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
        return [
            ExportAsCsv::make()->nameable(),
        ];
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
