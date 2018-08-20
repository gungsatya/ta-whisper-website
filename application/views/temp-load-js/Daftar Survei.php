<script src="<?php echo base_url('assets/panel/js/lib/toastr/toastr.min.js')?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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

    $('select[name="based"]').change(function() {
        if ($('select[name="based"]').val() == '') {
            $('input[name="keyword"]').prop("disabled", true);
            $('option[value=""]').prop("disabled", true);
        } else {
            $('input[name="keyword"]').prop("disabled", false);
            $('option[value=""]').prop("disabled", false);
        }
    });

    $(".deleteSurvey").click(function(e) {
        e.preventDefault();
        id = $(this).data('row-id');
        swal({
                title: "Anda yakin?",
                text: "Setelah menekan 'OK', data akan terhapus",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('req/survey/delete') ?>",
                        data: {
                            id: id
                        },
                        datatype: "json",
                        cache: false,
                        success: function(response) {
                            response = $.parseJSON(response);
                            if (response.ok) {
                                notif_success('Data telah terhapus')
                                window.setTimeout(function() {
                                    window.location.href =
                                        "<?php echo base_url('panel/survei') ?>";
                                }, 2000);
                            };
                        }
                    });
                } else {
                    swal("Perintah dibatalkan");
                }
            });
    });
</script>