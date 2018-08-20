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

    function appendChatUser(chat_id, created_at, content) {
        $(".direct-chat-messages").append(
            '<div class="direct-chat-msg col-md-7 p-10 right pull-right"> <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">' +
            chat_id +
            '<span class="badge badge-success">user</span> </span> <span class="direct-chat-timestamp pull-right">' +
            created_at +
            '</span> </div> <img class="direct-chat-img" src="https://bootdey.com/img/Content/user_1.jpg" alt="Message User Image"> <div class="direct-chat-text">' +
            content + '</div> </div>');
    }

    function appendChatAdmin(sender_name, privilege, created_at, content) {
        $(".direct-chat-messages").append(
            '<div class="direct-chat-msg col-md-7 p-10 pull-left"> <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">' +
            sender_name + '<span class="badge badge-danger">' + privilege +
            '</span> </span> <span class="direct-chat-timestamp pull-right">' +
            created_at +
            '</span> </div> <img class="direct-chat-img" src="https://bootdey.com/img/Content/user_1.jpg" alt="Message User Image"> <div class="direct-chat-text">' +
            content + '</div> </div>');
    }

    function goBottomChat() {
        $(document).ready(function() {
            $('.direct-chat-messages').animate({
                scrollTop: $('.direct-chat-messages').get(0).scrollHeight
            }, 2000);
        });
    }

    function refresh() {
        last_row_id = $('input[name="last-row-id"]').val();
        token = $('input[name="token"]').val();
        chat_id = $('input[name="chat_id"]').val();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url('req/report/refresh') ?>",
            data: {
                last_row_id: last_row_id,
                token: token,
                chat_id: chat_id
            },
            cache: false,
            success: function(response) {
                var data = $.parseJSON(response);
                if (data.last_msg) {
                    tmp = 0
                    $('input[name="last-row-id"]').val(data.last_msg[0].id)
                    $.each(data.last_msg.reverse(), function(i, msg) {
                        tmp += 1
                        if (msg.privilege == 'user') {
                            appendChatUser(msg.chat_id, msg.created_at, msg.content)
                        } else {
                            appendChatAdmin(msg.sender_name, msg.privilege, msg.created_at, msg.content)
                        }
                    })
                    $('.new-msg').html(tmp + ' pesan baru')
                    goBottomChat()
                }
                $('.current_processed').html(data.pattern_control.current_processed)
                if (data.pattern_control.current_processed == 'idle') {
                    $('.current_processed').removeClass('badge-success badge-danger');
                    $('.current_processed').addClass('badge-success');
                    $('#stopDiscuss').removeClass('hidden');
                    $('#startDiscuss').removeClass('hidden');
                    $('#stopDiscuss').addClass('hidden');
                    $('#addRespon :input').prop("disabled", true);
                } else {
                    $('.current_processed').removeClass('badge-success badge-danger');
                    $('.current_processed').addClass('badge-danger');
                    if (data.pattern_control.current_processed == 'discussion') {
                        if (data.pattern_control.current_report_discussion_token == token) {
                            $('#stopDiscuss').removeClass('hidden');
                            $('#startDiscuss').removeClass('hidden');
                            $('#startDiscuss').addClass('hidden');
                            $('#addRespon :input').prop("disabled", false);
                        }
                    } else {
                        $('#stopDiscuss').removeClass('hidden');
                        $('#startDiscuss').removeClass('hidden');
                        $('#stopDiscuss').addClass('hidden');
                        $('#addRespon :input').prop("disabled", true);
                    }
                }
            },
            error: function(response) {
                console.log(response.responseText)
            }
        })
    }

    $(document).ready(function() {
        setInterval("refresh()", 2000);
        goBottomChat()
    });

    $('#startDiscuss').on('click', function() {
        token = $('input[name="token"]').val();
        chat_id = $('input[name="chat_id"]').val();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url('req/discuss/start') ?>",
            data: {
                token: token,
                chat_id: chat_id
            },
            cache: false,
            success: function(response) {
                var data = $.parseJSON(response);
                console.log(data)
                if (data.ok) {
                    notif_success("Diskusi telah dimulai")
                } else {
                    notif_error("Diskusi gagal dimulai")
                }
            },
            error: function(response) {
                notif_error("Diskusi gagal dimulai")
                console.log(response.responseText)
            }
        })
    })

    $('#stopDiscuss').on('click', function() {
        token = $('input[name="token"]').val();
        chat_id = $('input[name="chat_id"]').val();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url('req/discuss/stop') ?>",
            data: {
                token: token,
                chat_id: chat_id
            },
            cache: false,
            success: function(response) {
                console.log(response.responseText)
                var data = $.parseJSON(response);
                if (data.ok) {
                    notif_success("Diskusi telah dihentikan")
                } else {
                    notif_error("Diskusi gagal dihentikan")
                }
            },
            error: function(response) {
                notif_error("Diskusi gagal dihentikan")
                console.log(response.responseText)
            }
        })
    })

    $('#addRespon').submit(function(e) {
        e.preventDefault();
        frm = $('#addRespon');
        frm.find('input[type="submit"]').prop('disabled', true);
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
                if (!data.ok) {
                    swal("Gagal", "Gagal menambahkan respon", "error");
                }
                frm.find('input[name="content"]').val('')
            },
            error: function(response) {
                swal("Gagal", "Gagal menambahkan respon", "error");
                console.log(response.responseText)
            }
        });
        frm.find('input[type="submit"]').prop('disabled', false);
    });

    $('select[name="status"]').change(function (e){  
        e.preventDefault();
        frm = $('#changeStatus');
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            datatype: "json",
            cache: false,
            success: function(response) {
                data = $.parseJSON(response);
                console.log(data)
                if (data.ok) {
                    notif_success('Status sudah diganti')
                }
                else{
                    notif_error('Eror mengganti status')
                }
            },
            error: function(response) {
                notif_error('Eror mengganti status')
                console.log(response.responseText)
            }
        });
    })
</script>