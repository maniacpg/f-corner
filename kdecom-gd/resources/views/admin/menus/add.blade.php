@extends('layouts.admin')
@section('title')
    <title>Menu Add</title>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Menu','key'=>'Add'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-5">

                        <form id="categoryForm" action="{{ route('menus.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên menu</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên menu"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Menu cha</label>
                                <select class="form-control" name="parent_id" id="parent_id">
                                    <option value="0">Chọn menu cha</option>
                                    {!! $optionSelect !!}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        <div id="notification" style="display:none; margin-top: 10px;" class="alert alert-success"></div>
                        <div id="errorMessages" style="display:none; margin-top: 10px;" class="alert alert-danger"></div>
                        <div>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                                $(document).ready(function () {
                                    $('#categoryForm').on('submit', function (event) {
                                        event.preventDefault();


                                        $('#errorMessages').hide().empty();
                                        $('#notification').hide();

                                        $.ajax({
                                            url: $(this).attr('action'),
                                            type: 'POST',
                                            data: $(this).serialize(),
                                            success: function (response) {

                                                $('#notification').text('Menu đã được tạo thành công!').show();


                                                $('select[name="parent_id"]').html('<option value="0">Chọn menu cha</option>' + response.optionSelect);


                                                $('#categoryForm')[0].reset();


                                                setTimeout(function () {
                                                    $('#notification').hide();
                                                }, 3000);
                                            },
                                            error: function (xhr) {
                                                // Xử lý lỗi
                                                if (xhr.status === 422) {
                                                    let errors = xhr.responseJSON.errors;
                                                    $.each(errors, function (key, value) {
                                                        $('#errorMessages').append('<p>' + value.join(', ') + '</p>');
                                                    });
                                                    $('#errorMessages').show();
                                                } else {
                                                    $('#errorMessages').text('Có lỗi xảy ra! Vui lòng thử lại.').show();
                                                }
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
