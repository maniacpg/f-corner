@extends('layouts.admin')
@section('title')
    <title>Thêm cấu hình</title>
@endsection
@section('css')
    <link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Cài đặt','key'=>'Thêm cấu hình'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-5">

                        <form action="{{ route('settings.store') . '?type=' . request()->type }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên cấu hình</label>
                                <input type="text" name="config_key" value="{{old('config_key')}}" class="form-control @error('config_key') is-invalid @enderror" placeholder="Nhập tên cấu hình">
                                @error('config_key')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            @if(request()->type === 'Text')
                                <div class="form-group">
                                    <label>Giá trị</label>
                                    <input type="text" name="config_value" value="{{old('config_value')}}" class="form-control @error('config_value') is-invalid @enderror" placeholder="Nhập giá trị">
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            @elseif(request()->type === 'Textarea')
                                <div class="form-group">
                                    <label>Giá trị</label>
                                    <textarea name="config_value" value="{{old('config_value')}}" class="form-control @error('config_value') is-invalid @enderror" placeholder="Nhập giá trị" rows="5"></textarea>
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
