<?php

namespace App\Nova;

use App\Nova\Actions\PrintOrder;
use App\Nova\Filters\BillingUser;
use App\Nova\Filters\ByPaymentType;
use App\Nova\Filters\CheckerUser;
use App\Nova\Filters\OrderdateFilter;
use App\Nova\Filters\OrderFromBranch;
use App\Nova\Filters\OrderFromDate;
use App\Nova\Filters\OrderToBranch;
use App\Nova\Filters\OrderToDate;
use App\Nova\Filters\PaymentStatus;
use App\Nova\Filters\PaymentType;
use App\Nova\Filters\ShowOwnOrder;
use App\Nova\Filters\ShowByOrderStatus;
use Illuminate\Http\Request;
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
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Metrics\OrderIncomes;
use App\Nova\Metrics\OrdersByPaymentType;
use App\Nova\Metrics\OrdersPerDay;
use App\Nova\Metrics\OrdersByBranchRec;
use App\Nova\Metrics\OrdersPerMonth;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Actions\ExportAsCsv;
use Wasandev\Trackingstatus\Trackingstatus;
use Laravel\Nova\Fields\FormData;
use Illuminate\Database\Eloquent\Builder;
use Jenssegers\Agent\Agent;


class Order_header extends Resource
{
    public static $polling = false;
    public static $pollingInterval = 120;
    public static $showPollingToggle = true;
    public static $group = '7.งานบริการขนส่ง';
    public static $priority = 2;
    public static $trafficCop = false;
    public static $preventFormAbandonment = true;
    public static $perPageOptions = [50, 100, 150];

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order_header::class;
    public static $with = ['customer', 'to_customer', 'user'];

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'order_header_no';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'order_header_no', 'tracking_no', 'id'
    ];

    public static $searchRelations = [
        'customer' => ['name'],
        'to_customer' => ['name']
    ];
    public static $globalSearchRelations = [
        'customer' => ['name'],
        'to_customer' => ['name']
    ];

    public static function label()
    {

        return "รายการใบรับส่งสินค้า";
    }
    public static function singularLabel()
    {
        return 'ใบรับส่งสินค้า';
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
            Number::make('ระยะเวลาจัดส่ง', function () {
                    $orderstatus = \App\Models\Order_status::where('order_header_id','=',$this->id)->get();
                    $i = 0;
                    $len = count($orderstatus);
                    $trandays = 0;
                    $fromdate = $this->order_header_date ;
                    $todate = now();
                    $completed_status = \App\Models\Order_status::where('order_header_id','=',$this->id)
                                                        ->where('status','=','completed')
                                                        ->first();
                    if ($this->order_status == 'completed') {
                        $todate = $completed_status->created_at;
                        $trandays = $fromdate->diffInDays($todate) + 1;

                    }else{
                       
                        foreach ($orderstatus as $status) {
                            if($i = $len- 1 ) {                                    
                                $fromdate = $status->created_at;
                                $todate = now();
                                      
                            } 
                            $i++;
                        }
                       $trandays = $fromdate->diffInDays($todate) +1; 
                    }
                    return $trandays;
            })->exceptOnForms(),
            ID::make('ID', 'id')
                ->sortable()
                ->showOnPreview(),
            Boolean::make(__('Payment status'), 'payment_status')
                ->exceptOnForms()
                ->showOnPreview(),
            Text::make(__('Payment type'), 'paymenttype')
                ->onlyOnIndex()
                ->showOnPreview(),
            Status::make(__('Order status'), 'order_status')
                ->loadingWhen(['new'])
                ->failedWhen(['cancel', 'problem'])
                ->hideWhenCreating()
                ->showOnUpdating()
                ->sortable()
                ->showOnPreview(),
            BelongsTo::make(__('From branch'), 'branch', 'App\Nova\Branch')
                ->onlyOnDetail()
                ->withMeta([
                    'belongsToId' => $this->branch_id ?? $request->user()->branch_id
                ]),


            Select::make('สถานะสินค้า', 'shipto_center')->options([
                '0' => 'อยู่จุดรับสินค้า',
                '1' => 'ออกจากจุดรับสินค้าแล้ว',
                '2' => 'ถึงสำนักงานใหญ่'
            ])->displayUsingLabels()
                ->canSee(function ($request) {
                    $branch = \App\Models\Branch::find($request->user()->branch_id);
                    return $branch->dropship_flag;
                })
                ->exceptOnForms(),
            Select::make('ประเภท', 'order_type')->options([
                'general' => 'ทั่วไป',
                'express' => 'Express',
            ])->sortable()
                ->default('general')
                ->displayUsingLabels()
                ->hideFromIndex(),


            Date::make(__('Order date'), 'order_header_date')
                ->readonly()
                ->default(today())                
                ->exceptOnForms()
                ->hideFromIndex()
                ->sortable(),
            DateTime::make('วันที่-เวลาส่ง', 'order_time', function () {
                return $this->created_at;
            })->onlyonIndex()
            ->showOnPreview(),
            Text::make(__('Order header no'), 'order_header_no')
                ->exceptOnForms()
                ->sortable()
                ->showOnPreview(),
            BelongsTo::make(__('To branch'), 'to_branch', 'App\Nova\Branch')
                ->nullable()
                ->help('***โปรดระบุสาขา ถ้าที่อยู่ลูกค้าปลายทางอยู่นอกพื้นที่บริการของสาขาปลายทาง')
                ->showOnPreview(),
            Text::make('โทรศัพท์สาขา', function () {
                return $this->to_branch->phoneno;
            })->onlyOnDetail(),


            Text::make(__('Tracking no'), 'tracking_no')
                ->onlyOnDetail(),

            Select::make(__('Payment type'), 'paymenttype')->options([
                'H' => 'เงินสดต้นทาง',
                'T' => 'เงินโอนต้นทาง',
                'E' => 'เงินสดปลายทาง',
                'F' => 'วางบิลต้นทาง',
                'L' => 'วางบิลปลายทาง'
            ])->displayUsingLabels()
                ->onlyOnDetail(),

            // BelongsTo::make('ผู้ส่งสินค้า', 'customer', 'App\Nova\Customer')
            //         ->searchable()
            //         ->withSubtitles()
            //         ->showCreateRelationButton()->onlyOnForms(),

            BelongsTo::make('ผู้ส่งสินค้า', 'customer', 'App\Nova\Customer')
                ->searchable()
                ->withSubtitles()
                ->hideFromIndex()
                ->showOnPreview()
                ->showCreateRelationButton(),

            Text::make('ที่อยู่', function () {
                return $this->customer->address . ' ' . $this->customer->sub_district . ' ' . $this->customer->district
                    . ' ' . $this->customer->province . ' ' . $this->customer->phoneno;
            })->onlyOnDetail()
            ->showOnPreview(),

            // BelongsTo::make('ผู้รับสินค้า', 'to_customer', 'App\Nova\Customer')
            //     ->searchable()
            //     ->withSubtitles()
            //     ->showCreateRelationButton()
            //     ->sortable()
            //     ->hideFromIndex()
            //     ->showOnPreview(),
            BelongsTo::make('ผู้รับสินค้า', 'to_customer', 'App\Nova\Customer')
                    ->dependsOn(['to_branch'], function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                            
                            $to_branch = $formData->to_branch ;
                            
                            if ($to_branch) { 
                                $to_branch_area = \App\Models\Branch_area::where('branch_id', $to_branch)->get('district');
                
                                $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($to_branch_area) {
                                    $query->whereIn('district', $to_branch_area)->where('status', true);
                                });
                                
                            }else {
                                $field->relatableQueryUsing(function (NovaRequest $request, Builder $query)  { 
                                    $query->where('status', true);
                                });
                            }
                        }
                    )->rules('required')
                     ->withSubtitles()
                     ->searchable()
                    ->withSubtitles()
                    ->showCreateRelationButton()
                    ->sortable()
                    ->hideFromIndex()
                    ->showOnPreview(),
            Currency::make('จำนวนเงิน', 'order_amount')
                ->exceptOnForms(),
            
            Text::make('ที่อยู่', function () {
                return $this->to_customer->address . ' ' . $this->to_customer->sub_district . ' ' . $this->to_customer->district
                    . ' ' . $this->to_customer->province . ' ' . $this->to_customer->phoneno;
            })->onlyOnDetail()
            ->showOnPreview(),
            BelongsTo::make('ใบกำกับสินค้า', 'waybill', 'App\Nova\Waybill')
                ->nullable()
                ->searchable()
                ->withSubtitles()
                ->exceptOnForms()
                ->hideFromIndex()
                ->showOnPreview(),
            
            Select::make(__('Tran type'), 'trantype')->options([
                '0' => 'รับเอง',
                '1' => 'จัดส่ง',
            ])->displayUsingLabels()
                ->sortable()
                ->hideFromIndex()
                ->default(1),
            BelongsTo::make('เปิดแทนบิลยกเลิกเลขที่', 'ordercancel', 'App\Nova\Order_header')
                ->nullable()
                ->onlyOnDetail(),

            Text::make(__('Remark'), 'remark')->nullable()
                ->hideFromIndex(),
           
           
            BelongsTo::make(__('Checker'), 'checker', 'App\Nova\User')
                ->default(function ($request) {
                    $agent = new Agent;
                    if($agent->isMobile() || $agent->isTablet() ) {
                        return $request->user()->id;
                    }
                    
                })                      
                ->hideFromIndex()
                ->searchable()
                ->withSubtitles(),
            
            BelongsTo::make(__('Loader'), 'loader', 'App\Nova\User')
                ->nullable()
                ->onlyOnDetail(),
            BelongsTo::make(__('Shipper'), 'shipper', 'App\Nova\User')
                ->onlyOnDetail(),
            BelongsTo::make('พนักงานออกใบรับส่ง', 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user_update', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Updated At'), 'updated_at')
                ->onlyOnDetail(),
            Text::make('ชื่อผู้รับสินค้า', 'order_recname')
                ->onlyOnDetail()
                ->nullable(),
            Text::make('เลขบัตรประชาชน', 'idcardno')
                ->onlyOnDetail()
                ->nullable(),


            HasMany::make(__('Order detail'), 'order_details', 'App\Nova\Order_detail'),

            BelongsToMany::make('ค่าบริการอื่นๆ', 'service_charges', 'App\Nova\Service_charge')
                ->fields(function () {
                    return [
                        Text::make('รายละเอียดเพิ่มเติม', 'description'),
                        Currency::make('จำนวนเงิน', 'service_amount'),
                    ];
                })->canSee(function ($request) {
                    return $this->resource->order_status == 'confirmed';
                }),
            HasMany::make(__('Order status'), 'order_statuses', 'App\Nova\Order_status'),
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
            (new Trackingstatus())->width('full')
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
            new PaymentStatus(),
            new ByPaymentType(),
            new ShowByOrderStatus(),
            new OrderFromDate(),
            new OrderToDate(),
            new OrderFromBranch(),
            new OrderToBranch(),
            new ShowOwnOrder(),
            new BillingUser(),
            new CheckerUser(),

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
            new Lenses\accounts\OrderBillingCash(),
            new lenses\accounts\OrderBillingByUser(),
            new lenses\accounts\OrderReportBillByDay(),
            new lenses\accounts\OrderReportByDay(),
            new lenses\accounts\OrderReportByBranchrec(),
            new lenses\accounts\OrderReportCancelByDay(),
            new Lenses\accounts\OrderReportCashByDay(),
            new Lenses\accounts\OrderReportCrByDay(),
            new lenses\ValueByOrderConfirmed(),
            new lenses\ValueByOrderBranchWarehouse(),
            new lenses\ValueByOrderBranchCompletedNotPay(),
            new lenses\ValueByDistrictAll(),
            new lenses\BranchTranDays(),
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

            (new Actions\OrderConfirmed($request->resourceId))
                ->onlyOnDetail()
                ->confirmText('ต้องการยืนยันใบรับส่งรายการนี้?')
                ->confirmButtonText('ยืนยัน')
                ->cancelButtonText("ไม่ยืนยัน")
                ->canRun(function ($request, $model) {
                    return $request->user()->hasPermissionTo('manage order_headers');
                })
                ->canSee(function ($request) {
                    return $request instanceof ActionRequest
                        || ($request->user()->hasPermissionTo('manage order_headers') && ($this->resource->exists && $this->resource->order_status == 'new'));
                }),
            (new Actions\SetOrderToBranch($request->resourceId))
                ->onlyOnDetail()
                ->confirmText('ต้องการเปลี่ยนสาขาปลายทางของใบรับส่งนี้รายการนี้?')
                ->confirmButtonText('เปลี่ยน')
                ->cancelButtonText("ไม่เปลี่ยน")
                ->canRun(function ($request, $model) {
                    return $request->user()->hasPermissionTo('manage order_headers');
                })
                ->canSee(function ($request) {
                    return $request instanceof ActionRequest
                        || ($request->user()->hasPermissionTo('manage order_headers') && ($this->resource->exists && $this->resource->order_status == 'confirmed'));
                }),
            (new Actions\PrintOrder)
                ->showOnTableRow()
                ->confirmText('ต้องการพิมพ์ใบรับส่งรายการนี้?')
                ->confirmButtonText('พิมพ์')
                ->cancelButtonText("ไม่พิมพ์")
                ->canRun(function ($request, $model) {
                    return $request->user()->hasPermissionTo('view order_headers');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('view order_headers');
                }),
            (new Actions\PrintPdfOrder)
                ->onlyOnDetail()
                ->confirmText('ต้องการบันทึกใบรับส่งรายการนี้เป็นไฟล์ PDF?')
                ->confirmButtonText('บันทึก')
                ->cancelButtonText("ไม่บันทึก")
                ->canRun(function ($request, $model) {
                    return $request->user()->hasPermissionTo('manage order_headers');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('manage order_headers');
                }),
            (new Actions\ShiptoCenter())
                ->confirmText('ต้องการสร้างรายการจัดส่งสินค้าไปสำนักงานใหญ่ จากรายการที่เลือก?')
                ->confirmButtonText('สร้าง')
                ->cancelButtonText("ยกเลิก")
                ->canRun(function ($request, $model) {
                    return $request->user()->hasPermissionTo('manage order_headers');
                })
                ->canSee(function ($request) {
                    $branch = \App\Models\Branch::find($request->user()->branch_id);
                    return $branch->dropship_flag;
                }),
            (new Actions\CancelOrder())
                ->onlyOnDetail()
                ->confirmText('ต้องการยกเลิกใบรับส่งรายการนี้?')
                ->confirmButtonText('ยกเลิก')
                ->cancelButtonText("ไม่ยกเลิก")
                ->canRun(function ($request, $model) {
                    return $request->user()->hasPermissionTo('manage order_headers');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('manage order_headers');
                }),
            (new Actions\OrderProblem())
                ->onlyOnDetail()
                ->confirmText('แจ้งปัญหาใบรับส่งรายการนี้?')
                ->confirmButtonText('ตกลง')
                ->cancelButtonText('ยกเลิก')
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('view order_headers');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('view order_headers');
                }),

           ExportAsCsv::make()->nameable(),
            
        ];
    }
    public static function indexQuery(NovaRequest $request, $query)
    {

        $branch = \App\Models\Branch::find($request->user()->branch_id);
        if ($branch->code == '001') {
            return $query->where('order_status', '<>', 'checking')
                ->where('shipto_center', '=', '2')
                ->where('order_type', '<>', 'charter');
        } else {
            return $query->where('order_status', '<>', 'checking')
                ->where('branch_id', '=', $request->user()->branch_id)
                ->where('order_type', '<>', 'charter');
        }
    }

    public static function relatableCustomers(NovaRequest $request, $query)
    {
        
        $from_branch = $request->user()->branch_id;
        $to_branch =  $request->user()->branch_rec_id;
      //   $to_branch = $request->branch_rec_id ? $request->resource : \App\Models\Branch::find($request->viaResourceId);
    
  
        
        if ($request->route()->parameter('field') === "customer") {
           // if (is_null($from_branch)) {
            return $query->where('status', true);
            //  } else {
            //      $from_branch_area = \App\Models\Branch_area::where('branch_id', $from_branch)->get('district');
            //      return $query->whereIn('district', $from_branch_area)
            //          ->where('status', true);
            //  }
            
        }
        if ($request->route()->parameter('field') === "to_customer") {
            if (is_null($to_branch)) {
            return $query->where('status', true);
             } else {
                 $to_branch_area = \App\Models\Branch_area::where('branch_id', $to_branch)->get('district');
                 return $query->whereIn('district', $to_branch_area)
                     ->where('status', true);
             }
        }
    }

    public static function relatableUsers(NovaRequest $request, $query)
    {
        //if ($request->route()->parameter('field') === "checker_id") {
        return $query->where('branch_id', '=', $request->user()->branch_id);
        //}
    }

    public static function relatableOrdercancels(NovaRequest $request, $query)
    {
        return $query->where('order_status', '=', 'cancel')
            ->whereYear('order_header_date', date('Y'))
            ->whereMonth('order_header_date', date('m'));
    }
}
