<h2 class="title text-center">Sản phẩm</h2>
<div class="features_items">
    @foreach($products as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{ $baseUrl . $product->feature_image_path }}" alt=""/>
                        <h2>{{ number_format($product->price) }} VND</h2>
                        <p>{{ $product->name }}</p>

                        @if ($product->quantity > 0)
                            <p class="text-success">Còn lại: {{ $product->quantity }}</p>
                            <button class="btn btn-default add-to-cart"
                                    data-id="{{ $product->id }}"
                                    data-url="{{ route('cart.add', ['id' => $product->id]) }}"
                                    data-token="{{ csrf_token() }}">
                                <i class="fa fa-shopping-cart"></i>
                                Add to cart
                            </button>
                        @else
                            <p class="text-danger">Hết hàng</p>
                            <button class="btn btn-default add-to-cart" disabled>
                                <i class="fa fa-shopping-cart"></i>
                                Hết hàng
                            </button>
                        @endif
                    </div>
                    <a href="{{route('product.details', ['id'=>$product->id])}}">
                        <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>{{ number_format($product->price) }} VND</h2>
                                <p>{{ $product->name }}</p>

                                @if ($product->quantity > 0)
                                    <button class="btn btn-default add-to-cart"
                                            data-id="{{ $product->id }}"
                                            data-url="{{ route('cart.add', ['id' => $product->id]) }}"
                                            data-token="{{ csrf_token() }}">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </button>
                                @else
                                    <button class="btn btn-default add-to-cart" disabled>
                                        <i class="fa fa-shopping-cart"></i>
                                        Hết hàng
                                    </button>
                                @endif
                            </div>
                        </div>
                    </a>

                </div>

                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>

<style>
    /* Bạn có thể thêm CSS tùy chỉnh ở đây nếu cần */
</style>


    <script>
        $(document).on('click', '.add-to-cart', function() {
        var productId = $(this).data('id');
        var url = $(this).data('url');
        var token = $(this).data('token');

        $.ajax({
        type: "POST",
        url: url,
        data: {
        _token: token,
        // Nếu bạn cần thêm thông tin khác, có thể thêm vào đây
    },
        success: function(response) {
        if (response.code === 200) {
        alert(response.message);

        // Cập nhật số lượng sản phẩm trong giỏ hàng
        var currentCount = parseInt($('#cart-count').text());
        $('#cart-count').text(currentCount + 1);
    } else {
        alert(response.message);
    }
    },
        error: function(xhr) {
        console.error(xhr.responseText);
        alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng');
    }
    });
    });
</script>
