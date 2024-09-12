<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\FormData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

//use Jfeid\NovaGoogleMaps\NovaGoogleMaps;

class Address extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $displayInNavigation = false;
    public static $model = 'App\Models\Address';
    public static $globallySearchable = false;
    public static $preventFormAbandonment = true;


    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public static function label()
    {
        return __('Customer addresses');
    }
    public static function singulatLabel()
    {
        return __('Addresses');
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'address', 'district'
    ];

    //public static $title = 'name';
    public function title()
    {
        return $this->name . ' ' . $this->district;
    }

    public function subtitle()
    {

        return   $this->address . ' ' . $this->sub_district . ' ' . $this->district . ' ' . $this->province;
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
            ID::make()->sortable()->hideFromIndex(),
            BelongsTo::make(__('Customer name'), 'customer', 'App\Nova\Customer')
                ->hideFromIndex()
                ->withSubtitles()
                ->searchable(),
            Text::make(__('Address name'), 'name')->sortable()
                ->placeholder('ชื่อเรียกที่อยู่')
                ->rules('required'),
            Text::make(__('Contact name'), 'contactname')
                ->sortable()
                ->rules('required'),
            Text::make(__('Phone'), 'phoneno')
                ->rules('required', 'numeric'),
            new Panel(__('Address'), $this->addressFields()),
            BelongsTo::make(__('User'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
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
        return [];
    }
    public static function relatableQuery(NovaRequest $request, $query)
    {
        if (isset($request->viaResourceId) && ($request->viaRelationship === 'charter_job_items')) {

            $resourceId = $request->viaResourceId;

            $charter_job = \App\Models\Charter_job::find($resourceId);
            $customer  = $charter_job->customer;
            return $query->where('customer_id', '=', $customer->id);
        }
    }
}
