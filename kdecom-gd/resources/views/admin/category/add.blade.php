@extends('layouts.admin')
@section('title')
    <title>Thêm danh mục</title>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Category','key'=>'Add'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-5">

                        <form id="categoryForm" action="{{ route('categories.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên danh mục" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Danh mục cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Chọn danh mục cha</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        <div id="notification" style="display:none; margin-top: 10px;" class="alert alert-success"></div>
                        <div id="errorMessages" style="display:none; margin-top: 10px;" class="alert alert-danger"></div>


                        <div id="result" style="margin-top: 20px;"></div>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#categoryForm').on('submit', function(event) {
                                    event.preventDefault();


                                    $('#errorMessages').hide().empty();
                                    $('#notification').hide();

                                    $.ajax({
                                        url: $(this).attr('action'),
                                        type: 'POST',
                                        data: $(this).serialize(),
                                        success: function(response) {

                                            $('#notification').text('Danh mục đã được tạo thành công!').show();


                                            let newOptions = '<option value="0">Chọn danh mục cha</option>' + response.htmlOption;                                            $('select[name="parent_id"]').html(response.htmlOption);
                                            $('select[name="parent_id"]').html(newOptions);

                                            $('#categoryForm')[0].reset();


                                            setTimeout(function() {
                                                $('#notification').hide();
                                            }, 3000);
                                        },
                                        error: function(xhr) {

                                            if (xhr.status === 422) { // Không thể xử lý
                                                let errors = xhr.responseJSON.errors;
                                                $.each(errors, function(key, value) {
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
@endsection
