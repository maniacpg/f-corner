@extends('layouts.admin')
@section('title')
    <title>Menu Edit</title>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Menu','key'=>'Edit'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-5">

                        <form id="categoryForm" action="{{ route('menus.update',['id'=>$menuFollowIdEdit->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên menu</label>
                                <input type="text" value="{{$menuFollowIdEdit->name}}" name="name" class="form-control" placeholder="Nhập tên menu"
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
                                $(document).ready(function() {
                                    // Khi trang được tải, kiểm tra Local Storage và điền dữ liệu
                                    if (localStorage.getItem('menuName')) {
                                        $('input[name="name"]').val(localStorage.getItem('menuName'));
                                    }
                                    if (localStorage.getItem('parentId')) {
                                        $('select[name="parent_id"]').val(localStorage.getItem('parentId'));
                                    }

                                    // Lưu giá trị vào Local Storage khi người dùng nhập
                                    $('input[name="name"]').on('input', function() {
                                        localStorage.setItem('menuName', $(this).val());
                                    });
                                    $('select[name="parent_id"]').on('change', function() {
                                        localStorage.setItem('parentId', $(this).val());
                                    });

                                    $('#categoryForm').on('submit', function(event) {
                                        event.preventDefault(); // Ngăn chặn việc gửi biểu mẫu mặc định

                                        // Xóa thông báo lỗi cũ
                                        $('#errorMessages').hide().empty();
                                        $('#notification').hide();

                                        $.ajax({
                                            url: $(this).attr('action'), // URL để gửi yêu cầu
                                            type: 'POST', // Phương thức HTTP
                                            data: $(this).serialize(), // Tuần tự hóa dữ liệu biểu mẫu
                                            success: function(response) {
                                                // Hiển thị thông báo thành công
                                                $('#notification').text('Thông báo: Danh mục đã được sửa thành công!').show();

                                                // Cập nhật danh sách chọn và thêm tùy chọn mới
                                                $('select[name="parent_id"]').html('<option value="0">Chọn menu cha</option>' + response.optionSelect);
                                                $('select[name="parent_id"]').append('<option selected value="' + response.menu.id + '">' + response.menu.name + '</option>');

                                                // Xóa trường trong biểu mẫu
                                                $('#categoryForm')[0].reset();
                                                localStorage.removeItem('menuName');
                                                localStorage.removeItem('parentId');

                                                // Ẩn thông báo sau vài giây
                                                setTimeout(function() {
                                                    $('#notification').hide();
                                                }, 3000);
                                            },
                                            error: function(xhr) {
                                                // Xử lý lỗi
                                                if (xhr.status === 422) {
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
    </div>
@endsection
