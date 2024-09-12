<?php

namespace App\Nova\Actions;

use App\Models\Ar_balance;
use App\Models\Bank;
use App\Models\Bankaccount;
use App\Models\Invoice;
use App\Models\Order_banktransfer;
use App\Models\Order_header;
use App\Models\Receipt;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\FormData;

class InvoiceReceipt extends Action
{
    use InteractsWithQueue, Queueable;

    public function uriKey()
    {
        return 'invoice_receipt';
    }
    public function name()
    {
        return 'รับชำระหนี้';
    }



    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {

        $select_items = $models->filter(function ($item) {
            return data_get($item, 'status') == 'new';
        });
        if ($select_items->isNotEmpty()) {
            $cust_groups = $select_items->groupBy('customer_id')->all();
            $invoice_custs = $cust_groups;
            foreach ($invoice_custs as $invoice_cust => $cust_groups) {

                $pay_amount = 0;
                foreach ($cust_groups as $invoice_item) {
                    $pay_amount = $pay_amount + $invoice_item->ar_balances->sum('ar_amount');
                }

                // if ($pay_amount <> $fields->pay_amount + $fields->discount_amount) {
                //     return Action::danger('ยอดเงินรับชำระไม่ถูกต้อง ยอดรับต้องเท่ากับ ' . ($pay_amount - $fields->discount_amount));
                // }
                $receipt_no = IdGenerator::generate(['table' => 'receipts', 'field' => 'receipt_no', 'length' => 15, 'prefix' => 'RC' . date('Ymd')]);
                if ($fields->tax_status) {
                    $tax_amount =  $pay_amount * 0.01;
                } else {
                    $tax_amount = 0;
                }
                $receipt = Receipt::create([
                    'receipt_no' => $receipt_no,
                    'status' => true,
                    'receipt_date' => $fields->receipt_date,
                    'branch_id' => auth()->user()->branch_id,
                    'customer_id' => $invoice_cust,
                    'total_amount' => $pay_amount,
                    'discount_amount' => $fields->discount_amount,
                    'tax_amount' => $tax_amount,
                    'pay_amount' => $fields->pay_amount,
                    'receipttype' => 'B',
                    'branchpay_by' => $fields->payment_by,
                    'bankaccount_id' => $fields->bankaccount_id,
                    'bankreference' => $fields->bankreference,
                    'chequeno' => $fields->chequeno,
                    'chequedate' => $fields->chequedate,
                    'chequebank_id' => $fields->chequebank,
                    'description' => $fields->description,
                    'user_id' => auth()->user()->id,
                ]);

                Ar_balance::create([
                    'customer_id' => $invoice_cust,
                    'doctype' => 'R',
                    'docno' => $receipt_no,
                    'docdate' => $fields->receipt_date,
                    'description' => 'รับชำระหนี้',
                    'ar_amount' => $pay_amount,
                    'user_id' => auth()->user()->id,
                    'receipt_id' => $receipt->id,

                ]);
                if ($fields->payment_by == "T") {
                    $Order_banktransfer = Order_banktransfer::create([
                        'customer_id' => $invoice_cust,
                        'receipt_id' => $receipt->id,
                        'branch_id' => auth()->user()->branch_id,
                        'status' => true,
                        'transfer_amount' => $fields->pay_amount,
                        'bankaccount_id' => $fields->bankaccount,
                        'reference' => $fields->reference,
                        'transfer_type' => 'B',
                        'user_id' => auth()->user()->id,
                        'transfer_date' => $fields->receipt_date,
                    ]);
                }
                foreach ($cust_groups as $model) {
                    $model->receipt_id = $receipt->id;
                    $model->status = 'completed';
                    $model->save();
                    $ar_balances = Ar_balance::where('invoice_id', '=', $model->id)->get();
                    foreach ($ar_balances as $ar_balance) {
                        $ar_balance->receipt_id = $receipt->id;
                        $ar_balance->updated_by = auth()->user()->id;
                        $ar_balance->save();
                        $order_header = Order_header::find($ar_balance->order_header_id);
                        $order_header->payment_status = true;
                        $order_header->updated_by = auth()->user()->id;
                        $order_header->saveQuietly();
                    }
                }
            }
            return Action::message('รับชำระหนี้เรียบร้อยแล้ว');
        } else {
            return Action::danger('ไม่มีใบแจ้งที่ต้องการรับชำระหรือใบแจ้งหนี้ที่เลือกรับชำระเรียบร้อยแล้ว');
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $bankaccount = Bankaccount::where('defaultflag', '=', true)->pluck('account_no', 'id');
        $banks = Bank::all()->pluck('name', 'id');


        return [
            Number::make('จำนวนเงินรับชำระ', 'pay_amount')->step(0.01),
            Date::make('วันที่รับชำระ', 'receipt_date'),
            Select::make('รับชำระด้วย', 'payment_by')->options([
                'C' => 'เงินสด',
                'T' => 'เงินโอน',
                'Q' => 'เช็ค'
            ])->displayUsingLabels()
                ->default('C'),
           
            Select::make(__('Account no'), 'bankaccount')
                ->options($bankaccount)
                ->displayUsingLabels()
                ->rules('required')
                ->hide()
                ->dependsOn('payment_by', function (Select $field, NovaRequest $request, FormData $formData) {
                    if ($formData->payment_by === 'T') {
                        $field->show()->rules('required');
                    }
                }),
            Text::make(__('Bank reference no'), 'reference')
                ->hide()
                    ->dependsOn('payment_by', function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->payment_by === 'T') {
                            $field->show()->rules('required');
                        }
                    }),
           

            Text::make(__('Cheque No'), 'chequeno')
                ->nullable()
                ->hide()
                ->dependsOn('payment_by', function (Text $field, NovaRequest $request, FormData $formData) {
                    if ($formData->payment_by === 'Q') {
                        $field->show()->rules('required');
                    }
                }),
            Text::make(__('Cheque Date'), 'chequedate')
                ->nullable()
                ->hide()
            ->dependsOn('payment_by', function (Text $field, NovaRequest $request, FormData $formData) {
                if ($formData->payment_by === 'Q') {
                    $field->show()->rules('required');
                }
            }),
            Select::make(__('Cheque Bank'), 'chequebank')
                ->options($banks)
                ->nullable()
                ->hide()
                ->dependsOn('payment_by', function (Select $field, NovaRequest $request, FormData $formData) {
                    if ($formData->payment_by === 'Q') {
                        $field->show()->rules('required');
                    }
                }),
           
            Number::make('ส่วนลด', 'discount_amount')->step(0.01),
            Boolean::make('หักภาษี ณ ที่จ่าย', 'tax_status'),
            Text::make('หมายเหตุเพิ่มเติม', 'remark')
        ];
    }
}
