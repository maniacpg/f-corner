@php
    $baseUrl = config('app.baseUrl');
@endphp


@extends('layouts.master')
@section('title')
    <title>Family Corner | Giỏ hàng</title>
@endsection

@section('css')
    <link href="{{asset('home/home.css')}}" rel="stylesheet">

@endsection

@section('js')
    <script src="{{asset('home/home.js')}}" type="text/javascript"></script>
@endsection


@section('content')

    <div class="container">
        <h2>Chi tiết hóa đơn</h2>
        <table class="table">
            <tr>
                <th>Tên khách hàng</th>
                <td>{{ $invoice->customer_name }}</td>
            </tr>
            <tr>
                <th>Số điện thoại</th>
                <td>{{ $invoice->phone }}</td>
            </tr>
            <tr>
                <th>Địa chỉ</th>
                <td>{{ $invoice->address }}</td>
            </tr>
            <tr>
                <th>Tổng tiền</th>
                <td>{{ number_format($invoice->total_amount) }} VND</td>
            </tr>
            <tr>
                <th>Trạng thái</th>
                <td>{{ $invoice->status }}</td>
            </tr>
        </table>

        <h3>Chi tiết sản phẩm</h3>
        <table class="table">
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
                    <td>{{ number_format($detail->unit_price) }} VND</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->subtotal) }} VND</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection


