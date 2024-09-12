@extends('layouts.doc')

@section('header')
    @include('partials.docheader')

@endsection

@section('content')
<table style="width:100%;">
    <tr>
        <h2 style="text-align: center;font-size: 2.0em;">
            ใบจัดส่งสินค้าจากตัวแทน
        </h2>
    </tr>
</table>
<table>

    <tr>
        <td>
            เลขที่: {{ $dropship_tran->dropship_tran_no }}<br />
            สาขาตัวแทน: {{ $dropship_tran->branch->name }}<br />
            ชื่อผู้ร่วมบริการ:
            @isset($dropship_tran->branch->vendor->name)
                {{ $dropship_tran->branch->vendor->name }}
            @endisset
        </td>
        <td style="width:50%;vertical-align: top;">
            วันที่:{{ $dropship_tran->dropship_tran_date }}<br />
            พนักงานจัดส่ง :{{ $dropship_tran->employee->name }}

        </td>
    </tr>

</table>


<table style="border-bottom: 1px solid black;border-top: 1px solid black;padding: 5px;" cellspacing="3" cellpadding="5">
    <thead>
        <tr>
            <th style="width: 5%">ลำดับ</th>
            <th style="width: 15%">ใบรับส่งสินค้า</th>
            <th style="text-align: left;width: 25%">ผู้ส่งสินค้า</th>
            <th style="text-align: left;width: 25%">ผู้รับสินค้า</th>
            <th style="width: 5%">จำนวน</th>
            <th style="width: 8%">เก็บสด</th>
            <th style="width: 7%">วางบิล</th>
            <th style="width: 10%">ปลายทาง</th>
        </tr>

    </thead>

    <tbody style="border-top: 1px solid black;vertical-align: top;">
        @foreach ($order_branch as $branch => $order_groups)
            <tr>
                <td colspan="8" style="border-bottom: 1px solid black;">
                    <strong>
                    {{$branch}} จำนวนใบรับส่ง  {{count($order_groups)}} รายการ ยอดค่าขนส่ง = {{ number_format($order_groups->sum('order_amount'),2,'.',',')}}
                    </strong>
                </td>

            </tr>
            @foreach ($order_groups as $item )
            <tr>
                <td style="text-align: center">
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{$item->order_header_no}}
                </td>
                <td style="word-wrap: break-word;">
                    {{$item->customer->name}}
                </td>
                <td style="word-wrap: break-word;">
                    {{$item->to_customer->name}}
                </td>
                <td style="text-align: center">
                    {{$item->order_details->sum('amount')}}
                </td>
                <td style="text-align: right">
                @if($item->paymenttype === 'H' || $item->paymenttype === 'T')
                    {{number_format($item->order_amount,2,'.',',') }}
                @endif
                </td>

                <td style="text-align: right">
                @if($item->paymenttype === 'F' || $item->paymenttype === 'L' )
                    {{number_format($item->order_amount,2,'.',',') }}
                    @endif
                </td>
                <td style="text-align: right">
                @if($item->paymenttype === 'E'  )
                    {{number_format($item->order_amount,2,'.',',') }}
                @endif
                </td>
            </tr>
            @endforeach
        @endforeach
        <tr style="padding-top: 20px;border-top: 1px solid black;vertical-align: middle;font-size:18px;font-weight: bold;">

            <td colspan="5">รวมจำนวนใบรับส่งทั้งหมด {{count($order) }} รายการ</td>

            <td style="text-align: right">{{number_format($order->where('paymenttype','=','H')->sum('order_amount'),2,'.',',') }}</td>
            <td style="text-align: right">{{number_format($order->whereIn('paymenttype',['F','L'])->sum('order_amount'),2,'.',',') }}</td>
            <td style="text-align: right">{{number_format($order->where('paymenttype','=','E')->sum('order_amount'),2,'.',',') }}</td>

        </tr>
    </tbody>

</table>
<br>
<table style="padding: 10px;" >
    <tr>
        <td style="width:50%;vertical-align: top;font-size:18px;font-weight: bold;">
            รวมจำนวนเงินค่าขนส่ง: {{ number_format($dropship_tran->tran_amount,2,'.',',') }}<br />
            รายได้ของสาขาตัวแทน: {{ number_format($dropship_tran->dropship_income ,2,'.',',')}}<br />
            ยอดนำส่งเงินสด: {{ number_format($dropship_tran->scash_amount ,2,'.',',')}}<br />
            ยอดเก็บเงินปลายทาง: {{ number_format($dropship_tran->dcash_amount ,2,'.',',')}}<br />

        </td>
        <td style="width:50%;vertical-align: top;text-align: right;font-size:18px;font-weight: bold;">
            ผู้ส่งมอบสินค้า:..............................................<br />
            ผู้รับมอบสินค้า:..............................................<br />

        </td>
    </tr>

</table>


@endsection
