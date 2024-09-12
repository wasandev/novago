<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class CompanyProfile extends Resource
{
    public static $group = '1.งานสำหรับผู้ดูแลระบบ';
    public static $priority = 1;
    public static $showColumnBorders = false;
    public static $clickAction = 'edit';
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\CompanyProfile';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'company_name';

    public static function availableForNavigation(Request $request)
    {
        return $request->user()->hasPermissionTo('edit companyprofile');
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'company_name'
    ];

    public static function label()
    {
        return __("Company Profile");
    }
    public static function singularLabel()
    {
        return __('Company');
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
            ID::make()->sortable(),
            Text::make(__('Company Name'), 'company_name')
                ->rules('required')->showOnPreview(),
            Text::make(__('Tax ID'), 'taxid')
                ->rules('required', 'digits:13', 'numeric')
                ->showOnPreview(),
            new Panel(__('Address'), $this->addressFields()),
            new Panel(__('Contact Info'), $this->contactFields()),
            new Panel(__('Other'), $this->otherFields()),

            BelongsTo::make(__('Created by'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')                
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Updated At'), 'updated_at')
                ->onlyOnDetail(),

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
            Text::make(__('Phone'), 'phoneno')
                ->rules('required')
                ->hideFromIndex()
                ->showOnPreview(),
            Text::make(__('Website Url'), 'weburl')
                ->hideFromIndex(),
            Text::make(__('Facebook'), 'facebook')
                ->hideFromIndex(),
            Text::make(__('Line'), 'line')
                ->hideFromIndex(),
            Text::make(__('Email'), 'email')
                ->hideFromIndex()
                ->rules('required'),

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
                    ->rules('required')
                    ->showOnPreview(),
               
                BelongsTo::make(__('Province'), 'province_name', 'App\Nova\Province')
                    ->searchable()
                    ->rules('required')
                    ->showOnPreview(),
                   
                BelongsTo::make(__('District'),'district_name','App\Nova\District')
                    ->dependsOn(['province_name'], function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                            
                            $province = $formData->province_name ;
                            
                            if ($province) {
                                $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($province) {
                                                   
                                    $query->where('province_id',$province );
                                });
                                
                            }
                        }
                    )
                    ->rules('required')
                     ->withSubtitles()->showOnPreview(),
                
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
                    ->showOnPreview(),
                Text::make(__('Postal Code'), 'postal_code')
                    ->hideFromIndex()
                    ->rules('required')
                    ->dependsOn(['province_name','district_name','subdistrict_name'], function ($field, NovaRequest $request, $formData) {
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
                                                            
                    })->showOnPreview(),  
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
                ->hideFromIndex()
                ->rules("mimes:jpeg,bmp,png", "max:2048")
                ->help('ขนาดไฟล์ไม่เกิน 2 MB.'),

            Image::make(__('Image'), 'imagefile')
                ->hideFromIndex()
                ->rules("mimes:jpeg,bmp,png", "max:2048")
                ->help('ขนาดไฟล์ไม่เกิน 2 MB.'),
            Select::make('รูปแบบการพิมพ์ใบรับส่ง', 'orderprint_option')->options([
                'form1' => 'พิมพ์ลงฟอร์ม',
                'form2' => 'พิมพ์ลงกระดาษเปล่า(A5)',
                'form3' => 'พิมพ์กระดาษเทอร์มอล'
            ])->displayUsingLabels()
                ->hideFromIndex(),

            Textarea::make(__('Other'), 'description')->hideFromIndex(),

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
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
    public static function redirectAfterCreate(NovaRequest $request, $resource)
        {
            return '/resources/' . static::uriKey();
        }
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
        {
            return '/resources/'.static::uriKey();
        }
    }
