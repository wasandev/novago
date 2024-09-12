<?php

namespace App\Nova;

use App\Nova\Metrics\Branchtrends\BranchBalanceDeliveryFrom;
use App\Nova\Metrics\Branchtrends\BranchBalanceFrom;
use App\Nova\Metrics\Branchtrends\BranchBalanceNotpayFrom;
use App\Nova\Metrics\Branchtrends\BranchBalancePayFrom;
use App\Nova\Metrics\Branchtrends\BranchBalanceWarehouseFrom;
use App\Nova\Metrics\Branchtrends\BranchOrderFrom;
use App\Nova\Metrics\Branchtrends\BranchrecWaybillFrom;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Panel;
use Wasandev\InputThaiAddress\InputSubDistrict;
use Wasandev\InputThaiAddress\InputDistrict;
use Wasandev\InputThaiAddress\InputProvince;
use Wasandev\InputThaiAddress\InputPostalCode;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
//use Jfeid\NovaGoogleMaps\NovaGoogleMaps;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Actions\ExportAsCsv;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Boolean;

class Branch extends Resource
{
   
    //public static $displayInNavigation = false;
    public static $group = '1.งานสำหรับผู้ดูแลระบบ';
    public static $priority = 2;
    
    //public static $showColumnBorders = true;

    //public static $subGroup = "ข้อมูลบริษัท";
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Branch';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public static function availableForNavigation(Request $request)
    {
        return $request->user()->hasPermissionTo('edit branches');
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
    ];

    public static function label()
    {
        return __('Branches');
    }
    public static function singularLabel()
    {
        return __('Branch');
    }
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {

        // $nestedBranchAreasForm = NestedForm::make('Branch_areas');
        // $nestedBranchAreasForm = $nestedBranchAreasForm->showOnDetail(true);

        return [

            ID::make(),
            Text::make(__('Branch Code'), 'code')
                ->rules('required')
                ->sortable(),
            Text::make(__('Name'), 'name')->sortable()
                ->rules('required'),

            Text::make(__('Phone'), 'phoneno')
                ->rules('required'),

            new Panel(__('Address'), $this->addressFields()),
            Select::make(__('Branch Type'), 'type')->options([
                'owner' => 'บริษัทเป็นเจ้าของ',
                'partner' => 'ร่วมบริการ'
            ])->displayUsingLabels()
                ->rules('required')
                ->sortable(),
            Number::make('% บริษัท', 'partner_rate')
                ->onlyOnIndex()
                ->sortable(),
            Number::make('% Dropship', 'dropship_rate')
                ->onlyOnIndex()
                ->sortable(),
            
            BelongsTo::make(__('Vendor'), 'vendor', 'App\Nova\Vendor')
                ->searchable()
                ->showCreateRelationButton()
                ->nullable()
                ->hide()
                ->dependsOn('type', function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    if ($formData->type === 'partner') {
                        $field->show()->rules('required');
                    }
                }),
            Number::make('รายได้บริษัท(%)', 'partner_rate')
                ->hide()
                ->dependsOn('type', function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    if ($formData->type === 'partner') {
                        $field->show()->rules('required');
                    }
                }),
            Boolean::make('Dropship', 'dropship_flag'),
            Number::make('รายได้ Dropship (%)', 'dropship_rate')->nullable()
                ->help('รายได้ของผู้ร่วมบริการต้นทาง(Dropship)%'),
            
            HasMany::make(__('Branch Areas'), 'branch_areas', 'App\Nova\Branch_area'),
            

            BelongsTo::make(__('Created by'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')
                
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user_update', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Updated At'), 'updated_at')
                
                ->onlyOnDetail(),
            HasMany::make('เส้นทางขนส่งของสาขา', 'branch_routes', 'App\Nova\Branch_route'),
            HasMany::make('รายการเก็บเงินปลายทาง', 'branch_balances', 'App\Nova\Branch_balance')
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

            // NovaGoogleMaps::make(__('Google Map Address'), 'location')->setValue($this->location_lat, $this->location_lng)
            //     ->hideFromIndex(),

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

            (new BranchOrderFrom())->width('full')->onlyOnDetail(),
            (new BranchrecWaybillFrom())->width('1/2')->onlyOnDetail(),
            (new BranchBalanceFrom())->width('1/2')->onlyOnDetail(),
            (new BranchBalancePayFrom())->width('1/2')->onlyOnDetail(),
            (new BranchBalanceNotpayFrom())->width('1/2')->onlyOnDetail(),
            (new BranchBalanceWarehouseFrom())->width('1/2')->help('รวมทุกประเภทการชำระเงิน')->onlyOnDetail(),
            (new BranchBalanceDeliveryFrom())->width('1/2')->help('รวมทุกประเภทการชำระเงิน')->onlyOnDetail(),
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
        return [];
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
            new Lenses\MostValueBranchDiscount(),
            //new Lenses\MostValueBranchDistrict()

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
            (new Actions\AddBranchArea)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit branches');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit branches');
                }),
            // (new Actions\ImportBranches)->canSee(function ($request) {
            //     return $request->user()->role == 'admin';
            // }),
            ExportAsCsv::make()->nameable()
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit branches');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit branches');
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
