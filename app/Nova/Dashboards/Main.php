<?php

namespace App\Nova\Dashboards;


use Laravel\Nova\Dashboards\Main as Dashboard;
use Laravel\Nova\Http\Requests\NovaRequest;
use Wasandev\Billing\Billing;
use Wasandev\Branch\Branch;
use Wasandev\Marketing\Marketing;
use Wasandev\Checkers\Checkers;
use Wasandev\Account\Account;
use Wasandev\Araccount\Araccount;
use Wasandev\Financial\Financial;
use Wasandev\Truck\Truck;
use Wasandev\Loading\Loading;
use Wasandev\Sender\Sender;




class Main extends Dashboard
{
    /**
     * 
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            
            (new checkers())->width('full')->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view checkercards');
                }),            
            (new Billing())->width('full')->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view billingcards');
                }),
            (new Branch())->width('full')->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view branchcards');
                }),
            (new Marketing())->width('full')->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view marketingcards');
                }),
            (new Account())->width('full')->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view accountcards');
                }),
            (new Araccount())->width('full')->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view arbalancecards');
                }),
            (new Financial())->width('full')->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view financialcards');
                }),
            (new Truck())->width('full')->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view truckcards');
                }),
            (new Loading())->width('full')->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view loadingcards');
                }),
            (new Sender())->width('full')->canSee(function ($request) {
                    return  $request->user()->hasPermissionTo('view sendercards');
                }),
        ];
    }
    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'main';
    }

    /**
     * Get the displayable name of the dashboard.
     *
     * @return string
     */
    public function label()
    {
        return 'เมนูหลัก';
    }
}
