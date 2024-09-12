<?php

namespace App\Nova;

use App\Nova\Lenses\ar\ArcardReport;
use App\Nova\Lenses\ar\ArOutstandingReport;
use App\Nova\Lenses\ar\ArReceiptReport;
use App\Nova\Lenses\ar\ArSummaryReport;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Panel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\FormData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\ExportAsCsv;
//use Jfeid\NovaGoogleMaps\NovaGoogleMaps;
use Laravel\Nova\Http\Requests\NovaRequest;

class Ar_customer extends Resource
{
    public static $group = '9.1 งานลูกหนี้การค้า';
    public static $priority = 1;
    public static $preventFormAbandonment = true;


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Ar_customer';

    public static function availableForNavigation(Request $request)
    {
        return $request->user()->hasPermissionTo('edit ar_customer');
    }
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    //public static $title = 'name';
    public function title()
    {
        return $this->name;
    }

    public function subtitle()
    {
        return $this->sub_district . ' ' . $this->district . ' ' . $this->province;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'phoneno'
    ];

    public static function label()
    {
        return 'ข้อมูลลูกค้าวางบิล';
    }
    public static function singularLabel()
    {
        return 'ลูกค้าวางบิล';
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
            Boolean::make(__('Status'), 'status'),
            Text::make(__('Customer code'), 'customer_code')
                ->readonly()
                ->hideFromIndex(),

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:250', 'unique:customers,name'),

            Text::make(__('Tax ID'), 'taxid')
                ->hideFromIndex(),
            //->rules('digits:13', 'numeric'),
            Select::make(__('Type'), 'type')->options([
                'company' => 'นิติบุคคล',
                'person' => 'บุคคลธรรมดา'
            ])
                ->displayUsingLabels()
                ->hideFromIndex(),

            Select::make(__('Payment type'), 'paymenttype')->options([
                'H' => 'เงินสดต้นทาง',
                'E' => 'เงินสดปลายทาง',
                'Y' => 'วางบิล'
            ])
                ->hideFromIndex()
                //->withMeta(['value' => 'Y'])
                ->displayUsingLabels(),
            Number::make(__('Credit term'), 'creditterm')
                ->hideFromIndex(),
            BelongsTo::make(__('Business type'), 'businesstype', 'App\Nova\Businesstype')
                ->hideFromIndex()
                ->showCreateRelationButton(),

            BelongsTo::make(__('Created by'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user_update', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Updated At'), 'updated_at')
                ->onlyOnDetail(),

            new Panel('ข้อมูลการติดต่อ', $this->contactFields()),
            new Panel('ที่อยู่ในการออกเอกสาร', $this->addressFields()),
            new Panel('อื่นๆ', $this->otherFields()),
            
            HasMany::make('รายการวางบิล', 'ar_balances', 'App\Nova\Ar_balance'),
            HasMany::make('ใบแจ้งหนี้', 'invoices', 'App\Nova\Invoice'),


        ];
    }

    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    protected function contactFields()
    {
        return [
            Text::make(__('Contact name'), 'contactname')
                ->hideFromIndex(),
            Text::make(__('Email'), 'email')
                ->hideFromIndex(),
            Text::make(__('Phone'), 'phoneno')
                ->rules('required')
                ->hideFromIndex(),
            Text::make(__('Website Url'), 'weburl')
                ->hideFromIndex(),
            Text::make(__('Facebook'), 'facebook')
                ->hideFromIndex(),
            Text::make(__('Line'), 'line')
                ->hideFromIndex(),

        ];
    }
    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    protected function addressFields()
    {
        return [

            Text::make(__('Address'), 'address')->hideFromIndex()
                ->rules('required'),
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
                
                BelongsTo::make(__('Sub District'), 'subdistrict_name', 'App\Nova\SubDistrict')
                    ->dependsOn(['district_name'], function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                                
                                $district = $formData->district_name ;
                                
                                if ($district) {
                                    $field->relatableQueryUsing(function (NovaRequest $request, Builder $query ) use ($district) {         
                                        $query->where('district_id',$district );                                        
                                    });
                            
                                   
                                }

                            }
                        )
                   
                    ->rules('required')
                    ->hideFromIndex(),
                Text::make(__('Postal Code'), 'postal_code')
                    ->hideFromIndex()
                    ->rules('required')
                    ->dependsOn(['province_name','district_name','subdistrict_name'], function (Text $field, NovaRequest $request, $formData) {
                        $province =  (int) $formData->resource(Province::uriKey(), $formData->province_name);
                        $district =  (int) $formData->resource(District::uriKey(), $formData->district_name);
                        $subdistrict = (int) $formData->resource(SubDistrict::uriKey(), $formData->subdistrict_name);
                        
                        $postal_code = DB::table('postal_code')->select('code')
                                            ->where('province_id',$province)
                                            ->where('district_id',$district)
                                            ->where('sub_district_id',$subdistrict)
                                            ->first();
                        if($postal_code) {
                            $field->setValue($postal_code->code);
                        }
                                                            
                    }),  

            //NovaGoogleMaps::make(__('Google Map Address'), 'location')->setValue($this->location_lat, $this->location_lng)
            //    ->hideFromIndex(),

        ];
    }
    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    protected function otherFields()
    {
        return [
            Image::make(__('Logo'), 'logofile')
                ->hideFromIndex(),
            Image::make(__('Image'), 'imagefile')
                ->hideFromIndex(),
            Textarea::make(__('Other'), 'description')
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
            new Filters\BusinessType,
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
            new Lenses\MostValueableAr(),
            new ArReceiptReport(),
            new ArOutstandingReport(),
            new ArcardReport(),
            new ArSummaryReport()

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
            (new Actions\SetCustomerType)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit ar_customer');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit ar_customer');
                }),
            (new Actions\SetCustomerPtype)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit ar_customer');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit ar_customer');
                }),
            (new Actions\SetCustomerPaymentType)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit ar_customer');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit ar_customer');
                }),
            


        ];
    }
    public static function indexQuery(NovaRequest $request, $query)
    {

        return $query->where('paymenttype', '=', 'Y');
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
