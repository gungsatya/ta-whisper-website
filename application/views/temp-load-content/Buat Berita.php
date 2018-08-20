<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Buat Berita</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="javascript:void(0)">Berita</a> </li>
            <li class="breadcrumb-item active"> Buat baru </li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form id="add_news" method="post" action="<?php echo base_url('req/news/add')?>" class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="form-group">
                            <label>Judul Berita</label>
                            <input class="form-control" type="text" name="title" placeholder="Masukkan judul berita"> </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="category">
                                <option value="" disabled selected hidden>Pilih Kategori</option>
                                <?php if($this->session->userdata('category')=='infra' || $this->session->userdata('category')=='all'){?>
                                <option value="infrastruktur">Infrastruktur</option>
                                <?php } if($this->session->userdata('category')=='pend' || $this->session->userdata('category')=='all'){?>
                                <option value="pendidikan">Pendidikan</option>
                                <?php } if($this->session->userdata('category')=='kes' || $this->session->userdata('category')=='all'){?>
                                <option value="kesehatan">Kesehatan</option>
                                <?php } if($this->session->userdata('category')=='adm' || $this->session->userdata('category')=='all'){?>
                                <option value="administrasi">Administrasi</option>
                                <?php } if($this->session->userdata('category')=='lainnya' || $this->session->userdata('category')=='all'){?>
                                <option value="lainnya">Lainnya</option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Gambar Depan</label>
                            <input class="form-control" type="file" name="banner_img" accept=".jpg, .jpeg, .png, .gif"> </div>
                        <div class="form-group">
                            <label>Konten</label>
                            <textarea class="textarea_editor form-control" placeholder="<b>Masukkan</b> <i>konten</i>" name="content"></textarea>
                        </div>
                        <div class="form-group clearfix">
                            <input type="submit" class="btn btn-success pull-right" id="toastr-success-bottom-right"> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>