<?php

namespace App\Nova;

use App\Nova\Filters\CheckerByUser;
use App\Nova\Filters\OrderdateFilter;
use App\Nova\Filters\OrderFromDate;
use App\Nova\Filters\OrderToDate;
use App\Nova\Filters\ShowByOrderStatus;
use App\Nova\Lenses\CheckingByUser;
use App\Nova\Metrics\CheckerbyUserMetric;
use App\Nova\Metrics\CheckerCancelbyUser;
use App\Nova\Metrics\CheckerProblembyUser;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Wasandev\Orderstatus\Orderstatus;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Fields\FormData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Query\Search\SearchableRelation;


class Order_checker extends Resource
{
    
    public static $polling = false;
    public static $pollingInterval = 60;
    public static $showPollingToggle = true;
    public static $group = '7.งานบริการขนส่ง';
    public static $priority = 1;
    public static $globallySearchable = false;
    public static $preventFormAbandonment = true;
    public static $with = ['customer', 'to_customer', 'user'];
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order_checker::class;


    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static function searchableColumns()
    {
        return ['id', new SearchableRelation('customer', 'name'),new SearchableRelation('to_customer', 'name')];
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','customer.name','to_customer.name'
    ];

    

    public static function label()
    {

        return 'รายการตรวจรับสินค้า';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Status::make(__('Order status'), 'order_status')
                ->loadingWhen(['checking'])
                ->failedWhen(['cancel'])
                ->exceptOnForms(),

            Date::make('วันที่', 'order_header_date')
                ->readonly()
                ->default(today())
                ->exceptOnForms(),

            BelongsTo::make(__('From branch'), 'branch', 'App\Nova\Branch')
                ->exceptOnForms()
                ->hideFromIndex(),
            BelongsTo::make(__('To branch'), 'to_branch', 'App\Nova\Branch')
                ->nullable()
                ->help('***โปรดระบุสาขา ถ้าที่อยู่ลูกค้าปลายทางอยู่นอกพื้นที่บริการของสาขาปลายทาง'),
            Select::make('ประเภท', 'order_type')->options([
                'general' => 'ทั่วไป',
                'express' => 'Express',
            ])->sortable()
                ->default('general')
                ->displayUsingLabels(),
           
            BelongsTo::make('ผู้ส่งสินค้า', 'customer', 'App\Nova\Customer')
                ->searchable()
                ->withSubtitles()
                ->showCreateRelationButton()
                ->onlyOnForms(),
            BelongsTo::make('ผู้ส่งสินค้า', 'customer', 'App\Nova\Customer')
                ->searchable()                
                ->exceptOnForms(),

            // BelongsTo::make('ผู้รับสินค้า', 'to_customer', 'App\Nova\Customer')
            //     ->searchable()
            //     ->exceptOnForms(),
            BelongsTo::make('ผู้รับสินค้า','to_customer','App\Nova\Customer')
                    ->dependsOn(['to_branch'], function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                            
                            $to_branch = $formData->to_branch ;
                            
                            if ($to_branch) {
                                $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($to_branch) {
                                    $to_branch_area = \App\Models\Branch_area::where('branch_id', $to_branch)->get('district'); 
                                    $query->whereIn('district', $to_branch_area)
                                          ->where('status', true);   
                                });
                                
                            }else {
                                $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) {                                     
                                    $query->where('status', true);                                              
                                });
                            }
                        }
                    )->rules('required')
                    ->searchable()
                    ->withSubtitles()
                   // ->onlyOnForms()
                    ->showCreateRelationButton(),
            Select::make('การจัดส่ง', 'trantype')->options([
                '0' => 'รับเอง',
                '1' => 'จัดส่ง',
            ])->displayUsingLabels()
                ->sortable()
                ->default(1)
                ->hideFromIndex(),
            Text::make(__('Remark'), 'remark')->nullable()
                ->hideFromIndex(),
            BelongsTo::make(__('Checker'), 'checker', 'App\Nova\User')
                ->onlyOnDetail(),
            BelongsTo::make(__('Created by'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user_update', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Updated At'), 'updated_at')
                ->onlyOnDetail(),
            HasMany::make(__('Order detail'), 'checker_details', 'App\Nova\Checker_detail'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            (new Metrics\CheckerbyUserMetric())

                ->canSee(
                    function ($request) {
                        return $request->user()->role == 'admin';
                    }
                ),
            (new Metrics\CheckerCancelbyUser)

                ->canSee(
                    function ($request) {
                        return $request->user()->role == 'admin';
                    }
                ),
            (new Metrics\CheckerProblembyUser)

                ->canSee(
                    function ($request) {
                        return $request->user()->role == 'admin';
                    }
                ),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new ShowByOrderStatus(),
            new OrderFromDate(),
            new OrderToDate(),
            new CheckerByUser()

        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [
            new CheckingByUser()
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [

            (new Actions\OrderChecked($request->resourceId))
                ->onlyOnDetail()
                ->confirmText('ยืนยันรายการตรวจรับสินค้า?')
                ->confirmButtonText('ยืนยัน')
                ->cancelButtonText("ไม่ยืนยัน")
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('manage order_checkers');
                })
                ->canSee(function ($request) {
                    return $request instanceof ActionRequest
                        || ($this->resource->exists && $this->resource->order_status == 'checking');
                })


        ];
    }
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('order_type', '<>', 'charter');
    }

    // public static function relatableCustomers(NovaRequest $request, $query ,FormData $formData)
    // {
    //     $from_branch = $request->user()->branch_id;
    //     $to_branch =  $formData->to_branch ; 
    //      if ($request->route()->parameter('field') === "customer") {
    //         return $query->where('status', true);
    //     }
    //     if ($request->route()->parameter('field') === "to_customer") {
    //         if ($to_branch) {
    //             $to_branch_area = \App\Models\Branch_area::where('branch_id', $to_branch)->get('district');
    //              return $query->whereIn('district', $to_branch_area)
    //                  ->where('status', true);
            
    //          } else {
    //              return $query->where('status', true);
    //          }
    //     }
    // }
}
