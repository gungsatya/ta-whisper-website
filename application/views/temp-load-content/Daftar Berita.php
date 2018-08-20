<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Daftar Berita</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="javascript:void(0)">Berita</a> </li>
            <li class="breadcrumb-item active">Daftar berita</li>
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
                    <div class="btn-group-justified"> <a href="<?php echo base_url('panel/berita')?>" class="btn btn-sm btn-outline-dark">Semua</a> <a href="<?php echo base_url('panel/berita/infrastruktur')?>" class="btn btn-sm btn-outline-success">Infrastruktur</a> <a href="<?php echo base_url('panel/berita/kesehatan')?>" class="btn btn-sm btn-outline-warning">Kesehatan</a> <a href="<?php echo base_url('panel/berita/pendidikan')?>" class="btn btn-sm btn-outline-danger">Pendidikan</a> <a href="<?php echo base_url('panel/berita/administrasi')?>" class="btn btn-sm btn-outline-info">Administrasi</a> <a href="<?php echo base_url('panel/berita/lainnya')?>" class="btn btn-sm btn-outline-primary">Lainnya</a> </div>
                </div>
            </div>
        </div>
        <?php }?>
        <div class="col-md-5">
            <div class="card" style="min-height:125px">
                <h4 class="card-title">Cari berdasarkan kata kunci</h4>
                <div class="card-body">
                    <form method="get">
                        <div class="input-group mb-3">
                            <input type="text" placeholder="Masukkan kata kunci" name="keyword" class="form-control" aria-label="Text input with dropdown button">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">Search</button>
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
                <h4 class="card-title">Daftar Berita</h4>
                <div class="card-body">
                    <div class="table-responsive m-t-10">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th class="w-5">#</th>
                                    <th class="w-20">Gambar</th>
                                    <th class="w-36">Judul</th>
                                    <th class="w-9">Kategori</th>
                                    <th class="w-15">Dibuat</th>
                                    <th class="w-15">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($results){ foreach ($results as $data) {?>
                                <tr>
                                    <td>
                                        <?php echo $data->id ?></td>
                                    <td> <img class="img-fluid img-thumbnail" src="<?php echo $data->url_img ?>/<?php echo $data->banner_img ?>" alt="Gambar"> </td>
                                    <td>
                                        <?php echo $data->title ?></td>
                                    <td>
                                        <?php if($data->category=="infrastruktur"){?> <span class="btn btn-sm btn-success">Infrastruktur</span>
                                        <?php } else if($data->category=="kesehatan"){?> <span class="btn btn-sm btn-warning">Kesehatan</span>
                                        <?php } else if($data->category=="pendidikan"){?> <span class="btn btn-sm btn-danger">Pendidikan</span>
                                        <?php } else if($data->category=="administrasi"){?> <span class="btn btn-sm btn-info">Administrasi</span>
                                        <?php } else {?> <span class="btn btn-sm btn-primary">Lainnya</span>
                                        <?php }?> </td>
                                    <td>
                                        <?php echo $data->created_at ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="<?php echo base_url('berita/')?><?php echo $data->news_url ?>" target="_blank"> <i class="fa fa-eye"></i> Lihat</a>
                                        <a class="btn btn-sm btn-warning" href="<?php echo base_url('panel/berita/ubah/')?><?php echo $data->id ?>"> <i class="fa fa-edit"></i> Ubah</a>
                                        <button class="btn btn-sm btn-danger deleteNews" data-row-id="<?php echo $data->id ?>"> <i class="fa fa-trash"></i> Hapus</button>
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