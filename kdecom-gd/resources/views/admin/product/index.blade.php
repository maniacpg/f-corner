@extends('layouts.admin')
@section('title')
    <title>Sản phẩm</title>
@endsection
@section('css')
    <link rel = "stylesheet" href = "{{asset('admins/product/index/listProd.css')}}" />
@endsection
@section('js')
    <script src="{{asset('vendor/SweetAlert/sweetalert2.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins/main.js')}}"></script>
@endsection
@section('content')

    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'Product','/','key'=>'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('product.create')}}" class="btn btn-success float-right m-2">Thêm sản phẩm</a>
                    </div>
                    <div class="col-md-12">
                        <form action="{{ route('product.index') }}" method="GET" class="form-inline mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Tìm sản phẩm..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary ml-2">Tìm kiếm</button>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <th scope="row">{{$product->id}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>{{number_format($product->price)}}</td>
                                    <td>
                                        @if($product->quantity > 0)
                                            <span class="badge badge-success">Còn lại: {{$product->quantity}}</span>
                                        @else
                                            <span class="badge badge-danger">Hết hàng</span>
                                        @endif
                                    </td>
                                    <td>
                                        <img class="image-product" src="{{$product->feature_image_path}}">
                                    </td>
                                    <td>{{optional($product->category)->name}}</td>
                                    <td>
                                        <a href="{{route('product.edit',['id'=> $product->id])}}"
                                           class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url="{{route('product.delete', ['id'=>$product->id])}}"
                                           class="btn btn-danger action_del">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$products->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

