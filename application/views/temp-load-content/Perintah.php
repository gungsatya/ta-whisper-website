<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Perintah</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Perintah</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="min-height:125px">
                <h4 class="card-title">Cari Berdasarkan ID Percakapan</h4>
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
                <h4 class="card-title">Daftar Perintah</h4>
                <div class="card-body m-t-10">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th class="w-5">#</th>
                                    <th class="w-15">Chat ID</th>
                                    <th class="w-10">Operasi</th>
                                    <th class="w-45">Kueri SQL</th>
                                    <th class="w-10">Bendera</th>
                                    <th class="w-15">Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($results){ foreach ($results as $data) {?>
                                <tr>
                                    <td>
                                        <?php echo $data->id ?></td>
                                    <td>
                                        <?php echo $data->chat_id ?></td>
                                    <td>
                                        <?php echo $data->in_syntax ?></td>
                                    <td>
                                        <?php echo $data->sql_query ?></td>
                                    <td>
                                        <?php if($data->flag=="creating"){?><span class="badge badge-warning">Siap</span>
                                        <?php } else {?><span class="badge badge-success">Selesai</span>
                                        <?php }?> </td>
                                    <td>
                                        <?php echo $data->created_at ?></td>
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