<?php

namespace App\Nova\Lenses;

use App\Nova\Filters\BranchbalanceToDate;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Lenses\Lens;
use Illuminate\Support\Facades\DB;
use App\Nova\Filters\OrderFromDate;
use App\Nova\Filters\OrderToDate;
use Laravel\Nova\Actions\ExportAsCsv;

class MostValueBranchDiscount extends Lens
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
                ->join('branch_balances', 'branches.id', '=', 'branch_balances.branch_id')
                ->where('branch_balances.payment_status', '=', true)
                ->where('branch_balances.discount_amount', '>', 0)
                ->orderBy('discount', 'desc')
                ->groupBy('branches.id', 'branches.name')
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
            'branches.id',
            'branches.name',
            DB::raw('sum(branch_balances.discount_amount) as discount'),
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
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Name'), 'name'),
            Currency::make('ยอดส่วนลด', 'discount', function ($value) {
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

            new BranchbalanceToDate()
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
        return [
             ExportAsCsv::make()->canRun(function ($request) {
                    return $request->user()->hasPermissionTo('edit customers');
                })
                ->canSee(function ($request) {
                    return $request->user()->hasPermissionTo('edit customers');
                }),
        ];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'most-value-branch-discount';
    }
    public function name()
    {
        return 'ส่วนลดค่าขนส่งปลายทางตามสาขา';
    }
}
