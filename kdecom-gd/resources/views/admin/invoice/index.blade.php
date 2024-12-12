@extends('layouts.admin')
@section('title')
    <title>Đơn hàng</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/product/index/listProd.css') }}" />
@endsection
@section('js')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="{{ asset('vendor/SweetAlert/sweetalert2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
    <script>
        // Cấu hình Pusher
        const pusher = new Pusher('{{ env('6ef574ea52bab3ec4c8c') }}', {
            cluster: '{{ env('ap1') }}',
            forceTLS: true,
            disableStats: true,
            wsPort: 443,
            disableProtocolChecks: true
        });

        // Kết nối kênh đơn hàng
        const channel = pusher.subscribe('orders');

        // Lắng nghe sự kiện đơn hàng mới
        channel.bind('new-order', function(data) {
            // Thêm đơn hàng mới vào đầu danh sách
            const orderList = document.querySelector('tbody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
               <th scope="row">${data.order.id}</th>
               <td>${data.order.customer_name}</td>
               <td>${data.order.phone}</td>
               <td>${data.order.address}</td>
               <td>${new Intl.NumberFormat('vi-VN').format(data.order.total_amount)} VND</td>
               <td>
                   <a href="" class="btn btn-default">Detail</a>
                   <a href="" data-url="" class="btn btn-danger action_del">Cancel</a>
               </td>
           `;

            // Chèn hàng mới vào đầu bảng
            orderList.insertBefore(newRow, orderList.firstChild);

            // Hiển thị thông báo
            Swal.fire({
                icon: 'success',
                title: 'Đơn hàng mới',
                text: `Đơn hàng #${data.order.id} vừa được tạo`,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        });
    </script>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'Danh sách','/','key'=>'Đơn hàng'])

        <div class="container mt-4">
            @if(session('success'))
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h2>Danh sách đơn hàng</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Tổng giá trị</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <th scope="row">{{ $invoice->id }}</th>
                                <td>{{ $invoice->customer_name }}</td>
                                <td>{{ $invoice->phone }}</td>
                                <td>{{ $invoice->address }}</td>
                                <td>{{ number_format($invoice->total_amount) }} VND</td>
                                <td>{{ $invoice->status }}</td>
                                <td>
                                    <form action="{{ route('orders.confirm', $invoice->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Xác nhận</button>
                                    </form>
                                    @if(!in_array($invoice->status, ['Đã xác nhận', 'Đã giao', 'Đang giao']))
                                        <form action="{{ route('orders.cancel', $invoice->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Hủy</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('orders.show', $invoice->id) }}" class="btn btn-default">Xem</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $invoices->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        <script>
            // Kiểm tra xem có thông báo nào không
            document.addEventListener("DOMContentLoaded", function() {
                var alert = document.getElementById("success-alert");
                if (alert) {
                    // Ẩn thông báo sau 5 giây (5000 ms)
                    setTimeout(function() {
                        alert.style.display = 'none';
                    }, 5000);
                }
            });
        </script>
    </div>
@endsection
