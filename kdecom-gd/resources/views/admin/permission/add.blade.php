@extends('layouts.admin')
@section('title')
    <title>Tạo quyền</title>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Menu','key'=>'Tạo quyền'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">

                        <form id="categoryForm" action="{{ route('permissions.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Chọn module chức năng</label>

                                <select class="form-control" name="module_parent" id="parent_id">
                                    <option value="">Chọn module</option>
                                    @foreach(config('permissions.table_module') as $key => $moduleItem)
                                        <option value="{{$key}}">{{$moduleItem}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    @foreach(config('permissions.module_child') as $keyChild => $moduleItemChild)
                                    <div class="col-md-3">
                                        <label>
                                            <input type="checkbox" name="module_child[]" value="{{$keyChild}}">
                                            {{$moduleItemChild}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
