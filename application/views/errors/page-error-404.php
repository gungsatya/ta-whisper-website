<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Tell the browser to be responsive to screen width -->

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon icon -->

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("assets/panel/images/logo.png") ?>">

    <title>Whisper Panel</title>

    <!-- Bootstrap Core CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
	    crossorigin="anonymous">

    <!-- Custom CSS -->

    <link href="<?php echo base_url("assets/panel/css/helper.css") ?>" rel="stylesheet">

    <link href="<?php echo base_url("assets/panel/css/style.css") ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->

    <!--[if lt IE 9]>

    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<![endif]-->

</head>



<body class="fix-header fix-sidebar">

    <!-- Preloader - style you can find in spinners.css -->

    <div class="preloader">

        <svg class="circular" viewBox="25 25 50 50">

			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>

    </div>

    <!-- Main wrapper  -->

    <div class="error-page" id="wrapper">

        <div class="error-box">

            <div class="error-body text-center">

                <h1>404</h1>

                <h3 class="text-uppercase">Page not found </h3>

                <p class="text-muted m-t-30 m-b-30">Please try after some time</p>

                <a class="btn btn-info btn-rounded waves-effect waves-light m-b-40" href="<?php echo base_url() ?>">Back to home</a> </div>

            <footer class="footer text-center">&copy; Whisper 2018</footer>

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

    <script src="<?php echo base_url("assets/panel/js/jquery.slimscroll.js")?>"></script>

    <!--Menu sidebar -->

    <script src="<?php echo base_url("assets/panel/js/sidebarmenu.js")?>"></script>

    <!--stickey kit -->

    <script src="<?php echo base_url("assets/panel/js/lib/sticky-kit-master/dist/sticky-kit.min.js")?>"></script>

    <!--Custom JavaScript -->

    <script src="<?php echo base_url("assets/panel/js/custom.min.js")?>"></script>



</body>



</html>