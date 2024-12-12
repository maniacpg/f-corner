$(document).ready(function() {
    // Khởi tạo - kiểm tra trạng thái ban đầu của các checkbox
    $('.card').each(function() {
        var allChecked = $(this).find('.checkbox-child').length ===
            $(this).find('.checkbox-child:checked').length;
        $(this).find('.checkbox-wrapper').prop('checked', allChecked);
    });
    updateSelectAllCheckbox();

    // Xử lý khi click vào checkbox "Chọn tất cả"
    $('.checkall').change(function() {
        var isChecked = $(this).is(':checked');
        $('.checkbox-child, .checkbox-wrapper').prop('checked', isChecked);
    });

    // Xử lý khi click vào checkbox-child
    $('.checkbox-child').change(function() {
        var card = $(this).closest('.card');
        var allChecked = card.find('.checkbox-child').length ===
            card.find('.checkbox-child:checked').length;
        card.find('.checkbox-wrapper').prop('checked', allChecked);
        updateSelectAllCheckbox();
    });

    // Xử lý khi click vào checkbox-wrapper
    $('.checkbox-wrapper').change(function() {
        var isChecked = $(this).is(':checked');
        $(this).closest('.card').find('.checkbox-child').prop('checked', isChecked);
        updateSelectAllCheckbox();
    });

    // Hàm cập nhật trạng thái checkbox "Chọn tất cả"
    function updateSelectAllCheckbox() {
        var allChecked = $('.checkbox-child').length ===
            $('.checkbox-child:checked').length;
        $('.checkall').prop('checked', allChecked);
    }
});
