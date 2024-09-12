<?php

namespace App\Nova;

use App\Nova\Filters\RouteToBranch;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Http\Requests\NovaRequest;

class Routeto_branch_cost extends Resource
{
    
    public static $group = "5.งานจัดการการขนส่ง";
    public static $priority = 3;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Routeto_branch_cost';

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
        return __('Shipping cost data');
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
                ->rules('required')
                ->showOnPreview(),
            BelongsTo::make(__('Route to branch'), 'routeto_branch', 'App\Nova\Routeto_branch')
                ->sortable()
                ->rules('required')
                ->showOnPreview(),
            BelongsTo::make(__('Car type'), 'cartype', 'App\Nova\Cartype')
                ->sortable()
                ->rules('required')
                ->showOnPreview(),
            BelongsTo::make(__('Car style'), 'carstyle', 'App\Nova\Carstyle')
                ->sortable()
                ->nullable()
                ->hideFromIndex()
                ->showOnPreview(),

            Currency::make(__('Full truck rate'), 'fulltruckrate')
                ->sortable()
                ->nullable()
                ->hideFromIndex()
                ->showOnPreview(),
            Boolean::make('กำหนดค่าจ้างรถเป็น%', 'chargeflag')
                ->hideFromIndex()
                ->showOnPreview(),
            Number::make('%ค่าจ้างรถ', 'chargerate')
                ->sortable()
                ->onlyOnIndex()
                ->showOnPreview(),
            Currency::make('ค่าจ้างรถ', 'car_charge')
                ->sortable()
                ->onlyOnIndex()
                ->showOnPreview(),
            
            Currency::make('%ค่าจ้างรถ', 'chargerate')
                ->hide()
                ->sortable()
                ->nullable()
                ->dependsOn('chargeflag', function (Currency $field, NovaRequest $request, FormData $formData) {
                    if ($formData->chargeflag) {
                        $field->show();
                    }
                    })
                ->hideFromIndex(),
           
            Currency::make('ค่าจ้างรถ(กรณีรถร่วม)', 'car_charge')
                    ->hide()
                    ->sortable()
                    ->nullable()
                    ->dependsOn('chargeflag', function (Currency $field, NovaRequest $request, FormData $formData) {
                            if (!$formData->chargeflag) {
                                $field->show();
                            }
                            })
                    ->hideFromIndex(),
            Currency::make('ค่าเที่ยวคนขับ(กรณีรถบริษัท)', 'driver_charge')
                ->sortable()
                ->nullable()
                ->hideFromIndex(),
            Currency::make('ค่าเชื้อเพลิงที่ใช้(บาท)', 'fuel_cost')
                ->sortable()
                ->nullable()
                ->hideFromIndex(),
            Number::make('จำนวนเชื้อเพลิงที่ใช้(ลิตร)', 'fuel_amount')
                ->step('0.01')
                ->sortable()
                ->nullable()
                ->hideFromIndex(),

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
        return [
            new RouteToBranch()
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
