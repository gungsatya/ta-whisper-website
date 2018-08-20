<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $data['title']?>" />
    <meta property="og:site_name" content="Whisper" />
    <meta property="og:url" content="<?php echo base_url($data['news_url']) ?>" />
    <meta property="og:image" itemprop="image" content="<?php echo $data['url_img']?>/<?php echo $data['banner_img']?>" />
    <meta property="article:published_time" content="<?php echo $data['created_at']?>" />
    <meta property="article:author" content="Whisper | <?php echo $data['category']?>" />

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("assets/panel/images/logo.png") ?>">
    <title>Whisper |
        <?php echo $data[ 'title']?>
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url("assets/landing/css/normalize.css ") ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/landing/css/main.css ") ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/landing/css/helper.css ") ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/landing/plugins/simple-line-icons/css/simple-line-icons.css ") ?>">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand">
                <img src="<?php echo base_url("assets/landing/images/logo2.png") ?>" width="30" height="30" class="d-inline-block align-top" alt=""> Whisper
            </a>
            <a class="btn-outline btn-style btn-white btn-sm" href="<?php echo base_url() ?>">Home</a>
        </div>
    </nav>
    <header class="overlay-dark-news" id="news">
        <div class="container">
            <h1><?php echo $data['title']?></h1>
            <h6>Kategori <?php echo $data['category']?> | <?php echo $data['created_at']?></h6>
        </div>
    </header>
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8 offset-md-2">
                    <img class="img-fluid img-thumbnail mx-auto d-block" src="<?php echo $data['url_img']?>/<?php echo $data['banner_img']?>" id="news_cover">
                    <div class="space-50"></div>
                    <div id="summernote">
                        <?php echo $data[ 'content']?>
                        <div class="space-50"></div>
                        <div class="card" id="read_more">
                            <div class="card-header text-center">
                                Baca Juga
                            </div>
                            <div class="list-group list-group-flush">
                                <?php if($related){ foreach ($related as $rand_news) {?>
                                <a class="list-group-item list-group-item-action" href="<?php echo $rand_news->news_url ?>">
                                    <?php echo $rand_news->title ?></a>
                                <?php }} ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <footer class="overlay-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="m-0">&copy; Whisper 2018</p>
                </div>

            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="<?php echo base_url("assets/landing/js/news.js")?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('header#news').css('backgroundImage', 'url(<?php echo $data['url_img']?>/<?php echo $data['banner_img']?>)');
            $('#summernote img').addClass('img-fluid img-thumbnail mx-auto d-block')
        });
    </script>
</body>

</html>