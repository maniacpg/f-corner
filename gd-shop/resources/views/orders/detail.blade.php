@php
    $baseUrl = config('app.baseUrl');
@endphp


@extends('layouts.master')
@section('title')
    <title>Chi tiết hóa đơn</title>
@endsection

@section('css')
    <link href="{{asset('home/home.css')}}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{asset('home/home.js')}}" type="text/javascript"></script>
@endsection


@section('content')
    <div class="container mt-4">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Chi tiết hóa đơn #{{ $invoice->id }}</h2>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">

                        <p><strong>Tên khách hàng:</strong> {{ $invoice->customer_name }}</p>
                        <p><strong>Điện thoại:</strong> {{ $invoice->phone }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $invoice->address }}</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p><strong>Ngày đặt:</strong> {{ $invoice->created_at->format('d/m/Y') }}</p>
                        <p><strong>Trạng thái:</strong> {{ $invoice->status }}</p>

                    </div>
                </div>

                @php
                    $paymentMethod = $invoice->payment_type;
                    $paymentMethodName = $paymentMethod == 'cash' ? 'Thanh toán khi nhận hàng (COD)' : 'Thanh toán online';
                @endphp
                <p><strong>Phương thức thanh toán:</strong> {{ $paymentMethodName }}</p>
                <h3>Danh sách sản phẩm</h3>
                <table class="table table-bordered">
                    <thead class="thead-light">
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
                <p class="font-weight-bold" style="text-align: right; font-weight: bold;font-size: 25px">Tổng cộng: {{ number_format($invoice->total_amount, 2) }} VND</p>
            </div>

        </div>
        <div class="card-footer text-muted">
            <p class="mb-0" style="text-align: center;font-size: 20px">Cảm ơn bạn đã mua sắm!</p>
        </div>
    </div>
@endsection

