<?php

namespace App\Nova;

use App\Nova\Metrics\EmployeeByBranch;
use App\Nova\Metrics\EmployeeByDept;
use App\Nova\Metrics\EmployeeByType;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\FormData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\ExportAsCsv;

class Employee extends Resource
{
    //public static $displayInNavigation = false;
    public static $group = '2.งานด้านบุคคล';
    public static $priority = 4;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Employee';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';



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
        return 'ข้อมูลพนักงาน';
    }
    public static function singularLabel()
    {
        return 'พนักงาน';
    }

    public static function availableForNavigation(Request $request)
    {
        return $request->user()->hasPermissionTo('edit employees');
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
            Image::make(__('Image'), 'imagefile')
                ->showOnPreview(),
            Boolean::make(__('Status'), 'active')
                ->default(true)
                ->filterable(),
            new Panel('ข้อมูลพนักงาน', $this->empdetailFields()),
            new Panel('ข้อมูลการติดต่อ', $this->contactFields()),
            new Panel('ที่อยู่', $this->addressFields()),
            new Panel('สำหรับพนักงานขับรถ', $this->drivingFields()),

            BelongsTo::make(__('Created by'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')                
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user_update', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Updated At'), 'updated_at')
                ->onlyOnDetail(),
            HasOne::make(__('Assign user'), 'assign_user', 'App\Nova\User'),


        ];
    }
    protected function empdetailFields()
    {
        return [
            Text::make(__('Employee code'), 'employee_code')
                ->hideFromIndex()
                ->nullable(),
            BelongsTo::make(__('Branch'), 'branch', 'App\Nova\Branch')
                ->rules('required')
                ->sortable()
                ->showCreateRelationButton()
                ->showOnPreview()
                ->filterable(),

            BelongsTo::make(__('Department'), 'department', 'App\Nova\Department')
                ->sortable()
                ->rules('required')
                ->showCreateRelationButton()
                ->showOnPreview()
                ->filterable(),
            Select::make(__('Employee type'), 'type')->options([
                'ผู้บริหาร' => 'ผู้บริหาร',
                'พนักงานบริษัท' => 'พนักงานบริษัท',
                'พนักงานบริษัทร่วม' => 'พนักงานบริษัทร่วม',
                'แรงงาน' => 'แรงงาน',
                'พนักงานขับรถบริษัท' => 'พนักงานขับรถบริษัท',
                'พนักงานขับรถร่วม' => 'พนักงานขับรถร่วม',
            ])->displayUsingLabels()
                ->sortable()
                ->showOnPreview(),
            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required')
                ->creationRules('unique:employees,name')
                ->showOnPreview(),
            Text::make(__('ID card number'), 'taxid')
                ->sortable()
                ->hideFromIndex()
                ->rules('required', 'digits:13', 'numeric'),

            Text::make(__('Nickname'), 'nickname')
                ->nullable()
                ->hideFromIndex(),

            BelongsTo::make(__('Position'), 'position', 'App\Nova\Position')
                ->hideFromIndex()
                ->showCreateRelationButton(),



            Select::make(__('Employee status'), 'status')->options([
                'ประจำ' => 'ประจำ',
                'ทดลองงาน' => 'ทดลองงาน',
                'สัญญาจ้าง' => 'สัญญาจ้าง',
                'ชั่วคราว' => 'ชั่วคราว',
                'รายวัน' => 'รายวัน',
                'ปลด/ไล่ออก' => 'ปลด/ไล่ออก',
                'ลาออก' => 'ลาออก',
                'เลิกจ้าง' => 'เลิกจ้าง',
                'นักศึกษาฝึกงาน' => 'นักศึกษาฝึกงาน'
            ])->displayUsingLabels()

                ->hideFromIndex(),

        ];
    }

    protected function contactFields()
    {
        return [
            Text::make(__('Email'), 'email')
                ->hideFromIndex(),
            Text::make(__('Phone'), 'phoneno')
                ->rules('required')
                ->showOnPreview(),
            Text::make(__('Email'), 'email')
                ->hideFromIndex(),
            Text::make(__('Line'), 'line')->hideFromIndex(),
            Text::make(__('Facebook'), 'facebook')->hideFromIndex(),

        ];
    }


    protected function drivingFields()
    {
        return [
            Image::make(__('Driver license picture'), 'cardimage')
                ->hideFromIndex(),
            BelongsTo::make(__('Driving license type'), 'driving_license_type', 'App\Nova\Driving_license_type')
                ->hideFromIndex()
                ->nullable()
                ->showCreateRelationButton(),
            Text::make(__('Driver license number'), 'driving_license_no')->hideFromIndex(),
            Date::make(__('Driving license date'), 'driving_license_date')->hideFromIndex(),
            Date::make(__('driving license enddate'), 'driving_license_enddate')
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
                    ->rules('required')
                    ->hideFromIndex(),
                   
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
                     ->withSubtitles()
                     ->hideFromIndex(),
                
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
                // ->hideFromIndex(),


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
            (new EmployeeByBranch()),
            (new EmployeeByDept()),
            (new EmployeeByType())

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
            (new Actions\SetEmployeeStatus)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit employees');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit employees');
                }),
            (new Actions\SetEmployeeBranch)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit employees');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit employees');
                }),
            (new Actions\SetEmployeeDepartment)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit employees');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit employees');
                }),
            (new Actions\SetEmployeeType)
                ->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit employees');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit employees');
                }),
            ExportAsCsv::make()->nameable()->withFormat(function ($model) {
                return [
                    'ID' => $model->getKey(),
                    'Name' => $model->name,
                    'Address' => $model->address,
                    'sub_district' => $model->sub_district,
                    'district' => $model->district,
                    'province' => $model->province,
                    'postal_code' => $model->postal_code,
                    'Phone No' => $model->phone_no
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
