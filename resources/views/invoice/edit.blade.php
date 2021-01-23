@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-capitalize">
                <h3 class="d-inline-block">edit invoice</h3>
                <a href="{{ route('invoices.index') }}" class="btn btn-primary float-right"><i class="fa fa-home"></i>back to home</a>
            </div>
            <div class="card-body">
                <?php
                    $invoiceFields = ['customer_name','customer_email','customer_mobile','company_name','invoice_number','invoice_date'];
                    $invoiceDataFields = ['product_name','unit','quantity','unit_price','row_sub_total'];
                ?>

                <form action="{{ route('invoices.update', ['invoice'=>$invoice->id]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        @foreach ($invoiceFields as $index=>$field)
                        <div class="col-md-4 col-sm-12 mb-2">
                            <div class="form-groub">
                                <label for="{{ $field }}" class="text-capitalize">@lang('site.' . $field) :</label>
                                <input type="text" name="{{ $field }}" value="{{ old($field,$invoice->$field) }}" id="{{ $field }}" class="form-control {{ $field=='invoice_date'? 'pickadate' : '' }}" {{ $index==5? 'readable' : '' }}>
                                @error($field) <span class="help-block text-danger">{{ $massage }}</span> @enderror
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="form-groub">
                                <table class="table table-hover text-nowrap" id="invoice_details">
                                    <thead>
                                        <tr class="text-capitalize">
                                            <th></th>
                                            @foreach ($invoiceDataFields as $field)
                                            <th>@lang('site.' .  $field)</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoice->details as $index=>$detail)
                                        <tr class="cloning_row" id="{{$index}}">
                                            <td>@if ($index==0) # @else
                                                <button type='button' class='btn btn-danger btn-sm btn_delete'>
                                                <i class='fa fa-minus'></i></button>
                                            @endif</td>
                                            <td>
                                                <input type="text" name="product_name[{{$index}}]" value="{{old('product_name',$detail->product_name)}}" class="product_name form-control">
                                            <td>
                                                <select name="unit[{{$index}}]" value="{{old('unit',$detail->unit)}}" class="unit form-control">
                                                    <option></option>
                                                    <option value="piece" {{old('unit',$detail->unit)== 'piece'? 'selected' : ''}}>piece</option>
                                                    <option value="g" {{old('unit',$detail->unit)== 'g'? 'selected' : ''}}>gram</option>
                                                    <option value="kg" {{old('unit',$detail->unit)== 'kg'? 'selected' : ''}}>kilo gram</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="quantity[{{$index}}]" value="{{old('quantity',$detail->quantity)}}" class="quantity form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="unit_price[{{$index}}]" value="{{old('unit_price',$detail->unit_price)}}" class="unit_price form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="row_sub_total[{{$index}}]" value="{{old('row_sub_total',$detail->row_sub_total)}}" readonly class="row_sub_total form-control">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="text-capitalize">
                                        <tr>
                                            <td colspan="6">
                                                <button type="button" class="btn_add btn btn-primary"><i class="fa fa-plus"></i>add another product</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2"><label for="sub_total"> sub total</label></td>
                                            <td><input type="text" name="sub_total" value="{{ old('sub_total',$invoice->sub_total) }}" id="sub_total" class="sub_total form-control" readonly></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2"><label for="discount_type"> discount</label></td>
                                            <td>
                                                <div class="input-group mb-3">
                                                    <select name="discount_type" id="discount_type" class="discount_type custom-select">
                                                        <option value="fixed" {{old('discount_type',$invoice->discount_type)== 'fixed'? 'selected' : ''}}>SR</option>
                                                        <option value="percentage" {{old('discount_type',$invoice->discount_type)== 'percentage'? 'selected' : ''}}>percentage</option>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <input type="text" name="discount_value" value="{{ old('discount_value',$invoice->discount_value) }}" id="discount_value" class="discount_value form-control">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2"><label for="vat_value">vat (5%)</label></td>
                                            <td><input type="text" name="vat_value" value="{{ old('vat_value',$invoice->vat_value) }}" id="vat_value" class="vat_value form-control" readonly></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2"><label for="shipping">shipping</label></td>
                                            <td><input type="text" name="shipping" value="{{ old('shipping',$invoice->shipping) }}" id="shipping" class="shipping form-control"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2"><label for="total_due">total due</label></td>
                                            <td><input type="text" name="total_due" value="{{ old('total_due',$invoice->total_due) }}" id="total_due" class="total_due form-control" readonly></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="text-right pt-3">
                                <button type="submit" name="save" class="btn btn-primary">save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('pickadate.js-3.6.2/lib/picker.js') }}"></script>
<script src="{{ asset('pickadate.js-3.6.2/lib/picker.date.js') }}"></script>
<script src="{{ asset('jquery-validation-1.19.3/lib/jquery.form.js') }}"></script>
<script src="{{ asset('jquery-validation-1.19.3/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('jquery-validation-1.19.3/dist/additional-methods.min.js') }}"></script>
@if (config('app.locale') == 'ar')
<script src="{{ asset('pickadate.js-3.6.2/lib/translations/ar.js') }}"></script>
<script src="{{ asset('jquery-validation-1.19.3/dist/localization/messages_ar.min.js') }}"></script>
@endif
<script src="{{ asset('js/custom.js') }}"></script>
@endsection
