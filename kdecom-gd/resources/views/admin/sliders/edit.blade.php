@extends('layouts.admin')
@section('title')
    <title>Slider Edit</title>
@endsection
@section('css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Slider','key'=>'Edit'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-5">

                        <form id="categoryForm" action="{{route('slider.update', ['id'=>$sliders->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên slider</label>
                                <input type="text" value="{{$sliders->name}}"
                                       name="name" class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Nhập tên slider">

                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mô tả slider</label>


                                <textarea name="description" id=""
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Mô tả slider" cols="30"
                                          rows="10">{{$sliders->description}}</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file"
                                       name="image_path"
                                       class="form-control-file @error('image_path') is-invalid @enderror">
                                <div class="col-md-4">
                                    <img class="image_slider_edit" src="{{$sliders->image_path}}" alt="">
                                </div>
                                @error('image_path')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
