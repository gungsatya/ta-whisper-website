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
    $("#add_operation").submit(function (e) {
        e.preventDefault();
        frm = $('#add_operation');
        frm.find('input[type="submit"]').prop('disabled', true);
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response)
                data = $.parseJSON(response);
                if (data.ok) {
                    notif_success('Operasi berhasil ditambahkan')
                    directing_url='<?php echo base_url('panel/operasi/ubah/') ?>'+data.id;
                    window.setTimeout(function () {
                        window.location.href = directing_url;
                    }, 2000);
                } else {
                    notif_error('Operasi gagal ditambahkan')
                }
            },
            error: function (response) {
                notif_error('Operasi gagal ditambahkan')
                console.log(response.responseText)
            }
        });
        frm.find('input[type="submit"]').prop('disabled', false);
    });
</script>