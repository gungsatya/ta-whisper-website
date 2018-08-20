<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Daftar Survei</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="javascript:void(0)">Survei</a> </li>
            <li class="breadcrumb-item active">Daftar survei</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="min-height:125px">
                <h4 class="card-title">Cari berdasarkan kata kunci</h4>
                <div class="card-body">
                    <form>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <select class="btn btn-outline-primary" name="based">
                                    <option value="" disabled selected>Semua</option>
                                    <option value="title">Judul</option>
                                    <option value="explanation">Penjelasan</option>
                                </select>
                            </div>
                            <input type="text" placeholder="Masukkan kata kunci" name="keyword" class="form-control" aria-label="Text input with dropdown button" disabled>
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
                <h4 class="card-title">Daftar Survei</h4>
                <div class="card-body m-t-10">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th class="w-5">#</th>
                                    <th class="w-25">Judul</th>
                                    <th class="w-30">Penjelasan</th>
                                    <th class="w-20">Durasi</th>
                                    <th class="w-20">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($results){ foreach ($results as $data) {?>
                                <tr>
                                    <td>
                                        <?php echo $data->id; ?></td>
                                    <td> <b><?php echo $data->title; ?></b> </td>
                                    <td>
                                        <?php echo $data->explanation; ?></td>
                                    <td>
                                        <?php echo $data->created_at; ?> /
                                        <?php echo $data->due_at; ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="<?php echo base_url('panel/survei/hasil/'.$data->id) ?>"> <i class="fa fa-search"></i> Hasil</a>
                                        <?php if($this->session->userdata('category')=='all'){?>
                                        <button class="btn btn-sm btn-danger deleteSurvey" data-row-id="<?php echo $data->id; ?>"> <i class="fa fa-trash"></i> Hapus</button>
                                        <?php }?>
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