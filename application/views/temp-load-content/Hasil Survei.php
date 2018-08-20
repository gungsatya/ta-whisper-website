<?php $color=[ 'bg-primary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info']; ?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Hasil Survei</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="javascript:void(0)">Survei</a> </li>
            <li class="breadcrumb-item"> <a href="javascript:void(0)">Daftar Survei</a> </li>
            <li class="breadcrumb-item active">Hasil</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card bg-warning">
                <h3 class="card-title text-center p-l-20 p-r-20">
					<b>[Survei]</b>
					<?php echo $data['title'] ?>
					<hr>
				</h3>
                <div class="card-body">
                    <p class="text-dark p-l-20 p-r-20">
                        <?php echo $data[ 'explanation'] ?> </p>
                </div>
                <div class="card-footer"> <small>Berakhir pada <?php echo $data['due_at'] ?></small> </div>
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
					<i><?php echo $survey_quest['question'] ?></i> 
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
                            <div class="progress-bar <?php echo $color[$tmp2%5] ?> wow animated progress-animated" style="width: <?php if(!$survey_quest['amount_respond']==0 || !$survey_quest['amount_respond']==null){echo round($result['amount']/$survey_quest['amount_respond']*100);}else{ echo 0; } ?>%; height:6px;" role="progressbar"> <span class="sr-only"><?php if(!$survey_quest['amount_respond']==0 || !$survey_quest['amount_respond']==null){echo round($result['amount']/$survey_quest['amount_respond']*100);}else{ echo 0; } ?></span> </div>
                        </div>
                        <?php $tmp2+=1; }?> </div>
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
                                    <?php foreach ($survey_quest[ 'results'] as $result) {?>
                                    <tr>
                                        <td>
                                            <?php echo $result[ 'answer'] ?> </td>
                                        <td>
                                            <?php echo $result[ 'amount'] ?> </td>
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
                                <?php foreach ($survey_quest[ 'results'] as $result) {?>
                                <tr>
                                    <td>
                                        <?php echo $result[ 'respond'] ?> </td>
                                    <td></td>
                                </tr>
                                <?php }?> </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?> </div>
    <?php $tmp= $tmp + 1; } ?>
</div>