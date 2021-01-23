<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = Invoice::paginate();
        return view('invoice.index',compact('invoices'));
    }


    public function create()
    {
        return view('invoice.create');
    }


    public function store(Request $request)
    {
        $data = [
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_mobile' => $request->customer_mobile,
            'company_name' => $request->company_name,
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'sub_total' => $request->sub_total,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'vat_value' => $request->vat_value,
            'shipping' => $request->shipping,
            'total_due' => $request->total_due,
        ];

        $invoice = Invoice::create($data);

        $details_list = [];

        for ($i=0; $i < count($request->product_name) ; $i++) {
            $details_list[$i] = [
                'product_name' => $request->product_name[$i],
                'unit' => $request->unit[$i],
                'quantity' => $request->quantity[$i],
                'unit_price' => $request->unit_price[$i],
                'row_sub_total' => $request->row_sub_total[$i]
            ];
        }

        $details = $invoice->details()->createMany($details_list);

        if ($details) {
            return redirect()->route('invoices.index')->with([
                'massage' => 'invoice created successfully',
                'alert' => 'success'
            ]);
        }else{
            return redirect()->back()->with([
                'massage' => 'something wrong happend',
                'alert' => 'danger'
            ]);
        }
    }

    public function print(Invoice $invoice)
    {
        return view('invoice.print',compact('invoice'));
    }

    public function pdf(Invoice $invoice)
    {
        $data = $invoice->toArray();
        $data['details'] = $invoice->details->toArray();
		$pdf = PDF::loadView('invoice.pdf', $data);
		return $pdf->stream($invoice->invoice_number . '.pdf');
    }


    public function show(Invoice $invoice)
    {
        return view('invoice.show',compact('invoice'));
    }


    public function edit(Invoice $invoice)
    {
        return view('invoice.edit',compact('invoice'));
    }


    public function update(Request $request, Invoice $invoice)
    {
        $data = [
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_mobile' => $request->customer_mobile,
            'company_name' => $request->company_name,
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'sub_total' => $request->sub_total,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'vat_value' => $request->vat_value,
            'shipping' => $request->shipping,
            'total_due' => $request->total_due,
        ];

        $invoice->update($data);
        $invoice->details()->delete();

        $details_list = [];

        for ($i=0; $i < count($request->product_name) ; $i++) {
            $details_list[$i] = [
                'product_name' => $request->product_name[$i],
                'unit' => $request->unit[$i],
                'quantity' => $request->quantity[$i],
                'unit_price' => $request->unit_price[$i],
                'row_sub_total' => $request->row_sub_total[$i]
            ];
        }

        $details = $invoice->details()->createMany($details_list);

        if ($details) {
            return redirect()->route('invoices.index')->with([
                'massage' => 'invoice updated successfully',
                'alert' => 'success'
            ]);
        }else{
            return redirect()->back()->with([
                'massage' => 'something wrong happend',
                'alert' => 'danger'
            ]);
        }
    }


    public function destroy(Invoice $invoice)
    {
        if ($invoice) {
            $invoice->delete();
            return redirect()->route('invoices.index')->with([
                'massage' => 'invoice deleted successfully',
                'alert' => 'success'
            ]);
        }else{
            return redirect()->back()->with([
                'massage' => 'something wrong happend',
                'alert' => 'danger'
            ]);
        }
    }
}
