<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\alert;

class OrderController extends Controller
{
    public function myOrder()
    {
        $invoices = Invoice::where('user_id', Auth::id())->get();
        return view('orders.index', compact('invoices'));
    }
    public function show($id)
    {
        $invoice = Invoice::with('details')->findOrFail($id); // Tìm hóa đơn theo ID

        return view('orders.detail', compact('invoice'));
    }
    public function cancel($id)
    {
        // Tìm hóa đơn theo ID
        $invoice = Invoice::with('details')->findOrFail($id);

        // Kiểm tra trạng thái đơn hàng
        if (in_array($invoice->status, ['Đã xác nhận', 'Đang giao', 'Đã giao', 'Đã hủy'])) {
            return response()->json(['success' => false, 'message' => 'Không thể hủy đơn hàng trong trạng thái này.'], 400);
        }

        // Cập nhật trạng thái đơn hàng
        $invoice->status = 'Đã hủy';
        $invoice->save();

        // Cập nhật số lượng sản phẩm trong kho
        foreach ($invoice->details as $detail) {
            $product = Product::find($detail->product_id);
            if ($product) {
                $product->quantity += $detail->quantity; // Cộng số lượng sản phẩm
                $product->save(); // Lưu thay đổi
            }
        }

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được hủy và số lượng sản phẩm đã được cập nhật.');
    }
}
