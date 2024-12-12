@extends('layouts.admin')
@section('title')
    <title>Category</title>
@endsection
@section('js')
    <script src="{{asset('vendor/SweetAlert/sweetalert2.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins/main.js')}}"></script>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Category','/','key'=>'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @can('category_add')
                        <a href="{{route('categories.create')}}" class="btn btn-success float-right m-2">Add</a>
                            @endcan
                    </div>
                    <div class="col-md-12">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        @can('category_edit')
                                            <a href="{{route('categories.edit', ['id'=> $category->id])}}"
                                               class="btn btn-default">Edit</a>
                                        @endcan
                                        @can('category_delete')
                                            <a href=""
                                               data-url="{{route('categories.delete', ['id'=>$category->id])}}"
                                               class="btn btn-danger action_del">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$categories->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
