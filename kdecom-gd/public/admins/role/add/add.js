$(document).ready(function() {
    // Khi checkbox "Chọn tất cả" thay đổi
    $('.checkall').change(function() {
        var isChecked = $(this).is(':checked'); // Lấy trạng thái của checkbox "Chọn tất cả"
        // Cập nhật trạng thái của tất cả checkbox-child
        $('.checkbox-child').prop('checked', isChecked);
        // Cập nhật trạng thái của tất cả checkbox-wrapper
        $('.checkbox-wrapper').prop('checked', isChecked);
    });

    // Khi checkbox-child thay đổi
    $('.checkbox-child').change(function() {
        var parentCard = $(this).closest('.card'); // Lấy phần tử card cha
        var allChecked = parentCard.find('.checkbox-child').length === parentCard.find('.checkbox-child:checked').length;
        parentCard.find('.checkbox-wrapper').prop('checked', allChecked); // Cập nhật checkbox-wrapper

        // Cập nhật trạng thái "Chọn tất cả"
        var allCheckboxes = $('.checkbox-child');
        var allCheckedInGroup = allCheckboxes.length === allCheckboxes.filter(':checked').length;
        $('.checkall').prop('checked', allCheckedInGroup); // Cập nhật checkbox "Chọn tất cả"
    });

    // Khi checkbox-wrapper thay đổi
    $('.checkbox-wrapper').change(function() {
        var isChecked = $(this).is(':checked'); // Lấy trạng thái checkbox-wrapper
        $(this).closest('.card').find('.checkbox-child').prop('checked', isChecked); // Cập nhật tất cả checkbox-child

        // Cập nhật trạng thái "Chọn tất cả"
        var allCheckboxes = $('.checkbox-child');
        var allCheckedInGroup = allCheckboxes.length === allCheckboxes.filter(':checked').length;
        $('.checkall').prop('checked', allCheckedInGroup); // Cập nhật checkbox "Chọn tất cả"
    });
});
