<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;

class Branch_route_cost extends Resource
{
    public static $displayInNavigation = false;
    public static $group = "5.งานจัดการการขนส่ง";
    public static $priority = 4;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Branch_route_cost';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];
    public static function label()
    {
        return 'ต้นทุนตามเส้นทางภายในสาขา';
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
            ID::make(),
            Boolean::make('ใช้งาน', 'status')
                ->sortable()
                ->rules('required'),

            BelongsTo::make('เส้นทางขนส่งของสาขา', 'branch_route', 'App\Nova\Branch_route')
                ->sortable()
                ->rules('required'),
            BelongsTo::make('ประเภทรถ', 'cartype', 'App\Nova\Cartype')
                ->sortable()
                ->rules('required'),
            BelongsTo::make('ลักษณะรถ', 'carstyle', 'App\Nova\Carstyle')
                ->sortable()
                ->nullable(),
            Currency::make('ค่าจ้างรถ(กรณีรถร่วม)', 'car_charge')
                ->sortable()
                ->nullable(),
            Currency::make('เบี้ยเลี้ยงพนักงานขับรถ(กรณีรถบริษัท)', 'driver_charge')
                ->sortable()
                ->nullable(),
            Currency::make('ค่าเชื้อเพลิงที่ใช้(บาท)', 'fuel_cost')
                ->sortable()
                ->nullable(),
            Currency::make('จำนวนเชื้อเพลิงที่ใช้(ลิตร)', 'fuel_amount')
                ->sortable()
                ->nullable()
                ->hideFromIndex(),
            Number::make('ระยะเวลาขนส่ง(ชม.)', 'timespent')
                ->step('0.01')
                ->hideFromIndex()
                ->nullable(),
            BelongsTo::make(__('Created by'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user_update', 'App\Nova\User')
                ->OnlyOnDetail(),
            DateTime::make(__('Updated At'), 'updated_at')
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
}
