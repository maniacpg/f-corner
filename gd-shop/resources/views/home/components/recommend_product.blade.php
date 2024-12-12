<h2 class="title text-center">Sản phẩm nổi bật</h2>
<div class="recommended_items">
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($productRecommends as $keyRecommend => $productRecommend)
                @if($keyRecommend % 3 == 0)
                    <div class="item {{$keyRecommend == 0 ? 'active' : ''}}">
                        @endif
                        <div class="col-sm-4">
                            <a href="{{route('product.details', ['id'=>$productRecommend->id])}}">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ config('app.baseUrl') . $productRecommend->feature_image_path }}" alt=""/>
                                            <h2>{{ number_format($productRecommend->price) }} VND</h2>
                                            <p>{{ $productRecommend->name }}</p>

                                            @if ($productRecommend->quantity > 0)
                                                <p class="text-success">Còn lại: {{ $productRecommend->quantity }}</p>
                                                <a href="{{ route('cart.add', ['id' => $productRecommend->id]) }}"
                                                   class="btn btn-default add-to-cart"
                                                   data-url="{{ route('cart.add', ['id' => $productRecommend->id]) }}"
                                                   data-id="{{ $productRecommend->id }}">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    Add to cart
                                                </a>
                                            @else
                                                <p class="text-danger">Hết hàng</p>
                                                <button class="btn btn-default add-to-cart" disabled>
                                                    <i class="fa fa-shopping-cart"></i>
                                                    Hết hàng
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                        @if($keyRecommend % 3 == 2)
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
        <i class="fa fa-angle-left"></i>
    </a>
    <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
        <i class="fa fa-angle-right"></i>
    </a>
</div>
<style>
    /* Bạn có thể thêm CSS tùy chỉnh ở đây nếu cần */
</style>

