$(document).ready(function() {
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<div class=\"thumbnail\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result +
                        "\" title=\"" + file.name + "\"/>" +
                        "<a class=\"remove btn btn-icon btn-danger\"><i class=\"fas fa-times\"></i></a>" +
                        "</div>").insertAfter("#files");
                    $(".remove").click(function() {
                        swal({
                            title: 'Bạn chắc chứ ?',
                            text: 'Sau khi xóa, bạn sẽ không thể khôi phục tệp này!',
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                        }).then((willDelete) => {
                            if (willDelete) {
                                $(this).parent(
                                    ".thumbnail"
                                ).remove();
                                swal('Ok rồi ! Bạn đã xóa thành công ', {
                                    icon: 'success',
                                });
                            } else {
                                swal('OK ! Vẫn giữ bản ghi hiện tại');
                            }
                        });

                    });
                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }
});