<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Ubah Berita</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="javascript:void(0)">Berita</a> </li>
            <li class="breadcrumb-item"> <a href="javascript:void(0)">Daftar berita</a> </li>
            <li class="breadcrumb-item active">Ubah berita</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form id="update_news" method="post" action="<?php echo base_url('req/news/update')?>" class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label>Judul Berita</label>
                            <input class="form-control" type="text" name="title" placeholder="Masukkan judul berita"> </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="category">
                                <option value="" disabled selected hidden>Pilih Kategori</option>
                                <option value="infrastruktur">Infrastruktur</option>
                                <option value="pendidikan">Pendidikan</option>
                                <option value="kesehatan">Kesehatan</option>
                                <option value="administrasi">Administrasi</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Gambar Depan</label>
                            <input class="form-control" type="file" name="banner_img" accept=".jpg, .jpeg, .png, .gif"> </div> <img class="img-thumbnail mb-3" src="<?php echo $data['url_img']?>/<?php echo $data['banner_img']?>" style="width:auto; height:150px">
                        <div class="form-group">
                            <label>Konten</label>
                            <textarea class="textarea_editor form-control" placeholder="<b>Masukkan</b> <i>konten</i>" name="content"></textarea>
                        </div>
                        <div class="form-group clearfix">
                            <button class="btn btn-danger deleteNews" data-row-id="<?php echo $data['id']?>">Hapus</button>
                            <input type="submit" class="btn btn-success pull-right" id="toastr-success-bottom-right"> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>