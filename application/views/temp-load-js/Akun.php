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
</script>

<script type="text/javascript">
    $('#pass2nd').on('keyup', function() {
        if ($(this).val() == $('#pass').val()) {
            $('#message').html('Konfirmasi Password Cocok').css('color', 'green');
        } else {
            $('#message').html('Konfirmasi Password Tidak Cocok').css('color', 'red');
        }
    });

    $('#update_pass2nd').on('keyup', function() {
        if ($(this).val() == $('#update_pass').val()) {
            $('#update_message').html('Konfirmasi Password Cocok').css('color', 'green');
        } else {
            $('#update_message').html('Konfirmasi Password Tidak Cocok').css('color', 'red');
        }
    });

    $("#add_account").submit(function(e) {
        e.preventDefault();
        var frm = $('#add_account');
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response)
                data = $.parseJSON(response);
                if (data.status) {
                    notif_success(data.message)
                    window.setTimeout(function() {
                        window.location.href = "<?php echo base_url('panel/akun') ?>";
                    }, 2000);
                } else {
                    notif_error(data.message)
                }
            },
            error: function(response) {
                notif_error("Kesalahan jaringan")
                console.log(response.responseText)
            }
        });
    });

    $(".changeAcc").click(function(e) {
        e.preventDefault();

        $('.tab-pane').removeClass('active');
        $('.nav-link').removeClass('active disabled');

        $('#update_tab').addClass('active');
        $('#update_content').addClass('active');

        id = $(this).data('row-id');

        $('#update_account').find('input:text').val('');
        $('#update_account').find('select').val('');


        $.ajax({
            type: "post",
            url: "<?php echo base_url('req/acc') ?>",
            data: {
                id: id
            },
            datatype: "json",
            cache: false,
            success: function(response) {
                response = $.parseJSON(response);
                if (response.ok) {
                    $('#update_account').find('input[name="id"]').val(response.acc.id);
                    $('#update_account').find('input[name="surename"]').val(response.acc.surename);
                    $('#update_account').find('select[name="privilege"]').val(
                        response.acc.privilege);
                    $('#update_account').find('select[name="category"]').val(
                        response.acc.category);
                };
            }
        });

        $('html, body').animate({
            scrollTop: $("#update_tab").offset().top
        }, 1000);
    });

    $("#update_account").submit(function(e) {
        e.preventDefault();
        var frm = $('#update_account');
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response)
                data = $.parseJSON(response);
                if (data.status) {
                    notif_success(data.message)
                    window.setTimeout(function() {
                        window.location.href = "<?php echo base_url('panel/akun') ?>";
                    }, 2000);
                } else {
                    notif_error(data.message)
                }
            },
            error: function(response) {
                notif_error("Kesalahan jaringan")
                console.log(response.responseText)
            }
        });
    });

    $(".deleteAcc").click(function(e) {
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
                        url: "<?php echo base_url('req/acc/delete') ?>",
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
                                        "<?php echo base_url('panel/akun') ?>";
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