<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Dashboard;
use Wasan\Accreport\Accreport;

class ReportDashboard extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            (new Accreport())->width('full'),
            
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'report-dashboard';
    }

    /**
     * Get the displayable name of the dashboard.
     *
     * @return string
     */
    public function label()
    {
        return 'รายงาน';
    }
}
