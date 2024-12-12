/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */


import Pusher from 'pusher-js';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

// Khởi tạo Pusher với các thông số kết nối
const pusher = new Pusher('6ef574ea52bab3ec4c8c', {
    cluster: 'ap1',
    encrypted: true // Sử dụng kết nối an toàn
});

// Kết nối đến channel cụ thể
const channel = pusher.subscribe('orders');

// Lắng nghe sự kiện
channel.bind('new-order', function(data) {
    // Xử lý thông báo khi có đơn hàng mới
    toastr.success(`Đơn hàng mới: #${data.order.id}`);

    // Cập nhật danh sách đơn hàng
    const orderList = document.getElementById('order-list');
    const newItem = document.createElement('li');
    newItem.textContent = `Order #${data.order.id}: ${data.order.name} - ${data.order.total}`;
    orderList.appendChild(newItem);
});

// Xử lý lỗi kết nối
pusher.connection.bind('error', function(err) {
    console.error('Lỗi kết nối Pusher:', err);
    toastr.error('Không thể kết nối đến máy chủ thông báo');
});
