<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Query\Search\SearchableRelation;
use Laravel\Nova\Actions\ExportAsCsv;
use Laravel\Nova\Fields\FormData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;



class Branch_area extends Resource
{
    public static $displayInNavigation = false;
    public static $group = '5.งานจัดการการขนส่ง';
    public static $priority = 1;
    public static $globallySearchable = false;
    public static $preventFormAbandonment = true;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Branch_area';
    public static $with = ['branch'];
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'district';
    public static function availableForNavigation(Request $request)
    {
        return $request->user()->hasPermissionTo('edit brancheareas');
    }

    /**
 * Get the searchable columns for the resource.
 *
 * @return array
 */
    public static function searchableColumns()
    {
        return ['id', new SearchableRelation('branch', 'name')];
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'branch_id',  'district', 'province','branch.name'
    ];
    public static function label()
    {
        return 'ข้อมูลพื้นที่บริการสาขา';
    }
    public static function singulatLabel()
    {
        return 'พื้นที่บริการสาขา';
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
            BelongsTo::make(__('Branch'), 'branch', 'App\Nova\Branch')->sortable(),
            BelongsTo::make(__('Province'), 'province_name', 'App\Nova\Province')
                    ->searchable()
                    ->rules('required'),
                   
            BelongsTo::make(__('District'),'district_name','App\Nova\District')
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
                     ->withSubtitles(),
           
            Number::make(__('Delivery days'), 'deliverydays')
                ->step('0.01'),
          
            BelongsTo::make(__('Created by'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user_update', 'App\Nova\User')
                ->onlyOnDetail(),
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
            new Filters\Branch,
            new Filters\Province,
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
        return [
            new Lenses\MostValueBranchDistrict()
        ];
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
            ExportAsCsv::make()->nameable()
                ->canSee(function ($request) {
                    return $request->user()->role == 'admin';
                }),
            (new Actions\SetDeliverydays)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit branchareas');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit branchareas');
                }),
            
        ];
    }
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
          return '/resources/' . $request->input('viaResource') . '/' . $request->input('viaResourceId');
    }

    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
         return '/resources/' . $request->input('viaResource') . '/' . $request->input('viaResourceId');
    }
}
