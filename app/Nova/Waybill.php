<?php

namespace App\Nova;

use App\Nova\Filters\RouteToBranch;
use App\Nova\Filters\ShowByWaybillStatus;
use App\Nova\Filters\WaybillFromDate;
use App\Nova\Filters\WaybillToDate;
use App\Nova\Lenses\cars\CarCheck;
use App\Nova\Lenses\WaybillConfirmedPerDay;
use App\Nova\Lenses\WaybillConfirmedPerMonth;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Status;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Http\Requests\ActionRequest;
use Wasandev\Waybillstatus\Waybillstatus;

class Waybill extends Resource
{
    //use HasDependencies;
    public static $group = '7.งานบริการขนส่ง';
    public static $priority = 2;
    public static $polling = false;
    public static $pollingInterval = 90;
    public static $showPollingToggle = true;
    public static $trafficCop = false;
    public static $perPageViaRelationship = 25;

    public static $with = ['car', 'branch', 'user'];
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Waybill::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    //public static $title = 'waybill_no';

    public function title()
    {
        return $this->waybill_no . '-' . $this->car->car_regist;
    }
    public function subtitle()
    {
        return $this->car->car_regist;
    }


    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'waybill_no',
    ];

    public static $searchRelations = [
        'car' => ['car_regist'],
    ];
    public static $globalSearchRelations = [
        'car' => ['car_regist'],
    ];

    public static function label()
    {
        return 'รายการใบกำกับสินค้า';
    }
    public static function singularLabel()
    {
        return 'ใบกำกับสินค้า';
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
            ID::make(__('ID'), 'id')->sortable(),
            Status::make(__('Status'), 'waybill_status')
                ->loadingWhen(['loading'])
                ->failedWhen(['cancel'])
                ->exceptOnForms()
                ->sortable(),
            BelongsTo::make(__('Car regist'), 'car', 'App\Nova\Car')
                ->searchable()
                ->withSubtitles()
                ->sortable(),
            Text::make(__('Waybill no'), 'waybill_no')
                ->readonly()
                ->sortable(),
            Date::make(__('Waybill date'), 'waybill_date')
                ->readonly()
                ->default(today())                
                ->sortable(),
            BelongsTo::make('ไปสาขา', 'to_branch', 'App\Nova\Branch')->onlyOnIndex(),

            BelongsTo::make(__('Route to branch'), 'routeto_branch', 'App\Nova\Routeto_branch')
                ->nullable()
                ->showCreateRelationButton()
                ->hideFromIndex(),


            Text::make('ยอดค่าขนส่งที่กำหนด', 'fulltruckrate', function () {
                if ($this->waybill_type == 'general' || $this->waybill_type == 'express') {
                    $hasitem = count($this->routeto_branch->routeto_branch_costs);
                    if ($hasitem) {
                        $routeto_branch_cost = \App\Models\Routeto_branch_cost::where('routeto_branch_id', '=', $this->routeto_branch_id)
                            ->where('cartype_id', '=', $this->car->cartype_id)
                            ->first();
                        if (isset($routeto_branch_cost)) {
                            $fulltruckrate = $routeto_branch_cost->fulltruckrate;
                            return  number_format($fulltruckrate, 2, '.', ',');
                        }
                    }
                    return 0;
                }
                return 0;
            })->exceptOnForms()
                ->hideFromIndex(),

            Number::make('ค่าขนส่งรวม', 'total_amount', function () {
                return number_format($this->order_loaders->sum('order_amount'), 2, '.', ',');
            })->exceptOnForms(),
            Currency::make('ค่าบรรทุก', 'waybill_payable')
                ->hideWhenCreating()
                ->showOnUpdating(),
            Number::make('ยอดเก็บปลายทาง', 'branchpay', function () {
                return number_format(
                    $this->order_loaders->where('paymenttype', '=', 'E')->sum('order_amount'),
                    2,
                    '.',
                    ','
                );
            })->exceptOnForms(),
            Currency::make('รายได้บริษัท', 'waybill_income')
                ->onlyOnDetail(),
            Number::make('%รายได้', 'income', function () {
                if ($this->waybill_amount > 0) {
                    return number_format((($this->waybill_amount - $this->waybill_payable) / $this->waybill_amount) * 100, 2, '.', '');
                }
                return 0;
            })->exceptOnForms()
                ->hideFromIndex(),
            DateTime::make(__('วันที่รถออก'), 'departure_at'),
            Select::make(__('Waybill type'), 'waybill_type')->options([
                'general' => 'ทั่วไป',
                'express' => 'Express',
            ])->displayUsingLabels()
                ->default('general'),
            Number::make('น้ำหนักสินค้ารวม', 'waybill_totalweight', function () {
                $waybill_weight = $this->order_loaders->sum('total_weight');
                return number_format($waybill_weight, 2, '.', ',');
            })->exceptOnForms()
                ->hideFromIndex(),
            BelongsTo::make(__('Driver'), 'driver', 'App\Nova\Employee')
                ->searchable()
                ->hideFromIndex(),
            BelongsTo::make(__('Loader'), 'loader', 'App\Nova\User')
                ->hideFromIndex()
                ->searchable(),

            DateTime::make(__('กำหนดถึงสาขาปลายทาง'), 'arrival_at')
                ->onlyOnDetail(),
            DateTime::make(__('วันเวลากำหนดถึงสาขาปลายทางจริง'), 'arrivaled_at')
                ->onlyOnDetail(),
            BelongsTo::make(__('Created by'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user_update', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Updated At'), 'updated_at')
                ->onlyOnDetail(),
            Currency::make('ต้นทุนค่าจัดลงสินค้าของสาขา', 'branch_car_income')
                ->onlyOnDetail(),
            HasMany::make(__('Order header'), 'order_loaders', 'App\Nova\Order_loader'),
            HasMany::make(__('Waybill status'), 'waybill_statuses', 'App\Nova\Waybill_status'),
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
            (new Waybillstatus())->width('full'),
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
            (new RouteToBranch()),
            (new WaybillFromDate()),
            (new WaybillToDate()),
            (new ShowByWaybillStatus())

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
            new  WaybillConfirmedPerDay(),
            new  WaybillConfirmedPerMonth(),
            // new  CarCheck()

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
            (new Actions\AddorderWaybillQrcode($request->resourceId))
                ->onlyOnDetail()
                ->confirmText('ต้องการนำใบรับส่งเข้าใบกำกับสินค้านี้?')
                ->confirmButtonText('ยืนยัน')
                ->cancelButtonText("ไม่ยืนยัน")
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('manage waybills');
                })
                ->canSee(function ($request) {
                    return $request instanceof ActionRequest
                        || ($this->resource->exists && ($this->resource->waybill_status == 'loading') && $request->user()->hasPermissionTo('manage waybills'));
                }),
            (new Actions\WaybillConfirmed($request->resourceId))

                ->onlyOnDetail()
                ->confirmText('ต้องการยืนยันใบกำกับสินค้ารายการนี้?')
                ->confirmButtonText('ยืนยัน')
                ->cancelButtonText("ไม่ยืนยัน")
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('manage waybills');
                })
                ->canSee(function ($request) {
                    return $request instanceof ActionRequest
                        || ($this->resource->exists && $this->resource->waybill_status == 'loading'
                            && $request->user()->hasPermissionTo('manage waybills'));
                }),
            (new Actions\WaybillTransporting())
                ->confirmText('ต้องการกำหนดให้รถออกจากสาขาต้นทาง')
                ->confirmButtonText('ยืนยัน')
                ->cancelButtonText("ไม่ยืนยัน")
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('manage waybills');
                })
                ->canSee(function ($request) {
                    return $request instanceof ActionRequest
                        || ($this->resource->exists && $this->resource->waybill_status == 'confirmed');
                }),
            (new Actions\PrintWaybill)->onlyOnDetail()
                ->confirmText('ต้องการพิมพ์ใบกำกับสินค้ารายการนี้?')
                ->confirmButtonText('พิมพ์')
                ->cancelButtonText("ไม่พิมพ์")
                ->canRun(function ($request, $model) {
                    return true;
                }),

            (new Actions\WaybillBillRemove($request->resourceId))

                ->onlyOnDetail()
                ->confirmText('ต้องการนำใบรับส่งออกจากใบกำกับสินค้านี้?')
                ->confirmButtonText('ยืนยัน')
                ->cancelButtonText("ไม่ยืนยัน")
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('manage waybills');
                })
                ->canSee(function ($request) {
                    return $request instanceof ActionRequest
                        || ($this->resource->exists && $this->resource->waybill_type <> 'charter'  && $request->user()->hasPermissionTo('manage waybills'));
                }),
            (new Actions\WaybillBillAdd($request->resourceId))

                ->onlyOnDetail()
                ->confirmText('ต้องการนำใบรับส่งเข้าใบกำกับสินค้านี้?')
                ->confirmButtonText('ยืนยัน')
                ->cancelButtonText("ไม่ยืนยัน")
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('manage waybills');
                })
                ->canSee(function ($request) {
                    return $request instanceof ActionRequest
                        || ($this->resource->exists && $this->resource->waybill_type <> 'charter'  && $request->user()->hasPermissionTo('manage waybills'));
                }),
            // && ($this->resource->waybill_status != 'completed')
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if ($request->user()->branch->code <> '001') {
            $routeto_branch = \App\Models\Routeto_branch::where('branch_id', $request->user()->branch_id)->get('id');
            if (isset($routeto_branch)) {
                return $query->whereIn('routeto_branch_id', $routeto_branch)
                    ->where('waybill_type', '<>', 'charter');
            }
        }
        return $query->where('waybill_type', '<>', 'charter');
    }



    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/resources/' . static::uriKey();
    }

    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/resources/' . static::uriKey();
    }
    public function addOrder_header(User $user, Order_header $order_header)
    {

        return false;
    }
}
