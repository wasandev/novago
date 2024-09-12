<?php

namespace App\Nova;

use App\Nova\Filters\CarbalanceByCar;
use App\Nova\Filters\CarbalanceByOwner;
use App\Nova\Filters\CarbalanceFromDate;
use App\Nova\Filters\CarbalanceToDate;
use App\Nova\Lenses\cars\CarcardReport;
use App\Nova\Lenses\cars\CarsummaryReport;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Query\Search\SearchableRelation;
use Laravel\Nova\Actions\ExportAsCsv;

class Car_balance extends Resource
{
    public static $group = "3.งานด้านรถบรรทุก";
    public static $priority = 7;
    public static $trafficCop = false;
    public static $with = ['car',  'vendor', 'user'];
    public static $perPageViaRelationship = 25;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Car_balance::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'docno';


    public static function searchableColumns()
    {
        return ['id', new SearchableRelation('car', 'car_regist'),
                        new SearchableRelation('vendor', 'name')
                ];
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'docno',  'car.car_regist', 'vendor.name'
    ];
    
    public static function label()
    {
        return __('Car Balance');
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
            BelongsTo::make(__('Car'), 'car', 'App\Nova\Car')
                ->searchable()
                ->sortable()
                ->showOnPreview()
                ->filterable(),
            BelongsTo::make('เจ้าของรถ', 'vendor', 'App\Nova\Vendor')
                ->searchable()
                ->sortable()
                ->exceptOnForms()
                ->showOnPreview()
                ->filterable(),

            Select::make('ประเภท', 'doctype')
                ->options([
                    'R' => 'รับ',
                    'P' => 'จ่าย'
                ])
                ->sortable()
                ->displayUsingLabels()
                ->showOnPreview(),
            Date::make('วันที่', 'cardoc_date')->sortable()
            ->showOnPreview(),
            Text::make('เลขที่เอกสาร', 'docno')->sortable()
            ->showOnPreview(),


            BelongsTo::make('ใบกำกับ', 'waybill', 'App\Nova\Waybill')
                ->sortable()
                ->hideFromIndex()
                ->searchable()
                ->nullable()
                ->showOnPreview(),
            BelongsTo::make('ใบจ่ายเงิน', 'carpayment', 'App\Nova\Carpayment')
                ->sortable()
                ->hideFromIndex()
                ->searchable()
                ->nullable()
                ->showOnPreview(),
            BelongsTo::make('ใบรับเงิน', 'carreceive', 'App\Nova\Carreceive')
                ->sortable()
                ->hideFromIndex()
                ->searchable()
                ->nullable()
                ->showOnPreview(),
            Currency::make('จำนวนเงิน', 'amount')
            ->showOnPreview(),
            Text::make('รายละเอียด', 'description')
            ->showOnPreview()
            ->hideFromIndex(),

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
           
            new CarbalanceFromDate,
            new CarbalanceToDate,
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
            ExportAsCsv::make(),
        ];
    }
    public static function indexQuery(NovaRequest $request, $query)
    {
        if ($request->user()->branch->type == 'partner') {

            return   $query->where('vendor_id', $request->user()->branch->vendor_id);
        }
        return $query;
    }
}
