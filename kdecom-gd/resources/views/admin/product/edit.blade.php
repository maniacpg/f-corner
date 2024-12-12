@extends('layouts.admin')
@section('title')
    <title>Product Edit</title>

@endsection

@section('css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>
@endsection

@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Sản phẩm','key'=>'Sửa sản phẩm'])
        <form action="{{route('product.update', ['id'=>$product->id])}}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-5">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text"
                                       name="name"
                                       value="{{$product->name}}"
                                       class="form-control"
                                       placeholder="Nhập tên sản phẩm">
                            </div>

                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="text"
                                       name="price"
                                       value="{{$product->price}}"
                                       class="form-control"
                                       placeholder="Nhập giá sản phẩm">
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="number"
                                       name="quantity"
                                       value="{{ $product->quantity }}"
                                       class="form-control @error('quantity') is-invalid @enderror"
                                       placeholder="Nhập số lượng sản phẩm">
                                @error('quantity')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>
                                <input type="file"
                                       name="feature_image_path"
                                       class="form-control-file">
                                <div class="col-md-12">
                                    <div class="row">
                                        <img class="image_avataar_prod" src="{{$product->feature_image_path}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input type="file" multiple
                                       name="image_path[]"
                                       class="form-control-file">
                                <div class="col-md-12 container_image_detail">
                                    <div class="row">
                                        @foreach($product->productImage as $productImageItem)
                                            <div class="col-md-3">
                                                <img class="image_detail_prod" src="{{$productImageItem->image_path}}" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Chọn danh mục</label>
                                <select class="form-control select2_init" name="category_id" id="parent_id">

                                    <option value="0">Chọn danh mục</option>
                                    {!! $optionSelect !!}

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nhập tag cho sản phẩm</label>
                                <select name="tags[]" class="form-control tag_select_choose" multiple="multiple">
                                    @foreach($product->tags as $tagItem)
                                        <option value="{{$tagItem->name }}" selected>{{$tagItem->name}}</option>
                                    @endforeach

                                </select>
                            </div>


                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="contents"
                                          class="form-control tinymce-editor">{{$product->content}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-bottom: 10px">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="{{asset('vendor/select2/select2.min.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/55j97k88go04swyxdkvmnq5rvidsyriajnstvq9k9rk0464w/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('admins/product/add/add.js')}}"></script>
@endsection
