<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;


class Company_expense extends Resource
{
    public static $displayInNavigation = true;
    public static $group = "9.2 งานการเงิน/บัญชี";
    public static $priority = 3;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Company_expense';

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
        'name',
    ];
    public static function label()
    {
        return 'หมวดค่าใช้จ่าย';
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
            Text::make('ค่าใช้จ่าย', 'name'),
            BelongsTo::make('ผู้ทำรายการ', 'user', 'App\Nova\User')
                ->onlyOnDetail(),
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

/**
 * Return the location to redirect the user after creation.
 *
 * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
 * @param  \Laravel\Nova\Resource  $resource
 * @return \Laravel\Nova\URL|string
 */
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/resources/'.static::uriKey();
    }

    /**
 * Return the location to redirect the user after update.
 *
 * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
 * @param  \Laravel\Nova\Resource  $resource
 * @return \Laravel\Nova\URL|string
 */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/resources/'.static::uriKey();
    }

}
