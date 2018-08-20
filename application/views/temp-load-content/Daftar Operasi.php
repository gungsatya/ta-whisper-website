<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Daftar Operasi</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="javascript:void(0)">Operasi</a> </li>
            <li class="breadcrumb-item active">Daftar Operasi</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h4 class="card-title">Daftar Operasi</h4>
                <div class="card-body m-t-10">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th class="">#</th>
                                    <th class="">Sintaks</th>
                                    <th class="">Penjelasan</th>
                                    <th class="">Tag</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($results){ foreach ($results as $data) {?>
                                <tr>
                                    <td>
                                        <?php echo $data->id ?></td>
                                    <td>
                                        <?php echo $data->in_syntax ?></td>
                                    <td>
                                        <?php echo $data->explain ?></td>
                                    <td>
                                        <?php if($data->is_sql_command){?> <span class="badge badge-primary">Perintah SQL</span>
                                        <?php } else { ?> <span class="badge badge-primary">Bukan Perintah SQL</span>
                                        <?php } ?>
                                        <?php if($data->is_read_command){?> <span class="badge badge-info">Membaca Hasil</span>
                                        <?php } else { ?> <span class="badge badge-info">Tidak Membaca Hasil</span>
                                        <?php } ?> </td>
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