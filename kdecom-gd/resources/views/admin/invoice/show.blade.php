@extends('layouts.admin')
@section('title')
    <title>Chi tiết đơn</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/product/index/listProd.css') }}" />
@endsection

@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'Danh sách','/','key'=>'Chi tiết đơn hàng'])

        <div class="container mt-4">
            <div class="card">
                <div class="card-header">
                    <h2>Chi tiết hóa đơn #{{ $invoice->id }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Ngày đặt:</strong> {{ $invoice->created_at->format('d/m/Y') }}</p>
                    <p><strong>Tên khách hàng:</strong> {{ $invoice->customer_name }}</p>
                    <p><strong>Điện thoại:</strong> {{ $invoice->phone }}</p>
                    <p><strong>Địa chỉ:</strong> {{ $invoice->address }}</p>
                    <p><strong>Trạng thái:</strong> {{ $invoice->status }}</p>
                    @php
                        $paymentMethod = $invoice->payment_type;
                        $paymentMethodName = $paymentMethod == 'cash' ? 'Thanh toán khi nhận hàng (COD)' : 'Thanh toán online';
                    @endphp
                    <p><strong>Phương thức thanh toán:</strong> {{ $paymentMethodName }}</p>
                    <p><strong>Tổng tiền:</strong> {{ number_format($invoice->total_amount, 2) }} VND</p>

                    <h3>Danh sách sản phẩm</h3>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice->details as $detail)
                            <tr>
                                <td>{{ $detail->product_name }}</td>
                                <td>{{ number_format($detail->unit_price, 2) }} VND</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ number_format($detail->subtotal, 2) }} VND</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <p class="font-weight-bold">Tổng cộng: {{ number_format($invoice->total_amount, 2) }} VND</p>

                    <!-- Form cập nhật trạng thái -->
                    <form action="{{ route('orders.update.status', $invoice->id) }}" method="POST" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="status">Cập nhật trạng thái:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="Đã xác nhận" {{ $invoice->status == 'Đã xác nhận' ? 'selected' : '' }}>Đã xác nhận</option>
                                <option value="Đang giao hàng" {{ $invoice->status == 'Đang giao hàng' ? 'selected' : '' }}>Đang giao hàng</option>
                                <option value="Đã giao" {{ $invoice->status == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
                                @if(!in_array($invoice->status, ['Đã xác nhận', 'Đã giao', 'Đang giao']))
                                    <option value="Đã hủy" {{ $invoice->status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật trạng thái</button>
                    </form>

                    @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="card-footer text-muted">
                    <p>Cảm ơn bạn đã mua sắm!</p>
                </div>
            </div>
        </div>
    </div>


@endsection
