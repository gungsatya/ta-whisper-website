<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Kontrol Pola</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Kontrol Pola</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="min-height:125px">
                <h4 class="card-title">Cari ID Percakapan</h4>
                <div class="card-body">
                    <form method="get">
                        <div class="input-group mb-3">
                            <input type="text" placeholder="Masukkan ID Percakapan" name="keyword" class="form-control" aria-label="Text input with dropdown button">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h4 class="card-title">Daftar Status</h4>
                <div class="card-body m-t-10">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th class="">Chat ID</th>
                                    <th class="">Status</th>
                                    <th class="">Operasi</th>
                                    <th class="">Param</th>
                                    <th class="">Pola</th>
                                    <th class="">Pra Survei</th>
                                    <th class="">Survei</th>
                                    <th class="">Pertanyaan</th>
                                    <th class="">Diskusi</th>
                                    <th class="">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($results){ foreach ($results as $data) {?>
                                <tr>
                                    <td>
                                        <?php echo $data['chat_id'] ?></td>
                                    <td>
                                        <?php if($data['current_processed']=="idle"){?> <span class="btn btn-sm btn-success">Idle</span>
                                        <?php } else if($data['current_processed']=="discussion"){?> <span class="btn btn-sm btn-warning">Diskusi</span>
                                        <?php } else if($data['current_processed']=="operation"){?> <span class="btn btn-sm btn-danger">Operasi</span>
                                        <?php } else if($data['current_processed']=="survey"){?> <span class="btn btn-sm btn-info">Survei</span>
                                        <?php } else {?> <span class="btn btn-sm btn-primary">Pra Survei</span>
                                        <?php }?> </td>
                                    <td>
                                        <?php echo $data['in_syntax'] ?></td>
                                    <td>
                                        <?php echo $data['param_in'] ?></td>
                                    <td>
                                        <?php if($data['current_pattern_id'] != null) {?><a class='btn btn-sm btn-outline-secondary' href="<?php echo base_url('panel/pola/detail/'.$data['current_pattern_id'])?>" target="_blank"><?php echo $data['current_pattern_id'] ?></a><?php } ?></td>
                                    <td>
                                        <?php if($data['temp_survey_id'] != null) {?><a class='btn btn-sm btn-outline-secondary' href="<?php echo base_url('panel/survei/hasil/'.$data['temp_survey_id'])?>" target="_blank"><?php echo $data['temp_survey_id'] ?></a><?php } ?></td>
                                    <td>
                                        <?php if($data['current_survey_id'] != null) {?><a class='btn btn-sm btn-outline-secondary' href="<?php echo base_url('panel/survei/hasil/'.$data['current_survey_id'])?>" target="_blank"><?php echo $data['current_survey_id'] ?></a><?php } ?></td>
                                    <td>
                                        <?php echo $data['current_survey_question_id'] ?></td>
                                    <td>
                                        <?php if($data['current_report_discussion_token'] != null) {?><a class='btn btn-sm btn-outline-secondary' href="<?php echo base_url('panel/pengaduan/detail/'.$data['report_id'])?>" target="_blank"><?php echo $data['current_report_discussion_token'] ?></a><?php } ?>
                                        </td>
                                    <td>
                                        <button class="btn btn-sm btn-info clearBtn" data-toggle="tooltip" data-placement="top" title="Clear Pola" data-row-chat-id="<?php echo $data['chat_id'] ?>"> <i class="fa fa-refresh"></i> </button>
                                    </td>
                                </tr>
                                <?php }} ?> </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <?php echo $links ?> </div>
            </div>
        </div>
    </div>
</div>