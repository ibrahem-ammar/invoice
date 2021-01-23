@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-capitalize d-flex">
                <h3 class="d-inline-block">invoices</h3>
                <a href="{{ route('invoices.create') }}" class="btn btn-primary ml-auto"><i class="fa fa-plus mr-1"></i>create new invoice</a>
            </div>
            <div class="card-body">

                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr class="text-capitalize">
                            <th>#</th>
                            <th>customer name</th>
                            <th>invoice date</th>
                            <th>total due</th>
                            <th>actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoices as $invoice)
                        <tr>
                            <td>{{$invoice->invoice_number}}</td>
                            <td><a href="{{ route('invoices.show', ['invoice'=>$invoice->id]) }}">{{$invoice->customer_name}}</a></td>
                            <td>{{$invoice->invoice_date}}</td>
                            <td>{{$invoice->total_due}}</td>
                            <td class="text-capitalize">
                                <a href="{{ route('invoices.edit', ['invoice'=>$invoice->id]) }}" class="btn btn-primary "><i class="fa fa-edit mr-1"></i>edit</a>
                                <a href="javascript:void(0)" onclick="if (confirm('are you sute')){document.getElementById('delete-{{$invoice->id}}').submit()}else{return false;}" class="btn btn-danger text-capitalize"><i class="fa fa-trash mr-1"></i>delete</a>

                                <form action="{{ route('invoices.destroy', ['invoice'=>$invoice->id]) }}" method="post" class="d-none" id="delete-{{$invoice->id}}">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td>bo invoices found</td>
                        </tr>
                        @endforelse
                        <tr>
                            <td colspan="5">
                                <div class="float-right">
                                    {!! $invoices->links() !!}
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
