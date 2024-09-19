<?php

namespace App\Nova;

use App\Nova\Filters\CarType;
use App\Nova\Filters\OwnerType;
use App\Nova\Lenses\accounts\CarpaymentReportByDay;
use App\Nova\Lenses\accounts\CarreceiveReportByDay;
use App\Nova\Lenses\CarMonthCount;
use App\Nova\Lenses\CarMonthSumary;
use App\Nova\Lenses\cars\CarcardReport;
use App\Nova\Lenses\cars\CarsummaryReport;
use Carbon\Carbon;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Unique;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Actions\ExportAsCsv;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Query\Search\SearchableRelation;


class Car extends Resource
{

    public static $group = "3.งานด้านรถบรรทุก";
    public static $priority = 4;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Car';
    public static function availableForNavigation(Request $request)
    {
        return $request->user()->hasPermissionTo('view cars');
    }
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    //public static $title = 'car_regist';

    public function title()
    {

        return $this->car_regist;
    }

    public function subtitle()
    {
        return  $this->cartype->name;
    }

    public static function searchableColumns()
    {
        return ['car_regist', new SearchableRelation('owner', 'name')];
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'car_regist' ,'owner.name'
    ];

    

    public static function label()
    {
        return __('Cars');
    }

    public static function singularLabel()
    {
        return __('Car');
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
            Boolean::make('ใช้งาน', 'status')
                ->default(true),
            //->hideWhenCreating(),

            Image::make('รูปรถ', 'carimage')
                ->rules("mimes:jpeg,bmp,png", "max:2048")
                ->help('ขนาดไฟล์ไม่เกิน 2 MB.')
                ->showOnPreview()
                ->hideFromIndex(),
            new Panel('รายละเอียดของรถ', $this->carFields()),
            new Panel('รายละเอียดอื่นๆของรถ', $this->carotherFields()),
            BelongsTo::make(__('Created by'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user_update', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Updated At'), 'updated_at')
                ->onlyOnDetail(),
            HasMany::make('รายการใบกำกับทั่วไป', 'waybills', 'App\Nova\Waybill'),
            HasMany::make('รายการใบกำกับเหมาคัน', 'waybill_charters', 'App\Nova\Waybill_charter'),
            HasMany::make('รายการจ่ายรถ', 'carpayments', 'App\Nova\Carpayment'),
            HasMany::make(__('Car Balance'), 'car_balances', 'App\Nova\Car_balance')


        ];
    }
    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    protected function carFields()
    {
        return [
            Text::make('ทะเบียนรถ', 'car_regist')
                ->rules('required')
                ->creationRules('unique:cars,car_regist')
                ->sortable()
                ->showOnPreview(),
            BelongsTo::make('ประเภทรถ', 'cartype', 'App\Nova\Cartype')
                ->showCreateRelationButton()
                ->sortable()
                ->nullable()
                ->hideFromIndex()
                ->showOnPreview()
                ->filterable(),
            BelongsTo::make('ลักษณะรถ', 'carstyle', 'App\Nova\Carstyle')
                ->showCreateRelationButton()
                ->hideFromIndex()
                ->nullable()
                ->showOnPreview()
                ->filterable(),
            BelongsTo::make('จังหวัด', 'province', Province::class)
                ->hideFromIndex()
                ->searchable()
                ->nullable(),
            Text::make('หมายเลขรถของบริษัท', 'carno')
                ->hideFromIndex(),
            Select::make('ตำแหน่งรถ', 'carposition')->options([
                'tractor' => 'หัว',
                'trailer' => 'หาง'
            ])->displayUsingLabels()
                ->sortable()
                ->hideFromIndex(),
            BelongsTo::make(__('Branch'), 'branch', 'App\Nova\Branch')
                ->help('ให้ระบุกรณีเป็นรถกระจายสินค้าของสาขา')
                ->sortable()
                ->nullable()
                ->filterable(),
            Select::make('การเป็นเจ้าของ', 'ownertype')->options([
                'owner' => 'รถบริษัท',
                'partner' => 'รถร่วมบริการ'
            ])->displayUsingLabels()
                ->sortable()
                ->showOnPreview()
                ->filterable(),
            BelongsTo::make('เจ้าของรถ/ผู้รับรายได้', 'owner', 'App\Nova\Vendor')
                ->showCreateRelationButton()
                ->sortable()
                ->searchable()
                ->hide()
                ->dependsOn('ownertype', function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    if ($formData->ownertype === 'partner') {
                        $field->show()->rules('required');
                    }
                })
                ->hideFromIndex(),

            BelongsTo::make('เจ้าของรถ/ผู้รับรายได้', 'owner', 'App\Nova\Vendor')
                ->sortable()
                ->onlyOnIndex()
                ->filterable()
                ->showOnPreview(),



            BelongsTo::make('พนักงานขับรถ', 'driver', 'App\Nova\Employee')
                ->showCreateRelationButton()
                ->sortable()
                ->searchable()
                ->nullable()
                ->hideFromIndex()
                ->showOnPreview(),
            Number::make('ค่าบรรทุกก่อนหน้า', 'carpmonth_amount', function () {
                $carpmonth_amount = DB::table('waybills')
                    ->whereYear('waybill_date', Carbon::now()->year)
                    ->whereMonth('waybill_date', Carbon::now()->month - 1)
                    ->where('car_id', $this->id)
                    ->sum('waybill_payable');
                return $carpmonth_amount;
            })->exceptOnForms()
                ->step('0.01'),
            Number::make('ค่าบรรทุกเดือนนี้', 'carmonth_amount', function () {
                $carmonth_amount = DB::table('waybills')
                    ->whereYear('waybill_date', Carbon::now()->year)
                    ->whereMonth('waybill_date', Carbon::now()->month)
                    ->where('car_id', $this->id)
                    ->sum('waybill_payable');
                return $carmonth_amount;
            })->exceptOnForms()
                ->step('0.01'),
            Date::make('วันที่ได้มา/วันที่เข้าร่วม', 'purchase_date')
                ->hideFromIndex(),
            Currency::make('ราคาที่ซื้อมา', 'purchase_price')
                ->hideFromIndex(),

            BelongsTo::make('ตำแหน่งยาง', 'tiretype', 'App\Nova\Tiretype')
                ->hideFromIndex()
                ->nullable()
                ->showCreateRelationButton(),
            Number::make('จำนวนยาง', 'tires')
                ->nullable()
                ->hideFromIndex(),
        ];
    }
    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    protected function carotherFields()
    {
        return [
            Select::make('ประเภทเชื้อเพลง', 'fueltype')->options([
                'diesel' => 'ดีเซล',
                'gasoline' => 'เบนซิน',
                'LPG' => 'LPG',
                'NGV' => 'NGV',
            ])->displayUsingLabels()
                ->sortable()
                ->hideFromIndex(),
            Text::make('ยี่ห้อ', 'carbrand')
                ->hideFromIndex(),
            Text::make('รุ่น', 'carmodel')
                ->hideFromIndex(),
            Text::make('หมายเลขเครื่อง', 'engineno')
                ->hideFromIndex(),
            Text::make('จำนวนซีซี', 'car_cc')
                ->hideFromIndex(),
            Number::make('ปริมาตรรถ', 'car_volumn')
                ->hideFromIndex()
                ->step(0.01),
            Number::make('น้ำหนักรถ(กก.)', 'car_weight')
                ->hideFromIndex()
                ->step(0.01),
            Number::make('น้ำหนักบรรทุก(กก.)', 'load_weight')
                ->hideFromIndex()
                ->step(0.01),

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
            // (new NovaSearchableBelongsToFilter('ชื่อเจ้าของรถ'))
            //     ->fieldAttribute('owner')
            //     ->filterBy('vendor_id'),
           // new OwnerType,
            //new CarType,
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
            new CarMonthSumary(),
            new CarMonthCount(),
            new CarcardReport(),
            new CarsummaryReport(),
            new CarpaymentReportByDay(),
            new CarreceiveReportByDay()
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

            ExportAsCsv::make()->nameable(),
            (new Actions\SetCarType)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit cars');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit cars');
                }),
            (new Actions\SetCarStyle)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit cars');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit cars');
                }),
            (new Actions\SetCarOwnerType)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit cars');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit cars');
                }),

            (new Actions\ChangCarOwner)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit cars');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit cars');
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        if ($request->user()->branch->type == 'partner') {

            return   $query->where('vendor_id', $request->user()->branch->vendor_id);
        }
        return $query;
    }
}
