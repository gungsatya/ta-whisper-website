<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("assets/panel/images/logo.png") ?>">
    <title>Whisper Panel</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/panel/css/lib/toastr/toastr.min.css" />
    <link href="<?php echo base_url()?>assets/panel/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/panel/css/helper.css" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar">
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- Main wrapper  -->
    <div id="main-wrapper">

        <div class="unix-login">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="login-content card">
                            <div class="login-form">
                                <!-- <h4>Masuk</h4> -->
                                <div class="text-center mb-5">
                                    <h3>Hello, Administrator.</h3>
                                    <img src="<?php echo base_url()?>assets/panel/images/logo-text.png" alt="homepage" class="d-inline-block align-top" />
                                </div>
                                <form id="signin" method="post" action="<?php echo base_url()?>auth/login" class="form-horizontal" enctype="multipart/form-data"
                                    accept-charset="utf-8">
                                    <div class="form-group">
                                        <label>Akun</label>
                                        <input name="usr_acc" type="text" class="form-control" placeholder="...">
                                    </div>
                                    <div class="form-group">
                                        <label>Kata Sandi</label>
                                        <input name="passwd" type="password" class="form-control" placeholder="...">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <img id="captcha" src="captcha" alt="Captcha" class="img-fluid">
                                        </div>
                                        <div class="col-6">
                                            <input id="captcha_code" name="secret_code" type="text" class="form-control input-sm" placeholder="Masukkan captcha">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Masuk</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>


    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url()?>assets/panel/js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url()?>assets/panel/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url()?>assets/panel/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url()?>assets/panel/js/custom.min.js"></script>

    <script src="<?php echo base_url()?>assets/panel/js/lib/toastr/toastr.min.js"></script>
    <script type="text/javascript">
        $("#signin").submit(function (e) {
            var frm = $('#signin');
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: frm.serialize(),
                datatype: "json",
                cache: false,
                success: function (response) {
                    console.log(response)
                    data = $.parseJSON(response);
                    if (data.ok) {
                        window.location.href="<?php echo base_url('panel') ?>";
                    } else {
                        toastr.error(data.message, 'GAGAL !', {
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
                        document.getElementById('captcha').src = 'captcha';
                        document.getElementById('captcha_code').value = '';
                    }
                }
            });
            e.preventDefault();
        });
    </script>


</body>

</html>