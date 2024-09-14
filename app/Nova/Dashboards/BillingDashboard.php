<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\OrderbyUser;
use App\Nova\Metrics\OrderByUserPartition;
use App\Nova\Metrics\OrderByUserTrend;
use App\Nova\Metrics\OrderCashbyUser;
use App\Nova\Metrics\OrderIncomes;
use App\Nova\Metrics\OrdersByBranchRec;
use App\Nova\Metrics\OrdersByPaymentType;
use App\Nova\Metrics\OrdersPerMonth;
use Laravel\Nova\Dashboard;

class BillingDashboard extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            
            (new OrderbyUser())->width('1/2'),
            (new OrderByUserTrend())->width('1/2'),
            (new OrderCashbyUser())->width('1/2'),
            (new OrderIncomes())->width('1/2'),
            (new OrdersPerMonth())->width('1/2'),
            (new OrdersByPaymentType())->width('1/2'),
            (new OrdersByBranchRec())->width('1/2'),
            (new OrderByUserPartition())->width('1/2'),


        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public  function uriKey()
    {
        return 'billing-dashboard';
    }
    /**
     * Get the displayable name of the dashboard.
     *
     * @return string
     */
    public  function label()
    {
        return 'Dashboard งานออกเอกสาร';
    }
}
