<?php

namespace App\Nova;

use App\Nova\Metrics\ProductByCategory;
use App\Nova\Metrics\ProductByStyle;
use App\Nova\Metrics\ProductByUnit;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Actions\ExportAsCsv;
use OptimistDigital\MultiselectField\Multiselect;

class Product extends Resource
{
    //public static $displayInNavigation = false;
    public static $group = "4.งานด้านการตลาด";
    public static $priority = 7;
    public static $perPageViaRelationship = 50;
    public static $relatableSearchResults = 100;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Product';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    public static function availableForNavigation(Request $request)
    {
        return $request->user()->hasPermissionTo('edit products');
    }

    public function subtitle()
    {
        if (isset($this->weight)) {
            return 'น้ำหนัก/หน่วย(กก.) ' . $this->weight;
        } else {
            return null;
        }
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name'
    ];
    public static function label()
    {
        return __('Products');
    }
    public static function singularLabel()
    {
        return __('Product');
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
                ->hideFromIndex()
                ->default(true),
            Boolean::make('มีตารางราคา', 'price', function () {
                $hasitem = count($this->productservice_price);
                if ($hasitem) {
                    return true;
                } else {
                    return false;
                }
            })->exceptOnForms(),
            Number::make('จำนวนตารางราคา', function () {
                return count($this->productservice_price);
            })->sortable(),

            BelongsTo::make(__('Category'), 'category', 'App\Nova\Category')
                ->sortable()
                ->nullable()
                ->showCreateRelationButton(),
            BelongsTo::make(__('Product style'), 'product_style', 'App\Nova\Product_style')
                ->sortable()
                ->nullable()
                ->showCreateRelationButton(),
            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required')
                ->creationRules('unique:products,name'),

            Text::make('ขนาด(ก+ย+ส)', 'size', function () {
                return $this->width + $this->length + $this->weight;
            })->onlyOnDetail(),
            Number::make(__('Width'), 'width')
                ->step('0.01')
                ->hideFromIndex(),
            Number::make(__('Length'), 'length')
                ->step('0.01')
                ->hideFromIndex(),
            Number::make(__('Height'), 'height')
                ->step('0.01')
                ->hideFromIndex(),
            Number::make(__('Weight'), 'weight')
                ->step('0.01')
                ->hideFromIndex(),
            BelongsTo::make(__('Unit'), 'unit', 'App\Nova\Unit')
                ->nullable()
                ->showCreateRelationButton()
                ->sortable(),
            BelongsTo::make(__('Created by'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user_update', 'App\Nova\User')
                ->OnlyOnDetail(),
            DateTime::make(__('Updated At'), 'updated_at')
                ->onlyOnDetail(),
            HasMany::make('ค่าขนส่งสินค้า', 'productservice_price', 'App\Nova\Productservice_price'),
            // BelongsToMany::make('ลูกค้าที่ใช้สินค้านี้', 'customer', 'App\Nova\Customer'),
            // HasMany::make('ค่าขนส่งสินค้าตามลูกค้า', 'customer_product_prices', 'App\Nova\Customer_product_price')
            //HasMany::make('รูปสินค้า', 'product_images', 'App\Nova\Product_image')
            //HasMany::make('ราคาใหม่', 'productservice_newprice', 'App\Nova\Productservice_newprice'),

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
        return [
            (new ProductByCategory()),
            (new ProductByStyle()),
            (new ProductByUnit()),
        ];
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
            new Filters\ProductNotinPrice,
            new Filters\ProductNotCoverPrice,
            new Filters\Category,
            new Filters\ProductStyle,
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
            (new Actions\AddProductServicePriceZone)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit productservice_prices');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit productservice_prices');
                }),
            (new Actions\AddProductServicePrice)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit productservice_prices');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit productservice_prices');
                }),
            (new Actions\AddProductServicePriceDistrict)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit productservice_prices');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit productservice_prices');
                }),
            // (new Actions\AddProductServiceNewPriceZone)
            //     ->canRun(function ($request) {
            //         return $request->user()->hasPermissionTo('edit productservice_prices');
            //     })
            //     ->canSee(function ($request) {
            //         return $request->user()->hasPermissionTo('edit productservice_prices');
            //     }),
            // (new Actions\AddProductServiceNewPrice)
            //     ->canRun(function ($request) {
            //         return $request->user()->hasPermissionTo('edit productservice_prices');
            //     })
            //     ->canSee(function ($request) {
            //         return $request->user()->hasPermissionTo('edit productservice_prices');
            //     }),
            // (new Actions\AddProductServiceNewPriceDistrict)
            //     ->canRun(function ($request) {
            //         return $request->user()->hasPermissionTo('edit productservice_prices');
            //     })
            //     ->canSee(function ($request) {
            //         return $request->user()->hasPermissionTo('edit productservice_prices');
            //     }),
            (new Actions\SetProductCategory)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit products');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit products');
                }),
            (new Actions\SetProductStyle)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit products');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit products');
                }),
            (new Actions\SetProductUnit)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit products');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit products');
                }),
            ExportAsCsv::make()->nameable()->withFormat(function ($model) {
                return [
                    'ID' => $model->getKey(),
                    'Name' => $model->name
                    
                ];
            }),
           

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
