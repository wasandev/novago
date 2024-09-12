<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Trix;

class Page extends Resource
{
    public static $displayInNavigation = false;
    public static $group = "1.งานสำหรับผู้ดูแลระบบ";
    public static $priority = 6;
    /**
     * The model the resource corresponds to.
     *
     * @var  string
     */
    public static $model = \App\Models\Page::class;


    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var  string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var  array
     */
    public static $search = [
        'id', 'title', 'page_content'
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return  string
     */
    public static function label()
    {
        return __('Page');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return  string
     */
    public static function singularLabel()
    {
        return __('Page');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('Id'),  'id')
                ->rules('required')
                ->sortable(),
            Boolean::make('การเผยแพร่', 'published')
                ->rules('required')
                ->sortable(),
            Number::make('ลำดับการแสดง', 'menuorder')
                ->rules('required')
                ->sortable(),
            Text::make('ชื่อเมนู', 'navtype')
                ->rules('required')
                ->sortable(),
            Text::make(__('Slug'),  'slug')
                ->rules('required')
                ->sortable(),
            Text::make(__('Title'),  'title')
                ->rules('required')
                ->sortable(),

            Trix::make(__('Content'),  'page_content')
                ->rules('required')
                ->hideFromIndex()
                ->withFiles('public'),
            Image::make(__('Image'),  'page_image')
                ->hideFromIndex()
                ->maxWidth(600)
                ->rules('dimensions:max_width=2400,max_height=1260', 'image', 'max:1024')
                ->help('ขนาดรูปภาพที่เหมาะสมไม่เกิน 2400x1260px และขนาดไฟล์ไม่เกิน 1 Mb.'),

            DateTime::make(__('Published At'),  'published_at')
                ->hideFromIndex()
                ->sortable(),
            BelongsTo::make(__('Created by'), 'user', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Created At'), 'created_at')
                ->format('DD/MM/YYYY HH:mm')
                ->onlyOnDetail(),
            BelongsTo::make(__('Updated by'), 'user_update', 'App\Nova\User')
                ->onlyOnDetail(),
            DateTime::make(__('Updated At'), 'updated_at')
                ->format('DD/MM/YYYY HH:mm')
                ->onlyOnDetail(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
