@php
    $baseUrl = config('app.baseUrl');
@endphp
@extends('layouts.master')

        @section('title')
            <title>Family Corner</title>
        @endsection

@section('css')
    <link href="{{asset('home/home.css')}}" rel="stylesheet">

    <link href="{{asset('eshopper/css/main.css')}}" rel="stylesheet">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('home/home.js')}}" type="text/javascript"></script>
@endsection


@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        @include('components.sidebar')

                    </div>
                </div>
                <h2 class="title text-center">Features Items</h2>
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->

                        @foreach($products as $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{$baseUrl.$product->feature_image_path}}" alt=""/>
                                        <h2>{{number_format($product->price)}} VND</h2>
                                        <p>{{$product->name}}</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i
                                                class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>{{number_format($product->price)}} VND</h2>
                                            <p>{{$product->name}}</p>

                                            <a href="{{route('cart.add', ['id'=>$product->id])}}"
                                               class="btn btn-default add-to-cart"
                                            data-url="{{route('cart.add', ['id'=>$product->id])}}">
                                                <i
                                                    class="fa fa-shopping-cart">
                                                </i>
                                                Add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
                <div class="col-sm-3" style="">
                    {{$products->links('pagination::bootstrap-4')}}
                </div>
            </div>

        </div>

    </section>




    <script src="js/jquery.js"></script>
    <script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
@endsection



