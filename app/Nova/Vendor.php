<?php

namespace App\Nova;

use App\Nova\Lenses\cars\CarpayTax;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Panel;
use Illuminate\Http\Request;
use Jfeid\NovaGoogleMaps\NovaGoogleMaps;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Actions\ExportAsCsv;
use Laravel\Nova\Fields\FormData;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class Vendor extends Resource
{
    //public static $displayInNavigation = false;
    public static $group = "3.งานด้านรถบรรทุก";
    public static $priority = 5;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Vendor';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    public static function availableForNavigation(Request $request)
    {
        return $request->user()->hasPermissionTo('edit vendors');
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'district', 'province'
    ];
    public static function label()
    {
        return __('Vendors');
    }
    public static function singularLabel()
    {
        return __('Vendor');
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
            Boolean::make(__('Status'), 'status')
                ->default(true),
            Text::make(__('Owner code'), 'owner_code')
                ->sortable()
                ->onlyOnDetail(),
            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required')
                ->creationRules('unique:vendors,name'),
            Text::make(__('Tax ID'), 'taxid')
                ->hideFromIndex(),
            Select::make(__('Type'), 'type')
                ->options([
                    'company' => 'นิติบุคคล',
                    'person' => 'บุคคลธรรมดา'
                ])
                ->displayUsingLabels()
                ->hideFromIndex()
                ->filterable(),
            Select::make(__('Payment type'), 'paymenttype')
                ->options([
                    'เงินสด' => 'เงินสด',
                    'วางบิล' => 'วางบิล'
                ])
                ->hideFromIndex()
                ->withMeta(['value' => 'เงินสด']),
            Number::make('ระยะเวลาเครดิต', 'creditterm')
                ->withMeta(['value' => 0])
                ->hideFromIndex(),
            BelongsTo::make('ประเภทธุรกิจ', 'businesstype', 'App\Nova\Businesstype')
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
            new Panel('ที่อยู่', $this->addressFields()),
            new Panel('ข้อมูลบัญชีธนาคารสำหรับโอนเงิน', $this->bankaccountFields()),
            new Panel('อื่นๆ', $this->otherFields()),
            HasMany::make('รถบรรทุก', 'cars', 'App\Nova\Car')


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
            Text::make(__('Contact name'), 'contractname')
                ->hideFromIndex(),
            Text::make(__('Phone'), 'phoneno')->sortable(),
            Text::make(__('Web url'), 'weburl')
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

        ];
    }
    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    protected function bankaccountFields()
    {
        return [
            Text::make(__('Bank Account no'), 'bankaccountno')
                ->hideFromIndex()
                ->nullable(),
            Text::make(__('Account name'), 'bankaccountname')
                ->hideFromIndex()
                ->nullable(),
            BelongsTo::make(__('Bank'), 'bank', 'App\Nova\Bank')
                ->hideFromIndex()
                ->nullable(),
            Text::make(__('Bank branch'), 'bankbranch')
                ->hideFromIndex()
                ->nullable(),
            Select::make(__('Account type'), 'account_type')
                ->options([
                    'saving' => 'ออมทรัพย์',
                    'current' => 'กระแสรายวัน',
                    'fixed' => 'ฝากประจำ'
                ])->displayUsingLabels()
                ->hideFromIndex()
                ->nullable()
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
            (new CarpayTax())

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
