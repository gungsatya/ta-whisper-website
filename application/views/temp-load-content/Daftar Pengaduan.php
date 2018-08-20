<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Daftar Pengaduan</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Pengaduan</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <?php if($this->session->userdata('category')=='all'){?>
        <div class="col-md-7">
            <div class="card" style="min-height:125px">
                <h4 class="card-title">Kategori</h4>
                <div class="card-body button-box text-center">
                    <div class="btn-group-justified"> <a href="<?php echo base_url('panel/pengaduan') ?>" class="btn btn-sm btn-outline-dark">Semua</a> <a href="<?php echo base_url('panel/pengaduan/infrastruktur') ?>" class="btn btn-sm btn-outline-success">Infrastruktur</a> <a href="<?php echo base_url('panel/pengaduan/kesehatan') ?>" class="btn btn-sm btn-outline-warning">Kesehatan</a> <a href="<?php echo base_url('panel/pengaduan/pendidikan') ?>" class="btn btn-sm btn-outline-danger">Pendidikan</a> <a href="<?php echo base_url('panel/pengaduan/administrasi') ?>" class="btn btn-sm btn-outline-info">Administrasi</a> <a href="<?php echo base_url('panel/pengaduan/lainnya') ?>" class="btn btn-sm btn-outline-primary">Lainnya</a> </div>
                </div>
            </div>
        </div>
        <?php }?>
        <div class="col-md-5">
            <div class="card" style="min-height:125px">
                <h4 class="card-title">Cari</h4>
                <div class="card-body">
                    <form>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select class="btn btn-outline-primary" name="based">
                                    <option value="" disabled selected>Berdasarkan</option>
                                    <option value="chat_id">Pengirim</option>
                                    <option value="content">Konten</option>
                                    <option value="is_replied">Belum direspon</option>
                                </select>
                            </div>
                            <input type="text" placeholder="Kata kunci" name="keyword" class="form-control" aria-label="Text input with dropdown button">
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
                <h4 class="card-title">Daftar Pengaduan</h4>
                <div class="card-body m-t-10">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th class="w-5">Token</th>
                                    <th class="w-20">Pengirim <small>(chat_id)</small> </th>
                                    <th class="w-35">Konten</th>
                                    <th class="w-20">Sektor</th>
                                    <th class="w-15">Dibuat</th>
                                    <th class="w-5">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($results){ foreach ($results as $data) {?>
                                <tr>
                                    <td>
                                        <?php echo $data->token ?> </td>
                                    <td> <b>
											<?php echo $data->chat_id ?>
										</b> </td>
                                    <td>
                                        <?php echo $data->content ?> </td>
                                    <td>
                                        <?php if($data->sector=="infrastruktur"){?> <span class="btn btn-sm btn-success">Infrastruktur</span>
                                        <?php } else if($data->sector=="kesehatan"){?> <span class="btn btn-sm btn-warning">Kesehatan</span>
                                        <?php } else if($data->sector=="pendidikan"){?> <span class="btn btn-sm btn-danger">Pendidikan</span>
                                        <?php } else if($data->sector=="administrasi"){?> <span class="btn btn-sm btn-info">Administrasi</span>
                                        <?php } else {?> <span class="btn btn-sm btn-primary">Lainnya</span>
                                        <?php } if(!$data->is_replied){ ?> <span class="btn btn-sm btn-dark">0 Respon</span>
                                        <?php } ?> </td>
                                    <td>
                                        <?php echo $data->created_at ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="<?php echo base_url('panel/pengaduan/detail/'.$data->id) ?>"> <i class="fa fa-search"></i> Detail</a>
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