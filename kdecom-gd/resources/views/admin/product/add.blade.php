@extends('layouts.admin')
@section('title')
    <title>Product Add</title>

@endsection

@section('css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>
@endsection

@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Product','key'=>'Add'])
        <div class="col-md-12">
            {{--            @if ($errors->any())--}}
            {{--                <div class="alert alert-danger">--}}
            {{--                    <ul>--}}
            {{--                        @foreach ($errors->all() as $error)--}}
            {{--                            <li>{{ $error }}</li>--}}
            {{--                        @endforeach--}}
            {{--                    </ul>--}}
            {{--                </div>--}}
            {{--            @endif--}}
        </div>
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-5">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Nhập tên sản phẩm">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input type="text"
                                       name="price"
                                       value="{{ old('price') }}"
                                       class="form-control @error('price') is-invalid @enderror"
                                       placeholder="Nhập giá sản phẩm">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Thêm trường nhập số lượng -->
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="number"
                                       name="quantity"
                                       value="{{ old('quantity') }}"
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
                            </div>
                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input type="file" multiple
                                       name="image_path[]"
                                       class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Chọn danh mục</label>
                                <select class="form-control select2_init @error('category_id') is-invalid @enderror"
                                        name="category_id" id="parent_id">
                                    <option value="">Chọn danh mục</option>
                                    {!! $optionSelect !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nhập tag cho sản phẩm</label>
                                <select name="tags[]" class="form-control tag_select_choose" multiple="multiple">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="contents" class="form-control tinymce-editor @error('contents') is-invalid @enderror">
                            {{ old('contents') }}
                        </textarea>
                                @error('contents')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
