@php
    $baseUrl = config('app.baseUrl');
@endphp


@extends('layouts.master')
@section('title')
    <title>Family Corner | Giỏ hàng</title>
@endsection

@section('css')
    <link href="{{asset('home/home.css')}}" rel="stylesheet">

@endsection

@section('js')
    <script src="{{asset('home/home.js')}}" type="text/javascript"></script>
@endsection


@section('content')

@include('components.cart-component')

<style>
        /* Định dạng chung cho bảng */
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        /* Định dạng header của bảng */
        .cart_menu {
            background-color: #FE980F;
            color: #fff;
        }
        .cart_menu td {
            padding: 15px 10px;
            font-weight: bold;
            vertical-align: middle;
        }
        /* Định dạng chiều rộng các cột */
        .image, .cart_product {
            width: 150px;
        }
        .description, .cart_description {
            width: 35%;
        }
        .price, .cart_price {
            width: 10%;
            text-align: center;
        }
        .quantity, .cart_quantity {
            width: 10%;
            text-align: center;
        }
        .total, .cart_total {
            width: 10%;
            text-align: right;
        }
        .action {
            width: 20%;
            text-align: center;
        }
        .cart_action {
            text-align: center;
        }
        /* Định dạng các ô trong tbody */
        .cart_product img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .cart_description h4 {
            margin: 0;
            padding: 0;
        }
        .cart_description h4 a {
            color: #363432;
            text-decoration: none;
        }
        .cart_price p, .cart_total p {
            color: #FE980F;
            font-size: 18px;
            margin: 0;
        }
        /* Định dạng phần số lượng */
        .cart_quantity_button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        .cart_quantity_input {
            width: 50px;
            height: 30px;
            text-align: center;
            border: 1px solid #ddd;
        }
        /* Định dạng các dòng trong tbody */
        tbody tr {
            border-bottom: 1px solid #F7F7F0;
        }
        tbody tr td {
            padding: 15px 10px;
            vertical-align: middle;
            text-align: center;
        }
    </style>

@endsection


