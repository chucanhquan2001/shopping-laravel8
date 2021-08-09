<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceDetail;

class InvoiceController extends Controller
{
    public function index()
    {
        $data = Invoice::orderBy('status', 'asc')->get();
        return view('admin.invoices.index', compact('data'));
    }

    public function invoiceDetail($invoice_id)
    {
        $data = InvoiceDetail::where('invoice_id', $invoice_id)->get();
        $dataInvoice = Invoice::find($invoice_id);
        return view('admin.invoices.detail', compact('data', 'dataInvoice', 'invoice_id'));
    }

    public function update($id, Request $request)
    {
        $data = Invoice::find($id);
        $data->update([
            'status' => $request->status,
            'user_id_admin' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Updated !');
    }
}