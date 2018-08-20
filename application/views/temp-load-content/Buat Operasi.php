<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Buat Operasi</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Operasi</li>
            <li class="breadcrumb-item active">Buat Baru</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form id="add_operation" method="post" action="<?php echo base_url('req/operation/add')?>" class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Operasi</h4> </div>
                    <div class="card-body p-20">
                        <div class="form-group">
                            <label>Sintaks</label>
                            <input type="text" name="in_syntax" class="form-control" placeholder="Masukkan sintaks operasi"> </div>
                        <div class="form-group">
                            <label>Penjelasan</label>
                            <input type="text" name="explain" class="form-control" placeholder="Masukkan penjelasan dari operasi"> </div>
                        <div class="form-group">
                            <label>Operasi SQL</label>
                            <select name="is_sql_command" class="form-control">
                                <option value="" disabled selected hidden>...</option>
                                <option value="1">SQL</option>
                                <option value="0">Bukan SQL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Operasi Membaca</label>
                            <select name="is_read_command" class="form-control">
                                <option value="" disabled selected hidden>...</option>
                                <option value="1">Operasi untuk membaca data</option>
                                <option value="0">Bukan operasi untuk membaca data</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kueri SQL</label>
                            <textarea name="in_sql" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <button class="btn btn-success pull-right" type="submit">Buat</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>