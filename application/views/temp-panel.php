<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("assets/panel/images/logo.png ") ?>">
    <title>Whisper Panel |
        <?php echo $load_page; ?>
    </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <link href="<?php echo base_url('assets/panel/css/style.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/panel/css/helper.css')?>" rel="stylesheet">
    <link rel="manifest" href="/manifest.json" />
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "380695d9-fee9-4e5b-b67f-f0606625600c",
            });
        });
        OneSignal.push(["sendTags", {
            id: "<?php echo $this->session->userdata('id')?>",
            surename: "<?php echo $this->session->userdata('surename')?>",
            category: "<?php echo $this->session->userdata('category')?>",
            privilege: "<?php echo $this->session->userdata('privilege')?>"
        }]);
    </script>

    <?php require "temp-load-css/".$load_page. ".php" ?>
</head>

<body class="fix-header fix-sidebar">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href=">">
                        <b>
							<img src="<?php echo base_url('assets/panel/images/logo.png')?>" alt="homepage" class="dark-logo d-inline-block align-center" width="30" height="30"/>
						</b>
                        <span>
							<img src="<?php echo base_url('assets/panel/images/logo-text.png')?>" alt="homepage" class="dark-logo" />
						</span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item">
                            <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)">
                                <i class="mdi mdi-menu"></i>
                            </a>
                        </li>
                        <li class="nav-item m-l-10">
                            <a class="nav-link sidebartoggler hidden-sm-down text-muted  " href="javascript:void(0)">
                                <i class="ti-menu"></i>
                            </a>
                        </li>

                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <small><?php echo $this->session->userdata('surename') ?></small>
                                <img src="<?php echo base_url()?>assets/panel/images/users/user.png" alt="user" class="profile-pic" />
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="dropdown-user">
                                    <li>
                                        <a href="<?php echo base_url() ?>auth/logout">
                                            <i class="fa fa-power-off"></i> Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li>
                            <a href="<?php echo base_url('panel') ?>" aria-expanded="false">
                                <i class="fa fa-tachometer"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-label">Website</li>
                        <?php if($this->session->userdata('privilege')=="administrator") { ?>
                        <li>
                            <a href="<?php echo base_url('panel/akun') ?>" aria-expanded="false">
                                <i class="fa fa-user"></i>
                                <span class="hide-menu">Akun</span>
                            </a>
                        </li>
                        <?php } ?>
                        <li>
                            <a class="has-arrow  " href="#" aria-expanded="false">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="hide-menu">Berita</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a href="<?php echo base_url('panel/berita/buatbaru') ?>">Buat baru</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('panel/berita') ?>">Daftar berita</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow  " href="#" aria-expanded="false">
                                <i class="fa fa-line-chart"></i>
                                <span class="hide-menu">Survei</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a href="<?php echo base_url('panel/survei/buatbaru') ?>">Buat baru</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('panel/survei') ?>">Daftar survei</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url('panel/pengaduan?based=is_replied') ?>" aria-expanded="false">
                                <i class="fa fa-clipboard"></i>
                                <span class="hide-menu">Pengaduan</span>
                            </a>
                        </li>
                        <?php if($this->session->userdata('privilege')=="administrator") { ?>
                        <li class="nav-label">Chatterbot</li>
                        <li>
                            <a href="<?php echo base_url('panel/pola/kontrol') ?>" aria-expanded="false">
                                <i class="fa fa-sliders"></i>
                                <span class="hide-menu">Kontrol Pola</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('panel/pola') ?>" aria-expanded="false">
                                <i class="fa fa-code-fork"></i>
                                <span class="hide-menu">Pola</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('panel/perintah') ?>" aria-expanded="false">
                                <i class="fa fa-gears"></i>
                                <span class="hide-menu">Perintah</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('panel/operasi') ?>" aria-expanded="false">
                                <i class="fa fa-gear"></i>
                                <span class="hide-menu">Operasi</span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="page-wrapper">
            <?php require "temp-load-content/".$load_page. ".php" ?>
            <footer class="footer text-center"> Whisper 2018 - © Template designed by <a href="https://colorlib.com">Colorlib</a>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


    <script src="<?php echo base_url('assets/panel/js/jquery.slimscroll.js')?>"></script>
    <script src="<?php echo base_url('assets/panel/js/sidebarmenu.js')?>"></script>
    <script src="<?php echo base_url('assets/panel/js/lib/sticky-kit-master/dist/sticky-kit.min.js')?>"></script>
    <script src="<?php echo base_url('assets/panel/js/custom.min.js')?>"></script>
    <?php require "temp-load-js/".$load_page. ".php" ?>

</body>

</html>