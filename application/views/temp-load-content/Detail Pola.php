<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Detail Pola</h3> 
	</div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="javascript:void(0)">Pola</a> </li>
            <li class="breadcrumb-item active">Detail Pola</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <h2 class="card-title text-center">Data Pola</h2>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="w-20 hidden-md-down"></th>
                                    <th class="w-5 hidden-sm-down"></th>
                                    <th class="w-75"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="hidden-md-down"> <b>ID</b> </td>
                                    <td class="hidden-md-down">:</td>
                                    <td class="text-left">
                                        <?php echo $data[ 'id'] ?> 
									</td>
                                </tr>
                                <tr>
                                    <td class="hidden-md-down"> <b>Chat ID</b> </td>
                                    <td class="hidden-md-down">:</td>
                                    <td class="text-left">
                                        <?php echo $data[ 'chat_id'] ?> 
									</td>
                                </tr>
                                <tr>
                                    <td class="hidden-md-down"> <b>Operasi yang dijalankan</b> </td>
                                    <td class="hidden-md-down">:</td>
                                    <td class="text-left">
                                        <?php echo $data[ 'in_syntax'] ?> 
									</td>
                                </tr>
                                <tr>
                                    <td class="hidden-md-down"> <b>Jenis Operasi</b> </td>
                                    <td class="hidden-md-down">:</td>
                                    <td class="text-left">
                                        <?php if($data[ 'is_sql_command']){?> <span class="badge badge-primary">Perintah SQL</span>
                                        <?php } else { ?> <span class="badge badge-primary">Bukan Perintah SQL</span>
                                        <?php } ?>
                                        <?php if($data[ 'is_read_command']){?> <span class="badge badge-info">Membaca Hasil</span>
                                        <?php } else { ?> <span class="badge badge-info">Tidak Hasil</span>
                                        <?php } ?> 
									</td>
                                </tr>
                                <tr>
                                    <td class="hidden-md-down"> <b>Penjelasan</b> </td>
                                    <td class="hidden-md-down">:</td>
                                    <td class="text-left">
                                        <p class=" text-justify">
                                            <?php echo $data[ 'explain'] ?> </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="hidden-md-down"> <b>Status</b> </td>
                                    <td class="hidden-md-down">:</td>
                                    <td class="text-left">
                                        <?php if($data[ 'flag']=="creating" ){?><span class="badge badge-warning">Pembuatan</span>
                                        <?php } else if($data[ 'flag']=="drop" ){?><span class="badge badge-danger">Dihapus</span>
                                        <?php } else {?><span class="badge badge-success">Selesai</span>
                                        <?php }?> 
									</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <h3 class=" card-title">Parameter Pola</h3>
                <div class=" card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID Pesan Masuk</th>
                                    <th>Parameter Masukkan</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($data_param){ foreach ($data_param as $data) {?>
                                <tr>
                                    <td><?php echo $data->id ?></td>
                                    <td><?php echo $data->message_in_id ?></td>
                                    <td><?php echo $data->param ?></td>
                                    <td><?php echo $data->param_value ?></td>
                                </tr>
                                <?php }} ?> </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>