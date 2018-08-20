<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Buat Survei</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="javascript:void(0)">Survei</a> </li>
            <li class="breadcrumb-item active">Buat baru</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div id="accordion">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body m-t-15">
                        <form id="add_survey" method="post" action="<?php echo base_url('req/survey/add')?>" class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8">
                            <div class="form-group">
                                <label>Judul</label>
                                <input class="form-control" type="text" name="title" placeholder="Masukkan judul" required> </div>
                            <div class="form-group">
                                <label>Penjelasan</label>
                                <textarea name="explanation" class="textarea_editor form-control" rows="15" placeholder="Masukkan penjelasan" style="height:150px" required></textarea>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Survei berakhir</label>
                                <input class="form-control datetimepicker" type="text" name="due_at" placeholder="Masukkan waktu berakhir" required> </div>
                            <div class="table-responsive">
                                <table class="table" id="survey_question">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="w-40">Pertanyaan</th>
                                            <th class="w-15">Jenis</th>
                                            <th class="w-40">Jawaban</th>
                                            <th class="w-5">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input class="form-control" type="text" name="sq_question[]" placeholder="Masukkan pertanyaan survei" required> </td>
                                            <td>
                                                <select name="sq_is_closed[]" class="form-control" required>
                                                    <option value="" disabled hidden selected>...</option>
                                                    <option value="0">Terbuka</option>
                                                    <option value="1">Tertutup</option>
                                                </select>
                                            </td>
                                            <td data-toggle="tooltip" data-placement="top" title="Pisahkan dengan tanda koma">
                                                <input name="sq_answers[]" type="text" data-role="tagsinput"> </td>
                                            <td>
                                                <button class="btn btn-danger removeRow" data-toggle="tooltip" data-placement="top" title="Hapus pertanyaan"> <i class="fa fa-minus"></i> </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">
                                                <button class="btn btn-primary btn-block text-white addRow">Tambah Pertanyaan dan Jawaban</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-xs-12" style="height:50px;"></div>
                            <div class="form-group clearfix">
                                <button type="submit" class="btn btn-success pull-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>