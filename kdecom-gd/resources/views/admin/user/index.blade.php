@extends('layouts.admin')
@section('title')
    <title>Danh sách người dùng</title>
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

        @include('partials.content-header', ['name'=>'Người dùng','key'=>'Danh sách người dùng'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('users.create')}}" class="btn btn-success float-right m-2">Thêm người dùng</a>
                    </div>
                    <div class="col-md-12">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a href="{{route('users.edit',['id'=>$user->id])}}"
                                           class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url = "{{route('users.delete', ['id'=>$user->id])}}"
                                           class="btn btn-danger action_del">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$users->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
