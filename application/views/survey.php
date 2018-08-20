<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="[Survei]<?php echo $data['title'] ?>" />
    <meta name="og:description" content="<?php echo $data['explanation'] ?>">
    <meta property="og:site_name" content="Whisper" />
    <meta property="og:url" content="<?php echo base_url() ?>" />
    <meta property="og:image" itemprop="image" content="<?php echo base_url("assets/panel/images/survei-bg.jpeg ") ?>" />

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("assets/panel/images/logo.png ") ?>">
    <title>Whisper | [Survei]
        <?php echo $data['title'] ?>
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url("assets/landing/css/normalize.css ") ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/landing/css/main.css ") ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/landing/css/helper.css ") ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url()?>assets/panel/css/helper.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url("assets/landing/plugins/simple-line-icons/css/simple-line-icons.css ") ?>">

    <style>
        h5 {
            line-height: 18px;
            font-size: 16px;
            font-weight: 400;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand">
                <img src="<?php echo base_url("assets/landing/images/logo2.png") ?>" width="30" height="30" class="d-inline-block align-top"
                    alt=""> Whisper
            </a>
            <a class="btn-outline btn-style btn-white btn-sm" href="<?php echo base_url() ?>">Home</a>
        </div>
    </nav>
    <header class="overlay-dark-news" id="news">
        <div class="container">
            <h1><b>[Survei]</b> <?php echo $data['title'] ?></h1>
            <p class="text-center">Tanggal
                <?php echo $data[ 'created_at']?>
            </p>
        </div>
    </header>
    <section id="content">
        <div class="container">
            <?php $color=[ 'bg-primary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info']; ?>

            <div class="row">

                <div class="col-md-8 offset-md-2">

                    <div class="card bg-warning">

                        <h3 class="card-title text-center p-l-20 p-r-20">
                            <b>Penjelasan</b>
                        </h3>

                        <div class="card-body">

                            <p class="text-dark p-l-20 p-r-20">
                                <?php echo $data[ 'explanation'] ?>
                            </p>

                        </div>

                        <div class="card-footer">
                            <small>Berakhir pada
                                <?php echo $data['due_at'] ?>
                            </small>
                        </div>

                    </div>

                </div>

            </div>
            <?php $tmp=1; $tmp2=0; foreach ($data_sq as $survey_quest) {?>

            <div class="row">

                <div class="col-md-4">

                    <div class="card bg-dark text-center">

                        <h4 class="text-white">

                                <b>Pertanyaan
                                    <?php echo $tmp ?>
                                </b>

                            </h4>

                        <p class="text-white m-t-5">

                            <i class="fa fa-quote-left"></i>

                            <i>
                                    <?php echo $survey_quest['question'] ?>
                                </i>

                            <i class="fa fa-quote-right"></i>

                        </p>

                    </div>

                </div>

                <?php if($survey_quest[ 'is_closed']){?>

                <div class="col-md-8">
                    <div class="card-deck">

                        <div class="card">

                            <h4 class="card-title text-center text-dark">
                
                                        <b>Respon Pertanyaan
                                            <?php echo $tmp ?>
                                        </b>
                
                                    </h4>

                            <div class="card-body">

                                <?php foreach ($survey_quest[ 'results'] as $result) {?>

                                <h5 class="m-t-30"><?php echo $result['answer'] ?>
                
                                                <span class="pull-right"><?php if(!$survey_quest['amount_respond']==0 || !$survey_quest['amount_respond']==null){echo round($result['amount']/$survey_quest['amount_respond']*100);}else{ echo 0; } ?> % </span>
                
                                            </h5>

                                <div class="progress ">

                                    <div class="progress-bar <?php echo $color[$tmp2%5] ?> wow animated progress-animated" style="width: <?php if(!$survey_quest['amount_respond']==0 || !$survey_quest['amount_respond']==null){echo round($result['amount']/$survey_quest['amount_respond']*100);}else{ echo 0; } ?>%; height:6px;" role="progressbar">

                                        <span class="sr-only"><?php if(!$survey_quest['amount_respond']==0 || !$survey_quest['amount_respond']==null){echo round($result['amount']/$survey_quest['amount_respond']*100);}else{ echo 0; } ?></span>

                                    </div>

                                </div>

                                <?php $tmp2+=1; }?>

                            </div>

                        </div>

                        <div class="card">

                            <h4 class="card-title text-center text-dark">
                                        <b> Detail Respon Pertanyaan
                                            <?php echo $tmp ?>
                                        </b>
                                    </h4>

                            <div class="card-body">

                                <div class="table-responsive">

                                    <table class="table">

                                        <thead>

                                            <tr>

                                                <th>Jawaban</th>

                                                <th>Jumlah</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php foreach ($survey_quest['results'] as $result) {?>
                                            <tr>

                                                <td>
                                                    <?php echo $result['answer'] ?>
                                                </td>

                                                <td>
                                                    <?php echo $result['amount'] ?>
                                                </td>

                                            </tr>
                                            <?php }?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <?php } else {?>

                <div class="col-md-8">

                    <div class="card">

                        <h4 class="card-title text-center text-dark">
                                    <b> Respon Pertanyaan
                                        <?php echo $tmp ?>
                                    </b>
                                </h4>

                        <div class="card-body" style="max-height:250px; overflow: auto;">

                            <div class="table-responsive">

                                <table class="table">

                                    <thead>

                                        <tr>

                                            <th>Jawaban</th>

                                            <th></th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        <?php foreach ($survey_quest['results'] as $result) {?>
                                        <tr>

                                            <td>
                                                <?php echo $result['respond'] ?>
                                            </td>

                                            <td></td>

                                        </tr>
                                        <?php }?>
                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <?php } ?>
            </div>

            <?php $tmp = $tmp + 1; } ?>

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
        $(document).ready(function() {
            $('header#news').css('backgroundImage', 'url(<?php echo base_url("assets/panel/images/survei-bg.jpeg") ?>)');
        });
    </script>
</body>

</html>