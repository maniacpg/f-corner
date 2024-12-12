@php
    $baseUrl = config('app.baseUrl');
@endphp


@extends('layouts.master')
@section('title')
    <title>Sản phẩm</title>
@endsection

@section('css')
    <link href="{{asset('home/home.css')}}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{asset('home/home.js')}}" type="text/javascript"></script>
@endsection


@section('content')

    <body>

    <section>
        <div class="container">
            <h2>Kết quả tìm kiếm cho: "{{ $query }}"</h2>
            <div class="row">
                @forelse($products as $product)
                    <div class="col-md-3 col-sm-5 col-xs-7">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ $baseUrl . $product->feature_image_path }}" alt=""/>
                                    <h2>{{ number_format($product->price) }} VND</h2>
                                    <p>{{ $product->name }}</p>
                                    <a href="{{ route('cart.add', ['id' => $product->id]) }}"
                                       class="btn btn-default add-to-cart"
                                       data-url="{{ route('cart.add', ['id' => $product->id]) }}">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>{{ number_format($product->price) }} VND</h2>
                                        <p>{{ $product->name }}</p>
                                        <a href="{{ route('cart.add', ['id' => $product->id]) }}"
                                           class="btn btn-default add-to-cart"
                                           data-url="{{ route('cart.add', ['id' => $product->id]) }}">
                                            <i class="fa fa-shopping-cart"></i>
                                            Add to cart
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <p>Không tìm thấy sản phẩm nào phù hợp với tìm kiếm của bạn.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection

