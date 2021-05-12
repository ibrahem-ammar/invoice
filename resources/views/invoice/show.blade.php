@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card text-capitalize">
            <div class="card-header d-flex">
                <h3>invoice {{ $invoice->invoice_number }}</h3>
                <a href="{{ route('invoices.index') }}" class="btn btn-primary ml-auto"><i class="fa fa-home mr-1"></i>back to home</a>
            </div>

            <div class="card-body">
                <?php
                    $invoiceFields = ['customer_name','customer_email','customer_mobile','company_name','invoice_number','invoice_date'];
                    $invoiceDataFields = ['product_name','unit','quantity','unit_price','row_sub_total'];
                    ?>

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
                                <td>{{ $index }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>@lang('site.'.$item->unit)</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->unit_price }}</td>
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
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="{{ route('invoices.print', ['invoice'=>$invoice->id]) }}" class="btn btn-primary btn-sm ml-auto"><i class="fa fa-print mr-1"></i>print</a>
                        <a href="{{ route('invoices.pdf', ['invoice'=>$invoice->id]) }}" class="btn btn-secondary btn-sm ml-auto"><i class="fa fa-file-pdf mr-1"></i>export to pdf</a>
                        <a href="{{ route('invoices.email', ['invoice'=>$invoice->id]) }}" class="btn btn-success btn-sm ml-auto"><i class="fa fa-envelope mr-1"></i>send to email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
