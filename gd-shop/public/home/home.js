$(document).ready(function () {
    // Tùy chọn cho carousel
    $('#slider-carousel').carousel({
        interval: 5000, // Thay đổi slide mỗi 5 giây
        pause: "hover" // Dừng khi di chuột vào carousel
    });

    // Bắt sự kiện khi chuyển slide
    $('#slider-carousel').on('slide.bs.carousel', function () {
        console.log('Slide is changing');
    });

    // Bắt sự kiện khi slide đã chuyển
    $('#slider-carousel').on('slid.bs.carousel', function () {
        console.log('Slide has changed');
    });
});

//them san pham vao gio hang
function addToCart(event) {
    event.preventDefault();
    let urlCart = $(event.currentTarget).data('url');

    console.log('URL Cart:', urlCart);

    if (!urlCart) {
        alert('URL không hợp lệ');
        return;
    }

    $.ajax({
        type: 'POST', // Đảm bảo sử dụng POST
        url: urlCart,
        data: {
            _token: '{{ csrf_token() }}', // Thêm CSRF token
        },
        dataType: 'json',
        success: function (data) {
            if (data.code === 200) {
                alert('Thêm vào giỏ hàng thành công!');
                $('#cart-count').text(data.cartCount); // Cập nhật số lượng giỏ hàng
            } else {
                alert('Có lỗi xảy ra: ' + (data.message || 'Vui lòng thử lại.'));
            }
        },
        error: function (xhr) {
            console.error('Error:', xhr.responseText);
        }
    });
}
$(function () {
    $('.add-to-cart').on('click', addToCart);
})




