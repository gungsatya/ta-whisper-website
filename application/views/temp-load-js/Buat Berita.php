<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<script type="text/javascript">
    $('.textarea_editor').summernote({
        placeholder: 'Masukkan konten',
        tabsize: 2,
        height: 100
    });
</script>

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

    function notif_info(message) {
        toastr.info(message, 'Info', {
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
</script>

<script type="text/javascript">
    $("#add_news").submit(function (e) {
        e.preventDefault();
        frm = $('#add_news');
        notif_info('Proses unggah !');
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
                if (data.status) {
                    notif_success(data.message)
                    window.setTimeout(function () {
                        window.location.href = "<?php echo base_url('panel/berita') ?>";
                    }, 2000);
                } else {
                    notif_error(data.message)
                }
            },
            error: function (response) {
                notif_error("Kesalahan jaringan")
                console.log(response.responseText)
            }
        });
        frm.find('input[type="submit"]').prop('disabled', false);
    });
</script>