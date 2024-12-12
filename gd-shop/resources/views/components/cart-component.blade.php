

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Giỏ hàng</li>
            </ol>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="image">Ảnh</td>
                    <td class="description">Sản phẩm</td>
                    <td class="price">Đơn giá</td>
                    <td class="quantity">Số lượng</td>
                    <td class="total">Thành tiền</td>
                    <td class="action">Action</td>
                </tr>
                </thead>
                <tbody>
                @php
                    $totalPrices = 0;
                @endphp
                @foreach($carts as $id => $cartItem)
                    @php
                        $totalPrices += $cartItem['price'] * $cartItem['quantity'];
                    @endphp
                    <tr data-id="{{ $id }}" class="cart_item">
                        <td class="cart_product">
                            <a href=""><img style="width: 100px; height: 100px; object-fit: cover" src="{{$baseUrl.$cartItem['image']}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$cartItem['name']}}</a></h4>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($cartItem['price'])}} VND</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <input class="cart_quantity_input" type="number" name="quantity" value="{{$cartItem['quantity']}}" autocomplete="off" size="2">
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($cartItem['price'] * $cartItem['quantity'])}} VND</p>
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="btn btn-success cart_update" data-id="{{ $id }}" data-url="{{ route('cart.update', ['id' => $id]) }}">Cập nhật</a>
                            <a href="javascript:void(0);" class="btn btn-danger cart_remove" data-url="{{ route('cart.remove', ['id' => $id]) }}">Xóa</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="col-md-12 total-cart-all" style="font-family: 'Roboto', sans-serif; font-size: 24px; color: #843534; font-weight: bold; text-align: right; margin-top: 20px;">
                Tổng tiền: <span id="total-price">{{ number_format($totalPrices) }} VND</span>
            </div>
        </div>
    </div>
</section>

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Please provide your information below to complete the checkout process.</p>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="chose_area">
                    <ul class="user_option">
                        <li class="single_field">
                            <label for="name">Tên:</label>
                            <input type="text" id="name" placeholder="Nhập tên bạn" required value="{{ Auth::check() ? Auth::user()->name : '' }}">
                        </li>
                        <li class="single_field">
                            <label for="phone">Số điện thoại:</label>
                            <input type="text" id="phone" placeholder="Nhập số điện thoại" required value="{{ Auth::check() ? Auth::user()->phone : '' }}">
                        </li>
                        <li class="single_field">
                            <label for="address">Địa chỉ:</label>
                            <input type="text" id="address" placeholder="Nhập địa chỉ" required value="{{ Auth::check() ? Auth::user()->address : '' }}">
                        </li>
                        <li class="single_field">
                            <label for="payment_method">Phương thức thanh toán:</label>
                            <select id="payment_method" required>
                                <option value="cash">Thanh toán khi nhận hàng (COD)</option>
                                <option value="online">Thanh toán online</option>
                            </select>
                        </li>
                    </ul>

                    <a class="btn btn-default check_out" id="checkout-btn" href="javascript:void(0);">Xác nhận</a>
                    <a class="btn btn-default check_out" id="checkout-btn" href="{{ url('/') }}">Tiếp tục mua hàng</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#checkout-btn').on('click', function(e) {
        e.preventDefault();

        // Collect form data
        var name = $('#name').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var paymentMethod = $('#payment_method').val();  // Get the payment method

        // Validate required fields
        if (!name || !phone || !address) {
            alert('Vui lòng điền đầy đủ thông tin.');
            return;
        }

        // Call the confirm order endpoint
        $.ajax({
            url: '{{ route("cart.confirm-order") }}', // Route to confirm order
            method: 'post',
            data: {
                name: name,
                phone: phone,
                address: address,
                payment_type: paymentMethod,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    if (response.payment_url) {
                        // Chuyển hướng đến VNPay
                        window.location.href = response.payment_url;
                    } else {
                        // Chuyển hướng đến view invoicesDetail
                        window.location.href = '{{ route("invoicesDetail", ["id" => "__invoice_id__"]) }}'.replace('__invoice_id__', response.invoice_id);
                    }
                } else {
                    alert(response.message || 'Có lỗi xảy ra khi xác nhận đơn hàng.');
                }
            },
            error: function(xhr) {
                var errorMessage = xhr.responseJSON.message || 'Có lỗi xảy ra';
                alert(errorMessage);
            }
        });
    });

    // Gắn sự kiện click cho các nút cập nhật và xóa
    $(document).on('click', '.cart_update', function(event) {
        let urlUpdateCart = $(this).data('url');
        let quantityInput = $(this).closest('tr').find('.cart_quantity_input');
        let quantity = quantityInput.val();

        // Validate quantity
        if (quantity <= 0) {
            alert('Số lượng phải lớn hơn 0.');
            return;
        }

        $.ajax({
            type: "POST",
            url: urlUpdateCart,
            data: {
                quantity: quantity,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.code === 200) {
                    // Cập nhật lại thành tiền
                    let totalPrice = response.data.totalPrice;
                    $('#total-price,.cart_total_price').text(totalPrice);
                    // Cập nhật giá trị trong giỏ hàng
                    quantityInput.val(response.data.quantity);
                    $(this).closest('tr').find('.cart_total_price').text(response.data.cartTotal);

                } else {
                    alert(response.message || 'Có lỗi xảy ra khi cập nhật giỏ hàng');
                }
            },
            error: function(xhr) {
                alert('Có lỗi xảy ra khi cập nhật giỏ hàng: ' + (xhr.responseJSON ? xhr.responseJSON.message : 'Lỗi không xác định'));
            }
        });
    });

    $(document).on('click', '.cart_remove', function(event) {
        let urlRemoveCart = $(this).data('url');

        if (confirm("Bạn có chắc muốn xóa sản phẩm này?")) {
            $.ajax({
                type: "GET",
                url: urlRemoveCart,
                success: function(response) {
                    if (response.code === 200) {
                        location.reload();
                    } else {
                        alert(response.message || 'Có lỗi xảy ra khi xóa sản phẩm');
                    }
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra khi xóa sản phẩm: ' + (xhr.responseJSON ? xhr.responseJSON.message : 'Lỗi không xác định'));
                }
            });
        }
    });
</script>


<style>
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .cart_menu {
        background-color: #FE980F;
        color: #fff;
    }
    .cart_menu td {
        padding: 15px 10px;
        font-weight: bold;
        vertical-align: middle;
    }
    .image, .cart_product { width: 150px; }
    .description, .cart_description { width: 35%; }
    .price, .cart_price { width: 10%; text-align: center; }
    .quantity, .cart_quantity { width: 10%; text-align: center; }
    .total, .cart_total { width: 10%; text-align: right; }
    .action { width: 20%; text-align: center; }
    .cart_action { text-align: center; }
    .cart_product img { width: 100px; height: 100px; object-fit: cover; }
    .cart_description h4 { margin: 0; padding: 0; }
    .cart_description h4 a { color: #363432; text-decoration: none; }
    .cart_price p, .cart_total p { color: #FE980F; font-size: 18px; margin: 0; }
    .cart_quantity_button { display: flex; align-items: center; justify-content: center; gap: 5px; }
    .cart_quantity_input { width: 50px; height: 30px; text-align: center; border: 1px solid #ddd; }
    tbody tr { border-bottom: 1px solid #F7F7F0; }
    tbody tr td { padding: 15px 10px; vertical-align: middle; text-align: center; }
</style>

<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


