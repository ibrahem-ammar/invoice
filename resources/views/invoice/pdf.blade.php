<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $invoice_number }}</title>

    <style>
        body{
            font-family: 'XBRiyaz',sans-serif;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            font-size: 9px;
            line-height: 24px;
            font-family: 'XBRiyaz',sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }


        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 30px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: 'XBRiyaz',sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
        @page {
        header: page-header;
        footer: page-footer;
        }
    </style>
</head>

<body>
    <div class="invoice-box {{ config('app.locale') == 'ar' ? 'rtl' : '' }}">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('images/logo.jpg') }}" style="width:100%; max-width:100px;">
                            </td>

                            <td>
                                Invoice #: {{ $invoice_number }}<br>
                                Created: {{ $invoice_date }}<br>
                                Due: {{ Carbon\Carbon::now()->format('Y-m-d') }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" align="center">
                                <h2>title</h2>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td>
                                <h2>seller</h2>
                                name<br>
                                <span dir="ltr">phone</span><br>
                                vat<br>
                                address<br>
                            </td>
                            <td>
                                <h2>buyer</h2>
                                {{$customer_name}}<br>
                                {{$customer_email}}<br>
                                {{$customer_mobile}}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <th></th>
                <th>@lang('site.product_name')</th>
                <th>@lang('site.unit')</th>
                <th>@lang('site.quantity')</th>
                <th>@lang('site.unit_price')</th>
                <th>@lang('site.row_sub_total')</th>
            </tr>

            @foreach ($details as $detail)
                <tr class="item {{ $loop->last ? 'last' : '' }}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$detail['product_name']}}</td>
                    <td>{{$detail['unit']}}</td>
                    <td>{{$detail['quantity']}}</td>
                    <td>{{$detail['unit_price']}}</td>
                    <td>{{$detail['row_sub_total']}}</td>
                </tr>
            @endforeach

            <tr class="total">
                <td colspan="4"></td>
                <td>sub total</td>
                <td>{{$sub_total}}</td>
            </tr>
            <tr class="total">
                <td colspan="4"></td>
                <td>discount type</td>
                <td>{{$discount_type}}</td>
            </tr>
            <tr class="total">
                <td colspan="4"></td>
                <td>discount value</td>
                <td>{{$discount_value}}</td>
            </tr>
            <tr class="total">
                <td colspan="4"></td>
                <td>vat value</td>
                <td>{{$vat_value}}</td>
            </tr>
            <tr class="total">
                <td colspan="4"></td>
                <td>shipping</td>
                <td>{{$shipping}}</td>
            </tr>
            <tr class="total">
                <td colspan="4"></td>
                <td>total due</td>
                <td>{{$total_due}}</td>
            </tr>
        </table>
    </div>
</body>
</html>
