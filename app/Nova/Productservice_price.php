<?php

namespace App\Nova;


use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Wasandev\InputThaiAddress\InputDistrict;
use Wasandev\InputThaiAddress\InputProvince;
use Laravel\Nova\Fields\FormData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\ExportAsCsv;
use Laravel\Nova\Query\Search\SearchableRelation;

//use Suenerds\NovaSearchableBelongsToFilter\NovaSearchableBelongsToFilter;

class Productservice_price extends Resource
{
    //public static $displayInNavigation = false;
    public static $group = "4.งานด้านการตลาด";
    public static $priority = 8;
    public static $perPageOptions = [50, 100, 150];
    public static $perPageViaRelationship = 50;



    public static $with = ['product', 'unit', 'branch_area'];
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Productservice_newprice';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    //public static $title = 'id';

    public function title()
    {
        if (isset($this->product) && isset($this->unit)) {
            return $this->product->name . "-" . number_format($this->price, 2, '.', ',') . '/' . $this->unit->name;
        } else {
            return $this->id;
        }
    }

    public function subtitle()
    {

        return  $this->district . ' ' . $this->province;
    }

    /**
     * Get the searchable columns for the resource.
     *
     * @return array
     */
    public static function searchableColumns()
    {
        return ['id','district', 'province', new SearchableRelation('product', 'name')];
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'district', 'province','product.name'
    ];
    

    public static function label()
    {
        return __('Shipping costs');
    }
    public static function singularLabel()
    {
        return __('Shipping cost');
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
            //ID::make()->sortable(),
            // BelongsTo::make('ตารางราคา', 'tableprice', 'App\Nova\Tableprice')
            //     ->sortable()
            //     ->searchable(),
            Boolean::make('สถานะการปรับ', function () {
                return ($this->updated_at->month >= 2 && $this->updated_at->year = '2022');
            })->exceptOnForms(),
            DateTime::make(__('Updated At'), 'updated_at')                
                ->exceptOnForms()
                ->sortable(),
            BelongsTo::make(__('Product'), 'product', 'App\Nova\Product')
                ->sortable()
                ->searchable()
                ->filterable(),
            BelongsTo::make(__('From branch'), 'from_branch', 'App\Nova\Branch')
                ->sortable()
                ->hideFromIndex(),
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
                    )->rules('required')
                     ->withSubtitles(),
         

            BelongsTo::make(__('Unit'), 'unit', 'App\Nova\Unit')
                ->sortable()
                ->filterable(),
            Currency::make(__('Shipping cost'), 'price')
                ->sortable()
                ->rules('required'),
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
            
            //(new Filters\ToDistrict),
            (new Filters\Province),
           
            // (new Filters\ProductPriceStyle),
            // (new Filters\ProductGroup),
            // (new Filters\Unit),

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
        return [
            (new Actions\UpdateProductServicePrice)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit productservice_prices');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit productservice_prices');
                }),
            (new Actions\UpdateProductServiceUnit)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit productservice_prices');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit productservice_prices');
                }),
            ExportAsCsv::make()->nameable()->withFormat(function ($model) {
                return [
                    'ID' => $model->getKey(),
                    'Name' => $model->name,
                    
                ];
            }),

        ];
    }
    public static function relatableQuery(NovaRequest $request, $query)
    {
        if (isset($request->viaResourceId) && ($request->viaRelationship === 'order_details' || $request->viaRelationship === 'checker_details')) {

            $resourceId = $request->viaResourceId;
            // $tableprice = \App\Models\Tableprice::where('status', true)->first();

            $order = \App\Models\Order_checker::find($resourceId);
            if ($order->branch->code === '001' || $order->branch->dropship_flag) {
                $district = $order->to_customer->district;
            } else {
                $district = $order->customer->district;
            }
            return $query->where('district', '=', $district)
                ->where('price', '>', 0);
        }
    }
}
