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

    <body>

    @include('home.components.slider')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('components.sidebar')
                </div>

                <div class="col-sm-9 padding-right">
                    <!--features_items-->
                    @include('home.components.feature_product')
                    <!--features_items-->



                    <!--category-tab-->
                    @include('home.components.category_tab')
                    <!--/category-tab-->



                    <!--recommended_items-->
                    @include('home.components.recommend_product')
                    <!--/recommended_items-->

                </div>
            </div>
        </div>
    </section>

@endsection
