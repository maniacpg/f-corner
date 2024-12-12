@php
    $baseUrl = config('app.baseUrl');
@endphp


@extends('layouts.master')
@section('title')
    <title>Family Corner</title>
@endsection

@section('css')
    <link href="{{asset('home/home.css')}}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{asset('home/home.js')}}" type="text/javascript"></script>
@endsection


@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('components.sidebar')
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="{{ config('app.baseUrl') . $products->feature_image_path }}"
                                     alt="{{ $products->name }}"/>
                                <h3>{{ $products->name }}</h3>
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">

                                    <div class="item active">
                                        <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>

                                    </div>
                                </div>
                                {{--                                <!-- Controls -->--}}
                                {{--                                <a class="left item-control" href="#similar-product" data-slide="prev">--}}
                                {{--                                    <i class="fa fa-angle-left"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a class="right item-control" href="#similar-product" data-slide="next">--}}
                                {{--                                    <i class="fa fa-angle-right"></i>--}}
                                {{--                                </a>--}}
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <img src="images/product-details/new.jpg" class="newarrival" alt=""/>
                                <h2>{{ $products->name }}</h2>
                                <p>Web ID: {{ $products->id }}</p>
                                <img src="images/product-details/rating.png" alt=""/>
                                <span>
                                <span>
                                <span>{{ number_format($products->price) }} VND</span>
                                <label> Số lượng:</label>
                                <input type="number" value="1" id="quantity" min="1"/>
                                <button type="button" class="btn btn-default add-to-cart"
                                        data-url="{{ route('cart.add', ['id' => $products->id]) }}"
                                        data-id="{{ $products->id }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add to cart
                                </button>
                            </span>
                                <p><b>Availability:</b> In Stock</p>
                                <p><b>Condition:</b> New</p>
                                <p><b>Brand:</b> E-SHOPPER</p>
                                <a href=""><img src="images/product-details/share.png" class="share img-responsive"
                                                alt=""/></a>
                            </div><!--/product-information-->
                        </div>
                    </div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="product-details">
                            <div class="col-sm-12">
                                {!! $products->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addToCartButtons = document.querySelectorAll('.add-to-cart');

        addToCartButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');
                const quantity = document.getElementById('quantity').value;

                fetch(this.getAttribute('data-url'), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({quantity: quantity})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công!',
                                text: 'Sản phẩm đã được thêm vào giỏ hàng.',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: data.message,
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    });
</script>
