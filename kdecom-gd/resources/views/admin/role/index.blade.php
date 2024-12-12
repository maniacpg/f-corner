@extends('layouts.admin')
@section('title')
    <title>Vai trò</title>
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

        @include('partials.content-header', ['name'=>'Vai trò','key'=>'Danh sách vai trò'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('roles.create')}}" class="btn btn-success float-right m-2">Thêm vai trò</a>
                    </div>
                    <div class="col-md-12">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên vai trò</th>
                                <th scope="col">Tên hiển thị</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <th scope="row">{{$role->id}}</th>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->display_name}}</td>
                                    <td>

                                        <a href="{{route('roles.edit',['id'=>$role->id])}}"
                                           class="btn btn-default">Edit</a>

                                        <a href=""
                                           data-url = "{{route('roles.delete',['id'=>$role->id])}}"
                                           class="btn btn-danger action_del">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$roles->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

