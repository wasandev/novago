<?php

namespace App\Nova;

use App\Nova\Actions\AddOrderToInvoice;
use App\Nova\Actions\CreateInvoice;
use App\Nova\Actions\InvoiceBillReceipt;
use App\Nova\Actions\RemoveOrderFromInvoice;
use App\Nova\Filters\ArbalanceByBranch;
use App\Nova\Filters\ArbalanceFromDate;
use App\Nova\Filters\ArbalanceNotInvoice;
use App\Nova\Filters\ArbalanceNotReceipt;
use App\Nova\Filters\ArbalanceToDate;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Query\Search\SearchableRelation;

//use Suenerds\NovaSearchableBelongsToFilter\NovaSearchableBelongsToFilter;

class Ar_balance extends Resource
{
    public static $group = '9.1 งานลูกหนี้การค้า';
    public static $priority = 2;
    public static $polling = false;
    public static $pollingInterval = 90;
    public static $showPollingToggle = true;
    public static $globallySearchable = false;
    public static $preventFormAbandonment = true;
    public static $trafficCop = false;
    public static $perPageViaRelationship = 200;

    public static $with = ['ar_customer',  'user', 'order_header', 'invoice', 'receipt_ar'];
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Ar_balance::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static function searchableColumns()
    {
        return ['id','order_header_id', new SearchableRelation('ar_customer', 'name'),
                                        new SearchableRelation('order_header','order_header_no'),
                                        new SearchableRelation('invoice','invoice_no'),
                                        new SearchableRelation('receipt_ar','receipt_no'),
        ];
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','order_header_id','ar_customer.name','order_header.order_header_no','invoice.invoice_no','receipt_ar.receipt_no'
    ];
    
    public static function label()
    {
        return 'ใบรับส่งวางบิล';
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
            BelongsTo::make('สาขา', 'branch', 'App\Nova\Branch')->sortable(),
            Boolean::make('การชำระเงิน', 'status', function () {
                if (isset($this->order_header)) {
                    return $this->order_header->payment_status;
                }
            })->exceptOnForms(),
            Date::make('วันที่ตั้งหนี้', 'docdate')               
                ->sortable(),
            BelongsTo::make('เลขที่ใบรับส่ง', 'order_header', 'App\Nova\Order_header')
                ->sortable(),
            BelongsTo::make('ชื่อลูกค้า', 'ar_customer', 'App\Nova\Ar_customer')
                ->searchable()
                ->sortable()
                ->readonly()
                ->filterable(),

            Currency::make('จำนวนเงิน', 'ar_amount')
                ->sortable(),
            BelongsTo::make('ใบแจ้งหนี้', 'invoice', 'App\Nova\Invoice')
                ->sortable(),
            BelongsTo::make('ใบเสร็จรับเงิน', 'receipt_ar', 'App\Nova\Receipt_ar')
                ->sortable(),


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
            // (new NovaSearchableBelongsToFilter('ตามลูกค้า'))
            //     ->fieldAttribute('customer')
            //     ->filterBy('customer_id'),
            new ArbalanceByBranch,
            new ArbalanceNotInvoice,
            new ArbalanceNotReceipt,
            new ArbalanceFromDate,
            new ArbalanceToDate,

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

            (new CreateInvoice)
                ->showOnIndex()
                ->confirmText('ต้องการสร้างใบแจ้งหนี้จากใบรับส่งที่เลือกไว้')
                ->confirmButtonText('ใช่')
                ->cancelButtonText("ไม่ใช่")
                ->canRun(function ($request, $model) {
                    return $request->user()->role == 'admin' || $request->user()->hasPermissionTo('edit invoices');
                })
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }
                    return $this->resource instanceof Model && $this->resource->invoice_id === null;
                }),

            (new RemoveOrderFromInvoice)

                ->confirmText('ต้องการนำใบรับส่งที่เลือกไว้ออกจากใบแจ้งหนี้?')
                ->confirmButtonText('ใช่')
                ->cancelButtonText("ไม่ใช่")
                ->canRun(function ($request, $model) {
                    return $request->user()->role == 'admin' || $request->user()->hasPermissionTo('edit invoices');
                })
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }
                    return $this->resource instanceof Model && $this->resource->invoice_id <> null;
                }),
            (new AddOrderToInvoice($request->resourceId))
                ->onlyOnDetail()
                ->confirmText('ต้องการนำใบรับส่งที่เลือกไว้เข้าใบแจ้งหนี้?')
                ->confirmButtonText('ใช่')
                ->cancelButtonText("ไม่ใช่")
                ->canRun(function ($request) {
                    return $request->user()->role == 'admin' || $request->user()->hasPermissionTo('edit invoices');
                })
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }
                    return $this->resource instanceof Model && $this->resource->invoice_id === null;
                }),
            (new InvoiceBillReceipt)
                ->confirmText('ต้องการรับชำระหนี้จากใบรับส่งที่เลือก')
                ->confirmButtonText('ใช่')
                ->cancelButtonText("ไม่ใช่")
                ->canRun(function ($request) {
                    return $request->user()->role == 'admin' || $request->user()->hasPermissionTo('edit invoices');
                })
                ->canSee(function ($request) {
                    if ($request instanceof ActionRequest) {
                        return true;
                    }
                    return $this->resource instanceof Model && $this->resource->invoice_id === null;
                }),
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {

        return $query->where('doctype', '=', 'P');
    }
}
