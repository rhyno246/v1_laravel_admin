function cartUpDate(e) {
    e.preventDefault();
    let url = $('.update_cart_url').data("url");
    let id = $(this).data("id");
    let quantity = $(this).parents('tr').find('input.cart_quantity_input').val();
    $.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        data: {
            id: id,
            quantity: quantity
        },
        success: function(data) {
            if (data.message === 'success') {
                $('#cart_items').html(data.cart_item);
                swal('Cập nhật giỏ hàng thành công', {
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
    $(document).on('click' , '.cart_update', cartUpDate);
});