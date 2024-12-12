<div class="category-tab">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            @foreach($categories as $indexCategory => $categoryItem)
                <li class="{{ $indexCategory == 0 ? 'active' : '' }}">
                    <a href="#category_tab_{{ $categoryItem->id }}" data-toggle="tab">{{ $categoryItem->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="tab-content">
        @foreach($categories as $indexCategory => $category)
            <div class="tab-pane fade {{ $indexCategory == 0 ? 'active in' : '' }}" id="category_tab_{{ $category->id }}">
                @foreach($category->categoryChild as $childCategory)
                    <div class="category-section">
                        <h3>{{ $childCategory->name }}</h3>
                        <div class="row">
                            @foreach($childCategory->products as $product)
                                <div class="col-sm-4">
                                    <a href="">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ $baseUrl . $product->feature_image_path }}" alt="{{ $product->name }}"/>
                                                    <h2>{{ number_format($product->price) }} VND</h2>
                                                    <p>{{ $product->name }}</p>

                                                    @if ($product->quantity > 0)
                                                        <p class="text-success">Còn lại: {{ $product->quantity }}</p>
                                                        <a href="{{ route('cart.add', ['id' => $product->id]) }}"
                                                           class="btn btn-default add-to-cart"
                                                           data-id="{{ $product->id }}"
                                                           data-url="{{ route('cart.add', ['id' => $product->id]) }}">

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
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
