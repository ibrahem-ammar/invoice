@extends('layouts.app')

@section('type') d-none @endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card text-capitalize">
            <div class="card-header d-flex">
                <h3>invoice {{ $invoice->invoice_number }}</h3>
            </div>

            <div class="card-body">
                <table class="table table-hover text-nowrap">
                    <tr>
                        <th>@lang('site.customer_name')</th>
                        <td>{{ $invoice->customer_name }}</td>
                        <th>@lang('site.customer_email')</th>
                        <td>{{ $invoice->customer_email }}</td>
                    </tr>
                    <tr>
                        <th>@lang('site.customer_mobile')</th>
                        <td>{{ $invoice->customer_mobile }}</td>
                        <th>@lang('site.company_name')</th>
                        <td>{{ $invoice->company_name }}</td>
                    </tr>
                    <tr>
                        <th>@lang('site.invoice_number')</th>
                        <td>{{ $invoice->invoice_number }}</td>
                        <th>@lang('site.invoice_date')</th>
                        <td>{{ $invoice->invoice_date }}</td>
                    </tr>
                </table>

                <h3>details</h3>

                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th></th>
                            <th>@lang('site.product_name')</th>
                            <th>@lang('site.unit')</th>
                            <th>@lang('site.quantity')</th>
                            <th>@lang('site.unit_price')</th>
                            <th>@lang('site.row_sub_total')</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice->details as$index=>$item)
                            <tr>
                                <td width='5%'>{{ $index }}</td>
                                <td width='35%'>{{ $item->product_name }}</td>
                                <td width='10%'>@lang('site.'.$item->unit)</td>
                                <td width='10%'>{{ $item->quantity }}</td>
                                <td width='10%'>{{ $item->unit_price }}</td>
                                <td>{{ $item->row_sub_total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <th colspan="2">@lang('site.sub_total')</th>
                            <td>{{ $invoice->sub_total }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <th colspan="2">@lang('site.discount')</th>
                            <td>{{$invoice->discount_value}} {{ $invoice->discount_type=='fixed'? '' :'%' }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <th colspan="2">@lang('site.vat_value')</th>
                            <td>{{ $invoice->vat_value }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <th colspan="2">@lang('site.shipping')</th>
                            <td>{{ $invoice->shipping }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <th colspan="2">@lang('site.total_due')</th>
                            <td>{{ $invoice->total_due }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function(){
        window.print()
    });
</script>
@endsection
