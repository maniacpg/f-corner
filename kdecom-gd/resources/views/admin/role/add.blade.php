@extends('layouts.admin')
@section('title')
    <title>Thêm vai trò</title>
@endsection
@section('css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/role/add/add.css')}}" rel="stylesheet"/>
@endsection
@section('js')
    <script src="{{asset('admins/role/add/add.js')}}">
    </script>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Vai trò','key'=>'Thêm vai trò'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form id="categoryForm" action="{{route('roles.store')}}" method="post" enctype="multipart/form-data" style="width: 100%">
                        <div class="col-md-12">
                            @csrf
                            <div class="form-group">
                                <label>Tên vai trò</label>
                                <input type="text" value="{{old('name')}}"
                                       name="name" class="form-control"
                                       placeholder="Nhập tên vai trò">
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <input type="text" value="{{old('name')}}"
                                       name="display_name" class="form-control"
                                       placeholder="Nhập mô tả">
                            </div>
                            <label>Phân quyền</label>
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-12">
                                        Chọn tất cả
                                        <input type="checkbox" class="checkall">
                                    </div>
                                    @foreach($permissionParent as $permissionParentItem)
                                        <div class="card border-primary mb-3 col-md-12 ">
                                            <div class="card-header ">
                                                <label>
                                                    <input class="checkbox-wrapper" type="checkbox" value="">
                                                </label>
                                                Module {{$permissionParentItem->display_name}}
                                            </div>

                                            <div class="row">
                                                @foreach($permissionParentItem->permissionsChild as $permissionsChildItem)
                                                    <div class="card-body text-primary col-md-3">
                                                        <h5 class="card-title">
                                                            <label>
                                                                <input type="checkbox"
                                                                       class="checkbox-child"
                                                                       name="permission_id[]"
                                                                       value="{{$permissionsChildItem->id}}">
                                                            </label>
                                                            {{$permissionsChildItem->display_name}}
                                                        </h5>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
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
