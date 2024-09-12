<?php

namespace App\Nova\Lenses;

use App\Nova\Filters\LensBranchFilter;

use App\Nova\Filters\OrderFromDate;
use App\Nova\Filters\OrderToDate;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Lenses\Lens;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Date;


class CheckingByUser extends Lens
{
    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->select(self::columns())
                ->join('branches', 'branches.id', '=', 'order_headers.branch_id')
                ->join('users', 'users.id', '=', 'order_headers.checker_id')
                ->where('order_headers.order_status', '<>', 'checking')
                ->orderBy('ordercount', 'desc')
                //->orderBy('order_headers.order_header_date', 'asc')
                ->groupBy('order_headers.branch_id',  'order_headers.checker_id')
        ));
    }
    /**
     * Get the columns that should be selected.
     *
     * @return array
     */
    protected static function columns()
    {
        return [
            'branches.name as branch_name',
            //'order_headers.order_header_date',
            'users.name as user_name',
            DB::raw('count(order_headers.id) as ordercount'),
        ];
    }


    /**
     * Get the fields available to the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [

            Text::make(__('Branch'), 'branch_name'),
            //Date::make(__('Order date'), 'order_header_date')
            //    ->format('DD/MM/YYYY'),
            Text::make('ชื่อพนักงานตรวจรับ', 'user_name'),
            Number::make(__('จำนวนการตรวจรับ'), 'ordercount', function ($value) {
                return $value;
            }),

        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new LensBranchFilter(),
            new OrderFromDate(),
            new OrderToDate(),
        ];
    }

    /**
     * Get the actions available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {


        return [];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'checking-by-user';
    }
    public function name()
    {
        return 'รายการตรวจรับตามพนักงาน';
    }
}
