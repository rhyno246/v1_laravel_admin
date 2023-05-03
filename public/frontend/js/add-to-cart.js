function addToCart(e) {
    e.preventDefault();
    let url = $(this).data("url");
    $.ajax({
        type : "GET",
        url : url,
        dataType : 'json',
        success: function (data) {
            if(data.message === 'success'){
                swal('Thêm sản phẩm vào giỏ hàng thành công', {
                    icon: 'success',
                });
            }
        },
        error : function (error) {
            console.log(error)
        }
    })
}

$(function() {
    $('.add-to-cart').on('click', addToCart);
});