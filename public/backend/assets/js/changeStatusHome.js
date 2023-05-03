function funcChangeStatusHome() {
    let urlRequest = $(this).data("url");
    var status = $(this).prop('checked') == true ? 1 : 0;
    $.ajax({
        type: "GET",
        url: urlRequest,
        data: {
            status: status
        },
        success: function(data) {
            if(data.message === 'success'){
                swal('Cập nhật thành công', {
                    icon: 'success',
                });
            }
        },
        error: function(error) {
            console.log(error);
        },
    })
}


$(function() {
    $(document).on("change", "input[name=is-show-home]", funcChangeStatusHome);
    $(document).on("change", "input[name=status]", funcChangeStatusHome);
});