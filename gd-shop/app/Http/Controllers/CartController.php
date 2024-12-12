<?php

namespace App\Http\Controllers;

use App\Events\NewOrderPlaced;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    private $category;
    private $product;

    public function __construct(Category $category, Product $product)
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function showCart()
    {
        $categoriesList = $this->category->where('parent_id', 0)->take(3)->get();

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (Auth::check()) {
            // Lấy giỏ hàng từ cơ sở dữ liệu
            $cartData = Cart::where('user_id', Auth::id())->first();
            $carts = $cartData ? json_decode($cartData->items, true) : [];

            // Kiểm tra giỏ hàng có rỗng không
            if (empty($carts)) {
                return redirect()->route('home')->with('warning', 'Bạn chưa thêm sản phẩm nào vào giỏ hàng!');
            }
        } else {
            // Nếu chưa đăng nhập, lấy giỏ hàng từ session
            $carts = session()->get('cart', []);

            // Kiểm tra giỏ hàng có rỗng không
            if (empty($carts)) {
                return redirect()->route('home')->with('warning', 'Bạn chưa thêm sản phẩm nào vào giỏ hàng!');
            }
        }

        // Tính tổng giá trị giỏ hàng
        $totalPrice = collect($carts)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('components.cart', compact('carts', 'categoriesList', 'totalPrice'));
    }

    public function getCount()
    {
        $cart = session()->get('cart', []);
        return response()->json(count($cart));
    }

    public function addToCart($id)
    {
        try {
            $product = Product::findOrFail($id);  // Sử dụng findOrFail để đảm bảo sản phẩm tồn tại
            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                // Cập nhật số lượng và tổng tiền cho sản phẩm đã có trong giỏ
                $cart[$id]['quantity']++;
            } else {
                // Thêm sản phẩm mới vào giỏ
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->feature_image_path,
                    'quantity' => 1,
                    'total' => $product->price,
                ];
            }

            // Cập nhật lại tổng tiền cho sản phẩm
            $cart[$id]['total'] = $cart[$id]['price'] * $cart[$id]['quantity'];

            session()->put('cart', $cart);

            // Nếu người dùng đã đăng nhập, lưu giỏ hàng vào DB
            if (Auth::check()) {
                // Lưu giỏ hàng vào cơ sở dữ liệu
                $this->saveCartToDatabase(Auth::id(), $cart);
            }

            // Tính tổng giá trị giỏ hàng
            $totalPrice = collect($cart)->sum('total');

            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng.',
                'totalPrice' => number_format($totalPrice),
                'cartCount' => count($cart),
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm vào giỏ hàng: ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra, vui lòng thử lại!'], 500);
        }
    }

    private function saveCartToDatabase($userId, $cart)
    {
        // Kiểm tra xem giỏ hàng đã tồn tại cho người dùng này chưa
        $existingCart = Cart::where('user_id', $userId)->first();

        // Chuyển đổi giỏ hàng thành JSON
        $cartData = json_encode($cart);

        if ($existingCart) {
            // Nếu giỏ hàng đã tồn tại, cập nhật giỏ hàng
            $existingCart->items = $cartData;
            $existingCart->save();
        } else {
            // Nếu không tồn tại, tạo mới giỏ hàng
            Cart::create([
                'user_id' => $userId,
                'items' => $cartData,
            ]);
        }
    }

    public function updateCart(Request $request, $id)
    {
        try {
            // Kiểm tra xem người dùng đã đăng nhập chưa
            if (Auth::check()) {
                // Lấy giỏ hàng từ cơ sở dữ liệu
                $cartData = Cart::where('user_id', Auth::id())->first();
                $carts = $cartData ? json_decode($cartData->items, true) : [];

                if (isset($carts[$id])) {
                    $quantity = $request->input('quantity', 1); // Mặc định là 1 nếu không có giá trị
                    $carts[$id]['quantity'] = $quantity;
                    $carts[$id]['total'] = $carts[$id]['price'] * $quantity;

                    // Cập nhật giỏ hàng trong cơ sở dữ liệu
                    $cartData->items = json_encode($carts);
                    $cartData->save();

                    $totalPrice = collect($carts)->sum('total');

                    return response()->json([
                        'code' => 200,
                        'message' => 'Cập nhật giỏ hàng thành công',
                        'data' => [
                            'cartTotal' => number_format($carts[$id]['total']) . ' VNĐ',
                            'totalPrice' => number_format($totalPrice) . ' VNĐ',
                            'quantity' => $carts[$id]['quantity'],
                        ],
                    ]);
                }

                return response()->json(['code' => 500, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng'], 500);
            } else {
                // Nếu chưa đăng nhập, cập nhật giỏ hàng trong session
                $cart = session()->get('cart');

                if (isset($cart[$id])) {
                    $quantity = $request->input('quantity', 1); // Mặc định là 1 nếu không có giá trị
                    $cart[$id]['quantity'] = $quantity;
                    $cart[$id]['total'] = $cart[$id]['price'] * $quantity;

                    session()->put('cart', $cart);

                    $totalPrice = collect($cart)->sum('total');

                    return response()->json([
                        'code' => 200,
                        'message' => 'Cập nhật giỏ hàng thành công',
                        'data' => [
                            'cartTotal' => number_format($cart[$id]['total']) . ' VNĐ',
                            'totalPrice' => number_format($totalPrice) . ' VNĐ',
                            'quantity' => $cart[$id]['quantity'],
                        ],
                    ]);
                }

                return response()->json(['code' => 500, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Lỗi cập nhật giỏ hàng: ' . $e->getMessage());
            return response()->json(['code' => 500, 'message' => 'Có lỗi xảy ra khi cập nhật giỏ hàng'], 500);
        }
    }

    public function remove($id)
    {
        try {
            if (Auth::check()) {
                // Lấy giỏ hàng từ cơ sở dữ liệu
                $cartData = Cart::where('user_id', Auth::id())->first();
                $carts = $cartData ? json_decode($cartData->items, true) : [];

                // Xóa sản phẩm khỏi giỏ hàng trong cơ sở dữ liệu
                if (isset($carts[$id])) {
                    unset($carts[$id]);
                    $cartData->items = json_encode($carts);
                    $cartData->save();

                    // Cập nhật session (nếu giỏ hàng cũng được lưu trong session)
                    $sessionCart = session('cart', []);
                    if (isset($sessionCart[$id])) {
                        unset($sessionCart[$id]);
                        session(['cart' => $sessionCart]);
                    }

                    // Tính lại tổng giá trị giỏ hàng và số lượng sản phẩm còn lại
                    $totalPrice = collect($carts)->sum('total');
                    $cartCount = count($carts);

                    return response()->json([
                        'code' => 200,
                        'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng',
                        'totalPrice' => number_format($totalPrice) . ' VNĐ',
                        'cartCount' => $cartCount,
                    ]);
                }

                return response()->json(['code' => 500, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng'], 500);
            }  else {
                // Nếu chưa đăng nhập, xóa sản phẩm trong session
                $cart = session()->get('cart');

                if (isset($cart[$id])) {
                    unset($cart[$id]);
                    session()->put('cart', $cart);

                    // Tính lại tổng giá trị giỏ hàng
                    $totalPrice = collect($cart)->sum('total');

                    return response()->json([
                        'code' => 200,
                        'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng',
                        'totalPrice' => number_format($totalPrice) . ' VNĐ',
                        'cartCount' => count($cart),
                    ]);
                }

                return response()->json(['code' => 500, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa sản phẩm khỏi giỏ hàng: ' . $e->getMessage());
            return response()->json(['code' => 500, 'message' => 'Có lỗi xảy ra khi xóa sản phẩm khỏi giỏ hàng'], 500);
        }
    }
    public function confirmOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:191',
            'payment_type' => 'required|in:cash,online',
        ]);

        $carts = $request->session()->get('cart', []);

        if (empty($carts)) {
            return response()->json(['success' => false, 'message' => 'Giỏ hàng trống.'], 400);
        }

        try {
            DB::beginTransaction();

            $totalAmount = collect($carts)->sum('total');

            $userId = Auth::check() ? Auth::id() : null;

            // Tạo hóa đơn
            $invoice = Invoice::create([
                'customer_name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'total_amount' => $totalAmount,
                'status' => 'Đã đặt', // Trạng thái mới khi tạo hóa đơn
                'payment_type' => $request->payment_type,
                'user_id' => $userId,
            ]);

            // Lưu chi tiết hóa đơn
            $invoiceDetails = [];
            foreach ($carts as $id => $cartItem) {
                $invoiceDetails[] = [
                    'invoice_id' => $invoice->id,
                    'product_id' => $id,
                    'product_name' => $cartItem['name'],
                    'unit_price' => $cartItem['price'],
                    'quantity' => $cartItem['quantity'],
                    'subtotal' => $cartItem['total'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Trừ số lượng sản phẩm
                $product = Product::find($id);
                if ($product) {
                    if ($product->quantity >= $cartItem['quantity']) {
                        $product->quantity -= $cartItem['quantity'];
                        $product->save();
                    } else {
                        DB::rollBack(); // Rollback giao dịch
                        return response()->json(['success' => false, 'message' => 'Số lượng sản phẩm không đủ cho sản phẩm: ' . $product->name], 400);
                    }
                }
            }

            // Lưu chi tiết hóa đơn
            InvoiceDetail::insert($invoiceDetails);
            session()->forget('cart');
            DB::commit();

            // Xử lý thanh toán online
            if ($request->payment_type === 'online') {
                try {
                    return $this->handleOnlinePayment($totalAmount, $invoice->id);
                } catch (\Exception $e) {
                    Log::error('Lỗi trong xử lý thanh toán online: ' . $e->getMessage());
                    return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra khi xử lý thanh toán online.'], 500);
                }
            }

            return response()->json(['success' => true, 'message' => 'Đơn hàng đã được xác nhận.', 'invoice_id' => $invoice->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi xác nhận đơn hàng: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra khi xác nhận đơn hàng.'], 500);
        }
    }

    private function handleOnlinePayment($totalAmount, $invoiceId)
    {
        $vnp_TmnCode = "1GC2SXVC";
        $vnp_HashSecret = "HVYI8QNBZN3TZH11CVZQAGLKBAK58DXY";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_ReturnUrl = route('orders.index');
        $vnp_TransactionNo = time();

        $data = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,

            "vnp_Amount" => $totalAmount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => request()->ip(),
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => "Thanh toán đơn hàng #" . $invoiceId,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TransactionNo" => $vnp_TransactionNo,
        ];

        ksort($data);
        $query = http_build_query($data);
        $signature = hash_hmac('sha256', $query, $vnp_HashSecret);
        $paymentUrl = $vnp_Url . "?" . $query . '&vnp_SecureHash=' . $signature;
        Log::info('Dữ liệu gửi đến VNPay: ', $data);
        return response()->json(['success' => true, 'message' => 'Chuyển hướng đến VNPay để thanh toán.', 'payment_url' => $paymentUrl]);
    }

    public function invoiceShow($id)
    {
        $invoice = Invoice::findOrFail($id);

        return view('components.invoicesDetail', compact('invoice'));
    }

    public function getNewOrdersCount()
    {
        $newOrdersCount = Invoice::where('status', 'new')->count();
        return response()->json(['newOrdersCount' => $newOrdersCount]);
    }

}
