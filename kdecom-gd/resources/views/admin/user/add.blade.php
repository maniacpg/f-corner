@extends('layouts.admin')
@section('title')
    <title>Thêm người dùng</title>
@endsection
@section('css')

    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/user/add/add.css')}}" rel="stylesheet"/>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Người dùng','key'=>'Thêm người dùng'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-5">

                        <form id="categoryForm" action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       placeholder="Nhập tên" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text"
                                       name="email"
                                       class="form-control"
                                       placeholder="Nhập email" required>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       placeholder="Nhập mật khẩu" required>
                            </div>
                            <div class="form-group">
                                <label>Chọn vai trò</label>
                                <select name="role_id[]" class="form-control select2_role" multiple id="" required>
                                    <option value=""></option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->display_name}}</option>
                                    @endforeach

                                </select>
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
@section('js')
    <script src="{{asset('vendor/select2/select2.min.js')}}"></script>
    <script src="{{asset('admins/user/add/add.js')}}"></script>

@endsection
