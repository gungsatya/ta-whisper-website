<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Pengaduan #<?php echo $data['token'] ?>" />
    <meta name="og:description" content="<?php echo $data['content'] ?>">
    <meta property="og:site_name" content="Whisper" />
    <meta property="og:url" content="<?php echo base_url() ?>" />
    <meta property="og:image" itemprop="image" content="<?php echo base_url(" assets/panel/images/logo2.png ") ?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(" assets/panel/images/logo.png ") ?>">
    <title>Whisper | Pengaduan #
        <?php echo $data[ 'token'] ?> </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url("assets/landing/css/normalize.css ") ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/landing/css/main.css ") ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/landing/css/helper.css ") ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/landing/plugins/simple-line-icons/css/simple-line-icons.css ") ?>"> </head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container"> <a class="navbar-brand">
                <img src="<?php echo base_url("assets/landing/images/logo2.png") ?>" width="30" height="30" class="d-inline-block align-top" alt=""> Whisper
            </a> <a class="btn-outline btn-style btn-white btn-sm" href="<?php echo base_url() ?>">Home</a> </div>
    </nav>
    <header class="overlay-dark-news" id="news">
        <div class="container">
            <h1>Pengaduan #<?php echo $data['token'] ?></h1>
            <p class="text-center">Tanggal
                <?php echo $data[ 'created_at']?> </p>
        </div>
    </header>
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8 offset-md-2">
                    <div class="space-50"></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-20">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="3">
                                                <h2 class="text-center">Data Pengaduan</h2> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="hidden-md-down"> <b>Token</b> </td>
                                            <td class="hidden-md-down">:</td>
                                            <td class="text-left">
                                                <?php echo $data[ 'token'] ?> </td>
                                        </tr>
                                        <tr>
                                            <td class="hidden-md-down"> <b>Chat_id</b> </td>
                                            <td class="hidden-md-down">:</td>
                                            <td class="text-left">
                                                <?php echo $data[ 'chat_id'] ?> </td>
                                        </tr>
                                        <tr>
                                            <td class="hidden-md-down"> <b>Kategori</b> </td>
                                            <td class="hidden-md-down">:</td>
                                            <td class="text-left">
                                                <?php if($data[ 'sector']=="infrastruktur" ){?> <span class="badge badge-success">Infrastruktur</span>
                                                <?php } else if($data[ 'sector']=="kesehatan" ){?> <span class="badge badge-warning">Kesehatan</span>
                                                <?php } else if($data[ 'sector']=="pendidikan" ){?> <span class="badge badge-danger">Pendidikan</span>
                                                <?php } else if($data[ 'sector']=="administrasi" ){?> <span class="badge badge-info">Administrasi</span>
                                                <?php } else { ?> <span class="badge badge-primary">Lainnya</span>
                                                <?php } ?> </td>
                                        </tr>
                                        <tr>
                                            <td class="hidden-md-down"> <b>Lokasi</b> </td>
                                            <td class="hidden-md-down">:</td>
                                            <td class="text-left">
                                                <a class="btn btn-link" target="_blank" href="https://maps.google.co.id/?q=<?php echo $data['location'] ?>">
                                                    <?php echo $data[ 'location'] ?> </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="hidden-md-down"> <b>Konten</b> </td>
                                            <td class="hidden-md-down">:</td>
                                            <td class="text-left">
                                                <p class=" text-justify">
                                                    <?php echo $data[ 'content'] ?> </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="hidden-md-down"> <b>Gambar</b> </td>
                                            <td class="hidden-md-down">:</td>
                                            <td class="text-left">
                                                <?php if(!$data['is_file']){?> 
                                                    <img class="img-thumbnail img-fluid" src="<?php echo base_url("assets/panel/images/img-icon.png") ?>" alt="Gambar" style="max-height:300px">
                                                <?php } else {
                                                    $files = explode(PHP_EOL, $data['file_name']);
                                                    foreach ($files as $file) { ?>
                                                    <img class="img-thumbnail d-inline" src="<?php echo base_url("photos/".$file); ?>" alt="Gambar" style="max-width:200px; max-height:200">
                                                <?php }} ?> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="hidden-md-down"> <b>Status</b> </td>
                                            <td class="hidden-md-down">:</td>
                                            <td class="text-left">
                                                <p class=" text-justify">
                                                    <?php echo $data[ 'status'] ?> </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="space-50"></div>
                </div>
            </div>
        </div>
    </section>
    <footer class="overlay-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="m-0">&copy; Wisper 2018</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="<?php echo base_url("assets/landing/js/news.js ")?>"></script>
    <script type="text/javascript">
        $(document).ready(function() { <?php
            if (!$data['is_file']) { ?> 
                $('header#news').css('backgroundImage', 'url(<?php echo base_url("assets/panel/images/img-icon.png") ?>)'); 
            <?php } else { ?> 
                $('header#news').css('backgroundImage', 'url(<?php echo base_url("photos/".$files[0]) ?>)'); 
            <?php } ?>
        });
    </script>
</body>

</html>