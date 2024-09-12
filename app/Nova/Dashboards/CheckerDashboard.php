<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\CheckerbyUser;
use App\Nova\Metrics\CheckerbyUserMetric;
use App\Nova\Metrics\CheckerCancelbyUser;
use App\Nova\Metrics\CheckerProblembyUser;
use Laravel\Nova\Dashboard;

class CheckerDashboard extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            (new CheckerbyUserMetric())->width('1/3'),
            (new CheckerCancelbyUser())->width('1/3'),
            (new CheckerProblembyUser())->width('1/3')
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public  function uriKey()
    {
        return 'checker-dashboard';
    }
    /**
     * Get the displayable name of the dashboard.
     *
     * @return string
     */
    public function label()
    {
        return 'พนักงานตรวจรับ';
    }
}
