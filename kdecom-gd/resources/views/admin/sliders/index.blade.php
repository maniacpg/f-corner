@extends('layouts.admin')
@section('title')
    <title>Slider</title>
@endsection
@section('css')
    <link rel = "stylesheet" href = "{{asset('admins/sliders/listSlider.css')}}" />
@endsection
@section('js')
    <script src="{{asset('vendor/SweetAlert/sweetalert2.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins/main.js')}}"></script>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Slider','key'=>'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('slider.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên slider</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Ảnh slider</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <th scope="row">{{$slider->id}}</th>
                                    <td>{{$slider->name}}</td>
                                    <td>{{$slider->description}}</td>
                                    <td><img class="image-slider" src="{{$slider->image_path}}" alt=""></td>
                                    <td>
                                        <a href="{{route('slider.edit',['id'=>$slider->id])}}"
                                           class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url = "{{route('slider.delete',['id'=>$slider->id])}}"
                                           class="btn btn-danger action_del">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$sliders->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
