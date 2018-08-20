<script src="<?php echo base_url('assets/panel/js/tagsinput.js')?>"></script>
<script src="<?php echo base_url('assets/panel/js/lib/toastr/toastr.min.js')?>"></script>
<script src="<?php echo base_url('assets/panel/js/lib/datepicker/jquery.datetimepicker.full.min.js')?>"></script>

<script type="text/javascript">
    $('[data-toggle="tooltip"]').tooltip()
    $('.datetimepicker').datetimepicker({
        format: 'Y-m-d H:i:s',
        minDate:'0',
        minTime:0,
        lang: 'en',
        mask:true,format:'Y-m-d H:i:s'
    });
    $('.addRow').click(function (e) {
        e.preventDefault();
        $('#survey_question > tbody').append(
            '<tr> <td> <input class="form-control" type="text" name="sq_question[]" placeholder="Masukkan pertanyaan survei" required> </td> <td> <select name="sq_is_closed[]" class="form-control" required> <option value="" disabled hidden selected>...</option> <option value="0">Terbuka</option> <option value="1">Tertutup</option> </select> </td> <td data-toggle="tooltip" data-placement="top" title="Pisahkan dengan tanda koma"> <input name="sq_answers[]" type="text" data-role="tagsinput"> </td> <td> <button class="btn btn-danger removeRow" data-toggle="tooltip" data-placement="top" title="Hapus pertanyaan"> <i class="fa fa-minus"></i> </button> </td> </tr>'
        );
        $('[data-toggle="tooltip"]').tooltip()
        $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
    });
    $('#survey_question').on('click', '.removeRow', function () {
        $(this).closest('tr').remove();
    });
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
    $("#add_survey").submit(function (e) {
        e.preventDefault();
        var frm = $('#add_survey');
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response)
                data = $.parseJSON(response)
                if (data.status) {
                    notif_success(data.message)
                    window.setTimeout(function () {
                        window.location.href = "<?php echo base_url('panel/survei') ?>";
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
    });
</script>