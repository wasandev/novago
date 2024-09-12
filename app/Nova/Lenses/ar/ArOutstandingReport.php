<?php

namespace App\Nova\Lenses\ar;

use App\Nova\Actions\Accounts\PrintArOutstandingReport;
use App\Nova\Filters\ArbalanceByBranch;
use App\Nova\Filters\ArbalanceToDate;
use App\Nova\Filters\ArFilterByBranch;
use App\Nova\Filters\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Lenses\Lens;
use Laravel\Nova\Actions\ExportAsCsv;
use Laravel\Nova\Http\Requests\NovaRequest;
use Suenerds\NovaSearchableBelongsToFilter\NovaSearchableBelongsToFilter;

class ArOutstandingReport extends Lens
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
                ->join('ar_balances', 'ar_balances.customer_id', '=', 'customers.id')
                ->join('order_headers', 'ar_balances.order_header_id', '=', 'order_headers.id')
                ->where('order_headers.payment_status', '=', false)
                ->where('ar_balances.doctype', '=', 'P')
                ->orderBy('ar_amount', 'desc')
                ->groupBy(
                    'customers.id',
                    'customers.name',
                )

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
            'customers.id',
            'customers.name',
            DB::raw('sum(ar_balances.ar_amount) as ar_amount'),
        ];
    }
    /**
     * Get the fields available to the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('ชื่อลูกค้า', 'name'),

            Currency::make('จำนวนเงิน', 'ar_amount'),

        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new ArFilterByBranch,
            new ArbalanceToDate
        ];
    }

    /**
     * Get the actions available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            (new PrintArOutstandingReport($request->filters))
                ->standalone()
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('view ar_balance');
                }),
            ExportAsCsv::make(),
        ];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'ar-outstanding-report';
    }
    public function name()
    {
        return 'รายงานลูกหนี้ค้างชำระ';
    }
}
