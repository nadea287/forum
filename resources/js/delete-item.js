$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    swallConfirmDeleteProfile('.thread-delete-btn', 'sure?', '.thread-content', 'thread');

    function swallConfirmDeleteProfile(button, text, deleteSth, type) {
        $(button).on("click", function () {
            var id = $(this).attr('id');
            var $this = $(this);
            swal({
                title: "Are you sure?",
                text: text,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Your omment has been deleted!", {
                            icon: "success",
                        });
                        $this.closest(deleteSth).remove();
                        deleteItem(type, id);
                        location.href = "/thread";
                    }
                });
        })
    }

    function deleteItem(type, id) {
        $.ajax({
            url: '/' + type + '/' + id,
            method: 'DELETE',
            data: id = id
        }).done(function (result) {

        }).fail(function (error) {
            console.log(error);
        });
    }

});
