<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;

class AdminInvoiceController extends Controller
{
    private $invoice;

    public function __construct(Invoice $invoice, InvoiceDetail $invoiceDetail)
    {
        $this->invoice = $invoice;
        $this->invoiceDetail = $invoiceDetail;
    }

    public function index()
    {
        $invoices = $this->invoice->latest()->paginate(10);
        return view('admin.invoice.index', compact('invoices'));
    }

    public function getNewOrdersCount()
    {
        $newOrdersCount = Invoice::where('status', 'Đã đặt')->count();
        return response()->json(['newOrdersCount' => $newOrdersCount]);
    }

    public function confirm($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->status = 'Đã xác nhận'; // Cập nhật trạng thái
        $invoice->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được xác nhận.');
    }

    public function cancel($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->status = 'Đã hủy'; // Cập nhật trạng thái
        $invoice->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được hủy.');
    }

    public function show($id)
    {
        $invoice = Invoice::with('details')->findOrFail($id);

        return view('admin.invoice.show', compact('invoice'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $invoice = Invoice::findOrFail($id);
        $invoice->status = $request->status; // Cập nhật trạng thái
        $invoice->save();

        return redirect()->route('orders.show', $id)->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }
}
