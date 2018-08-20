<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Akun</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Akun</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="min-height:125px">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" id="add_tab" href="#add_content" data-toggle="tab" role="tab" aria-controls="add_content">Tambah Akun</a> </li>
                        <li class="nav-item"> <a class="nav-link disabled" id="update_tab" href="#update_content" data-toggle="tab" role="tab" aria-controls="update_content">Perbarui Akun</a> </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="add_content" role="tabpanel" aria-labelledby="add_tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12 mt-5 mb-1">
                                        <form id="add_account" method="post" action="<?php echo base_url('req/acc/add')?>" class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input name="surename" type="text" class="form-control" placeholder="..." required="required"> </div>
                                            <div class="form-group">
                                                <label>Privilege</label>
                                                <select name="privilege" class="form-control" required="required">
                                                    <option value="" disabled hidden selected>...</option>
                                                    <option value="administrator">Administrator</option>
                                                    <option value="operator">Operator</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select name="category" class="form-control" required="required">
                                                    <option value="" disabled hidden selected>...</option>
                                                    <?php if($this->session->userdata('category')=='all'){?>
                                                    <option value="all">Semua</option>
                                                    <?php } if($this->session->userdata('category')=='adm' || $this->session->userdata('category')=='all'){?>
                                                    <option value="adm">Administrasi</option>
                                                    <?php } if($this->session->userdata('category')=='infra' || $this->session->userdata('category')=='all'){?>
                                                    <option value="infra">Infrastruktur</option>
                                                    <?php } if($this->session->userdata('category')=='kes' || $this->session->userdata('category')=='all'){?>
                                                    <option value="kes">Kesehatan</option>
                                                    <?php } if($this->session->userdata('category')=='pend' || $this->session->userdata('category')=='all'){?>
                                                    <option value="pend">Pendidikan</option>
                                                    <?php } if($this->session->userdata('category')=='lainnya' || $this->session->userdata('category')=='all'){?>
                                                    <option value="lainnya">Lainnya</option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Akun</label>
                                                <input required="required" name="usr_acc" type="text" class="form-control" placeholder="..."> </div>
                                            <div class="form-group">
                                                <label>Kata Sandi</label>
                                                <input class="form-control" placeholder="..." name="password" id="pass" required="required" type="password"> </div>
                                            <div class="form-group">
                                                <label>Ulang Kata Sandi</label>
                                                <input class="form-control" placeholder="..." name="passconf" id="pass2nd" required="required" type="password"> <span id='message' style="color:white">.</span> </div>
                                            <div class="form-group">
                                                <input class="btn btn-success pull-right" type="submit"> </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="update_content" role="tabpanel" aria-labelledby="update_tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12 mt-5 mb-1">
                                        <form id="update_account" method="post" action="<?php echo base_url('req/acc/update')?>" class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8">
                                            <div class="form-group hidden">
                                                <label>Id Akun</label>
                                                <input name="id" type="text" class="form-control" value="1" readonly required="required"> </div>
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input name="surename" type="text" class="form-control" placeholder="..." required="required"> </div>
                                            <div class="form-group">
                                                <label>Privilege</label>
                                                <select name="privilege" class="form-control" required="required">
                                                    <option value="" disabled hidden selected>...</option>
                                                    <option value="administrator">Administrator</option>
                                                    <option value="operator">Operator</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select name="category" class="form-control" required="required">
                                                    <option value="" disabled hidden selected>...</option>
                                                    <?php if($this->session->userdata('category')=='all'){?>
                                                    <option value="all">Semua</option>
                                                    <?php } if($this->session->userdata('category')=='adm' || $this->session->userdata('category')=='all'){?>
                                                    <option value="adm">Administrasi</option>
                                                    <?php } if($this->session->userdata('category')=='infra' || $this->session->userdata('category')=='all'){?>
                                                    <option value="infra">Infrastruktur</option>
                                                    <?php } if($this->session->userdata('category')=='kes' || $this->session->userdata('category')=='all'){?>
                                                    <option value="kes">Kesehatan</option>
                                                    <?php } if($this->session->userdata('category')=='pend' || $this->session->userdata('category')=='all'){?>
                                                    <option value="pend">Pendidikan</option>
                                                    <?php } if($this->session->userdata('category')=='lainnya' || $this->session->userdata('category')=='all'){?>
                                                    <option value="lainnya">Lainnya</option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Akun</label>
                                                <input name="usr_acc" type="text" class="form-control" placeholder="Kosongkan jika tidak ingin merubah akun"> </div>
                                            <div class="form-group">
                                                <label>Kata Sandi</label>
                                                <input class="form-control" placeholder="Kosongkan jika tidak ingin merubah kata sandi" name="password" id="update_pass" type="password"> </div>
                                            <div class="form-group">
                                                <label>Ulang Kata Sandi</label>
                                                <input class="form-control" placeholder="Kosongkan jika tidak ingin merubah kata sandi" name="passconf" id="update_pass2nd" type="password"> <span id='update_message' style="color:white">.</span> </div>
                                            <div class="form-group">
                                                <input class="btn btn-warning pull-right" type="submit"> </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h4 class="card-title">Daftar Akun</h4>
                <div class="card-body m-t-10">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="account-table">
                            <thead>
                                <tr class="text-center">
                                    <th class="w-5">#</th>
                                    <th class="w-20">Nama</th>
                                    <th class="w-15">Akun</th>
                                    <th class="w-15">Previlege</th>
                                    <th class="w-15">Kategori</th>
                                    <th class="w-15">Dibuat pada</th>
                                    <?php if($this->session->userdata('category')=='all'){?>
                                    <th class="w-25">Aksi</th>
                                    <?php }?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($results){ foreach ($results as $data) { ?>
                                <tr data-row-id="<?php echo $data->id ?>">
                                    <td data-fields="id-<?php echo $data->id ?>">
                                        <?php echo $data->id ?> </td>
                                    <td data-fields="surename-<?php echo $data->id ?>">
                                        <?php echo $data->surename ?> </td>
                                    <td data-fields="user_identifier-<?php echo $data->id ?>">
                                        <?php echo $data->user_identifier ?> </td>
                                    <td data-fields="privilege-<?php echo $data->id ?>">
                                        <?php if($data->privilege=="administrator"){ ?> <span class="badge badge-danger badge-pill" style="text-transform:none !important;">Administrator</span>
                                        <?php }else{ ?> <span class="badge badge-warning badge-pill" style="text-transform:none !important;">Operator</span>
                                        <?php }?> </td>
                                    <td data-fields="category-<?php echo $data->id ?>">
                                        <?php if($data->category=="all"){ ?> <span class="btn btn-sm btn-danger">Semua</span>
                                        <?php }else if($data->category=="infra"){ ?> <span class="btn btn-sm btn-primary">Infrastruktur</span>
                                        <?php }else if($data->category=="kes"){ ?> <span class="btn btn-sm btn-success">Kesehatan</span>
                                        <?php }else if($data->category=="adm"){ ?> <span class="btn btn-sm btn-warning">Administrasi</span>
                                        <?php }else if($data->category=="pend"){ ?> <span class="btn btn-sm btn-info">Pendidikan</span>
                                        <?php }else{ ?> <span class="btn btn-sm btn-secondary">Lainnya</span>
                                        <?php }?> </td>
                                    <td data-fields="created_at-<?php echo $data->id ?>">
                                        <?php echo $data->created_at ?> </td>
                                    <?php if($this->session->userdata('category')=='all'){?>
                                    <td>
                                        <button class="btn btn-sm btn-warning changeAcc" data-row-id="<?php echo $data->id ?>"><i class="fa fa-edit"></i> Ubah</button>
                                        <button href="#" class="btn btn-sm btn-danger deleteAcc" data-row-id="<?php echo $data->id ?>"><i class="fa fa-trash"></i> Hapus</button>
                                    </td>
                                    <?php }?>
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
