<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Query\Search\SearchableRelation;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\FormData;
use Illuminate\Database\Eloquent\Builder;

class PostalCode extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PostalCode>
     */
    public static $model = \App\Models\PostalCode::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'code';

    public static function availableForNavigation(Request $request)
     {
        return $request->user()->hasPermissionTo('edit postal-codes');
     }
    public static function searchableColumns()
    {
        return [
            'code',
            new SearchableRelation('province', 'name'),
            new SearchableRelation('district', 'name'),
            new SearchableRelation('sub_district', 'name')
        ];
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'code',
        'province.name',
        'district.name',
        'sub_district.name'

    ];

    public static function label()
    {
        return 'รหัสไปรษณีย์';
    }
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make(__('Province'), 'province', 'App\Nova\Province')
                    ->searchable()
                    ->rules('required'),
                   
            BelongsTo::make(__('District'),'district','App\Nova\District')
                    ->dependsOn(['province'], function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                            
                            $province = $formData->province ;
                            
                            if ($province) {
                                $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($province) {
                                                   
                                    $query->where('province_id',$province );
                                });
                                
                            }
                        }
                    )->rules('required')
                     ->withSubtitles(),
                
        BelongsTo::make(__('Sub District'), 'sub_district', 'App\Nova\SubDistrict')
            ->dependsOn(['district'], function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                        
                        $district = $formData->district ;
                        
                        if ($district) {
                            $field->relatableQueryUsing(function (NovaRequest $request, Builder $query ) use ($district) {         
                                $query->where('district_id',$district );                                        
                            });
                    
                            
                        }

                    }
                )
            
            ->rules('required'),
            Text::make('รหัสไปรษณีย์', 'code')->sortable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
