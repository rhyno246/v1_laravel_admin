function cartDelete(e) {
    e.preventDefault();
    let url = $('#cart_items').data("url");
    let id = $(this).data("id");
    $.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        data: {
            id: id
        },
        success: function(data) {
            if (data.message === 'success') {
                $('#cart_items').html(data.cart_item);
                swal('Xóa thành công', {
                    icon: 'success',
                });
            }
        },
        error: function(error) {
            console.log(error)
        }
    })
}

$(function() {
    $(document).on('click' , '.cart_delete', cartDelete);
});