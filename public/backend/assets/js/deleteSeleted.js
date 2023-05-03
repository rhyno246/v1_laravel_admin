function postDeleteSelected(e) {
    e.preventDefault();
    let urlRequest = $(this).data("url");
    var allIds = [];
    $('input:checkbox[name=ids]:checked').each(function() {
        allIds.push($(this).val());
    });
    if (allIds.length > 0) {
        swal({
            title: 'Bạn chắc chứ ?',
            text: 'Bạn chắc là muốn xóa ' + allIds.length + ' dữ liệu',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if(willDelete){
                $.ajax({
                    url: urlRequest,
                    type: "POST",
                    data: {
                        _token: $('input[name=_token]').val(),
                        ids: allIds
                    },
                    success: function(response) {
                        if(response.message === 'success'){
                            $.each(allIds, function(key, val) {
                                $('#ids' + val).remove();
                            })
                            swal('Ok rồi ! Bạn đã xóa thành công ', {
                                icon: 'success',
                            });
                            $('.deleteSeleted').addClass('d-none');
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });
            }
        })
    }
}


$(function() {
    $(document).on("click", ".deleteSeleted", postDeleteSelected);
});