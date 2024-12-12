@extends('layouts.admin')
@section('title')
    <title>Category Edit</title>
@endsection
@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Category','key'=>'Edit'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <form id="categoryForm" action="{{ route('categories.update',['id'=> $category->id]) }}"
                              method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" value="{{$category->name}}" name="name" class="form-control"
                                       placeholder="Nhập tên danh mục" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Danh mục cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Chọn danh mục cha</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                        <div id="notification" style="display:none; margin-top: 10px;"
                             class="alert alert-success"></div>
                        <div id="errorMessages" style="display:none; margin-top: 10px;"
                             class="alert alert-danger"></div>

                        <!-- Khu vực hiển thị dữ liệu vừa gửi -->
                        <div id="result" style="margin-top: 20px;"></div>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function () {
                                $('#categoryForm').on('submit', function (event) {
                                    event.preventDefault(); // Ngăn chặn việc gửi biểu mẫu mặc định

                                    // Xóa thông báo lỗi cũ
                                    $('#errorMessages').hide().empty();
                                    $('#notification').hide();

                                    // Lưu giá trị đã chọn
                                    let selectedParentId = $('select[name="parent_id"]').val();

                                    $.ajax({
                                        url: $(this).attr('action'), // URL để gửi yêu cầu
                                        type: 'POST', // Phương thức HTTP
                                        data: $(this).serialize(), // Tuần tự hóa dữ liệu biểu mẫu
                                        success: function (response) {
                                            // Hiển thị thông báo thành công
                                            $('#notification').text('Thông báo: Danh mục đã được cập nhật thành công!').show();

                                            // Tạo danh sách chọn với tùy chọn đã chọn
                                            let newOptions = '<option value="0">Chọn danh mục cha</option>';
                                            response.htmlOption.split('\n').forEach(function (option) {
                                                // Kiểm tra nếu option có ID khớp với selectedParentId
                                                if (option.includes('value="' + selectedParentId + '"')) {
                                                    newOptions += option.replace('>', ' selected>'); // Thêm thuộc tính selected
                                                } else {
                                                    newOptions += option; // Thêm tùy chọn bình thường
                                                }
                                            });

                                            // Cập nhật danh sách chọn
                                            $('select[name="parent_id"]').html(newOptions);

                                            // Tùy chọn: Xóa trường trong biểu mẫu
                                            $('#categoryForm')[0].reset();

                                            // Ẩn thông báo sau vài giây
                                            setTimeout(function () {
                                                $('#notification').hide();
                                            }, 3000);
                                        },
                                        error: function (xhr) {
                                            // Xử lý lỗi
                                            if (xhr.status === 422) { // Không thể xử lý
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

@endsection
