@php
    $baseUrl = config('app.baseUrl');
@endphp


@extends('layouts.master')
@section('title')
    <title>Đơn hàng của tôi</title>
@endsection

@section('css')
    <link href="{{asset('home/home.css')}}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{asset('home/home.js')}}" type="text/javascript"></script>
@endsection


@section('content')
    <div class="container">
        <h2>Lịch sử đơn hàng của tôi</h2>

        @if($invoices->isEmpty())
            <p>Bạn chưa có đơn hàng nào.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Ngày đặt hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Chi tiết</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->created_at->format('d/m/Y') }}</td>
                        <td>{{ number_format($invoice->total_amount) }} VND</td>
                        <td>{{ $invoice->status }}</td>
                        <td>
                            <a href="{{ route('orders.show', $invoice->id) }}" class="btn btn-info">Xem</a>
                            @if($invoice->status !== 'Đã xác nhận' && $invoice->status !== 'Đã hủy' && $invoice->status !== 'Đang giao' && $invoice->status !== 'Đã giao')
                                <form action="{{ route('orders.cancel', $invoice->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">Hủy</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
