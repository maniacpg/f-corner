@extends('layouts.admin')
@section('title')
    <title>Cài đặt</title>
@endsection
@section('css')
    <link href="{{asset('admins/setting/setting.css')}}" rel="stylesheet" />
@endsection
@section('js')
    <script src="{{asset('vendor/SweetAlert/sweetalert2.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins/main.js')}}"></script>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Cài đặt','key'=>'Danh sách cấu hình'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <a class="btn dropdown-toggle float-right m-2" data-toggle="dropdown" href="#">
                                Thêm cấu hình
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('settings.create') . '?type=Text'}}">Giá trị ngắn</a></li>
                                <li><a href="{{route('settings.create') . '?type=Textarea'}}">Giá trị dài</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên cấu hình</th>
                                <th scope="col">Giá trị</th>
                                <th scope="col">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($setting as $settingItem)
                                <tr>
                                    <th scope="row">{{$settingItem->id}}</th>
                                    <td>{{$settingItem->config_key}}</td>
                                    <td>{{$settingItem->config_value}}</td>
                                    <td>
                                        <a href="{{route('settings.edit',['id'=>$settingItem->id]). '?type='. $settingItem->type_input}}"
                                           class="btn btn-default">Sửa</a>
                                        <a href=""
                                            data-url="{{route('settings.delete',['id'=>$settingItem->id])}}"
                                           class="btn btn-danger action_del">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$setting->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

