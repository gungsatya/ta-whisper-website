<script src="<?php echo base_url('assets/panel/js/lib/toastr/toastr.min.js')?>"></script>

<script type="text/javascript">
    function notif_error(message) {
        toastr.error(message, 'GAGAL !', {
            "positionClass": "toast-bottom-right",
            timeOut: 5000,
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "tapToDismiss": false
        })
    }

    function notif_success(message) {
        toastr.success(message, 'Sukses', {
            "positionClass": "toast-bottom-right",
            timeOut: 5000,
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "tapToDismiss": false
        })
    }
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $('.clearBtn').click(function(e) {
        e.preventDefault();
        chat_id = $(this).data('row-chat-id');
        $.ajax({
            type: "post",
            url: "<?php echo base_url('req/path_control/clear') ?>",
            data: {
                chat_id: chat_id
            },
            datatype: "json",
            cache: false,
            success: function(response) {
                response = $.parseJSON(response);
                if (response.ok) {
                    notif_success('Operasi berhasil dihentikan');
                    location.reload();
                } else {
                    notif_error('Operasi gagal dihentikan');
                    console.log(response);
                }
            }
        });
    })
</script>