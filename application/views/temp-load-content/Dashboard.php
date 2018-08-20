<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Dashboard</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="javascript:void(0)">Home</a> </li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-primary p-20">
                <div class="media widget-ten">
                    <div class="media-left meida media-middle"> 
						<span>
							<i class="fa fa-newspaper-o f-s-40"></i>
						</span> 
					</div>
                    <div class="media-body media-text-right">
                        <h2 class="color-white"><?php echo $news_count ?></h2>
                        <p class="m-b-0">Berita</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-pink p-20">
                <div class="media widget-ten">
                    <div class="media-left meida media-middle">
						<span>
							<i class="fa fa-clipboard f-s-40"></i>
						</span> 
					</div>
                    <div class="media-body media-text-right">
                        <h2 class="color-white"><?php echo $report_count ?></h2>
                        <p class="m-b-0">Aduan</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success p-20">
                <div class="media widget-ten">
                    <div class="media-left meida media-middle"> 
						<span>
							<i class="fa fa-gears f-s-40"></i>
						</span> 
					</div>
                    <div class="media-body media-text-right">
                        <h2 class="color-white"><?php echo $command_count ?></h2>
                        <p class="m-b-0">Perintah operasi</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger p-20">
                <div class="media widget-ten">
                    <div class="media-left meida media-middle"> 
						<span>
							<i class="fa fa-user-plus f-s-40"></i>
						</span> 
					</div>
                    <div class="media-body media-text-right">
                        <h2 class="color-white"><?php echo $user_count ?></h2>
                        <p class="m-b-0">Pengguna</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-title">
                    <h4>Grafik Pengaduan</h4> </div>
                <div class="card-body">
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-title">
                    <h4>Daftar Pengaduan</h4> </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($report_list as $report) { ?>
                                <tr>
                                    <td>
                                        <?php echo $report[ 'sector'] ?> </td>
                                    <td>
                                        <?php echo $report[ 'amount'] ?> </td>
                                </tr>
                                <?php }?> </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-title">
                    <h4>Statistik</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan='2' class="text-center bg-light">Rata-rata waktu respon chatbot</td>
                                </tr>
                                <tr>
                                    <td>Lama proses pesan masuk</td>
                                    <td><?php echo number_format($avg_msg_in_proc['avg_finished'], 2) ?> detik</td>
                                </tr>
                                <tr>
                                    <td>Lama kirim pesan keluar</td>
                                    <td><?php echo number_format($avg_msg_out_proc['avg_finished'], 2) ?> detik</td>
                                </tr>
                                <tr>
                                    <td>Lama tunggu respon pengguna</td>
                                    <td><?php echo number_format($avg_usr_respond, 2) ?> detik</td>
                                </tr>
                                <tr>
                                    <td colspan='2' class="text-center bg-light">Rata-rata waktu selesai operasi</td>
                                </tr>
                                <?php foreach ($avg_processed_finish as $data) { ?>
                                <tr>
                                    <td>Operasi <?php echo $data['in_syntax'] ?></td>
                                    <td><?php echo number_format($data['avg_finished'], 2) ?> detik</td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            
        </div>
    </div>
</div>