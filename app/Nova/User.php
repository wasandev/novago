<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Filters\CurrentUser;

class User extends Resource
{
    
    public static $group = '1.งานสำหรับผู้ดูแลระบบ';
    public static $priority = 4;
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\User::class;

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
        'id', 'name', 'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Gravatar::make()->maxWidth(50),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),
            BelongsTo::make(__('Branch'), 'branch', 'App\Nova\Branch')
                ->sortable()
                ->nullable()
                ->filterable()
                ->showCreateRelationButton(),
            BelongsTo::make('ฝ่าย/แผนก', 'department', 'App\Nova\Department')
                ->sortable()
                ->nullable()
                ->filterable()
                ->showCreateRelationButton(),

            BelongsTo::make('รายการสาขาปลายทาง(ที่ทำงานประจำ)', 'branch_rec', 'App\Nova\Branch')
                ->sortable()
                ->nullable()
                ->showCreateRelationButton(),
            Select::make(__('Role'), 'role')->options([
                'employee' => 'พนักงาน',
                'admin' => 'Admin',
                'customer' => 'ลูกค้า',
                'driver' => 'พนักงานขับรถ'
            ])->displayUsingLabels()
                ->rules('required')
                ->canSee(function ($request) {
                    return $request->user()->role == 'admin';
                }),
            Text::make(__('User Code'), 'usercode')
                ->hideFromIndex()
                ->canSee(function ($request) {
                    return $request->user()->role == 'admin';
                }),

            BelongsTo::make(__('Employee'), 'assign_user', 'App\Nova\Employee')
                ->nullable()
                ->showCreateRelationButton()
                ->hideFromIndex()
                ->canSee(function ($request) {
                    return $request->user()->role == 'admin';
                }),
            BelongsTo::make(__('Customer'), 'assign_customer', 'App\Nova\Customer')
                ->nullable()
                ->searchable()
                ->showCreateRelationButton()
                ->hideFromIndex()
                ->canSee(function ($request) {
                    return $request->user()->role == 'admin';
                }),
            BelongsToMany::make(__('Roles'), 'roles', \Pktharindu\NovaPermissions\Nova\Role::class)
                ->canSee(function ($request) {
                    return $request->user()->role == 'admin';
                }),
            BelongsTo::make(__('Created by'), 'user_create', 'App\Nova\User')
                ->OnlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')
               
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user_update', 'App\Nova\User')
                ->OnlyOnDetail(),
            DateTime::make(__('Updated At'), 'updated_at')
                
                ->onlyOnDetail(),
            DateTime::make('Login ล่าสุด', 'logged_in_at')
                
                ->sortable()
                ->canSee(function ($request) {
                    return $request->user()->role == 'admin';
                }),

            DateTime::make('Log out ล่าสุด', 'logged_out_at')
                
                ->onlyOnDetail()
                ->canSee(function ($request) {
                    return $request->user()->role == 'admin';
                }),
            Text::make('IP Address', 'ip_address')
                ->onlyOnDetail()
                ->canSee(function ($request) {
                    return $request->user()->role == 'admin';
                }),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            
            new CurrentUser
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
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
    public function actions(Request $request)
    {
        return [
            (new Actions\SetUserDepartment)->canSee(function ($request) {
                return $request->user()->role == 'admin';
            }),
            (new Actions\SetUserBranch)
                ->canSee(function ($request) {
                    return $request->user()->role == 'admin';
                }),
        ];
    }
    public static function indexQuery(NovaRequest $request, $query)
    {
        if ($request->user()->role != 'admin') {
            return $query->where('role', '<>', 'admin');
        }
        return $query;
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
