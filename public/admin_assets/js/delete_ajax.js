
$('.btn-delete').click(function (e) {
    e.preventDefault();
    let urlRequest = $(this).data('url');
    let token = $(this).data("token");
    let tr = $(this);
    swal({
        title: "Bạn có chắc chắn muốn xóa ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: urlRequest,
                    type: 'DELETE',
                    data: {
                        "_token": token,
                    },
                    success: function (data) {
                        if (data.code == 200) {
                            tr.parent().parent().remove();
                            swal("Xóa thành công !", {
                                icon: "success",
                            });

                        } else {
                            swal("Xóa không thành công !", {
                                icon: "warning",
                            });
                        }
                    },

                });
            } else {
                swal("Đã hủy !");
            }
        });

});
