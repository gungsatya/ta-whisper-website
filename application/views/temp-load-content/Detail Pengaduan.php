<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Detail Pengaduan</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="javascript:void(0)">Pengaduan</a> </li>
            <li class="breadcrumb-item active">Detail Pengaduan</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive p-20">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="3">
                                        <h2 class="text-center">Data Pengaduan</h2>
                                        <h6 class="text-center mb-4">Tgl.
											<?php echo $data['created_at']?>
										</h6> 
									</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="hidden-md-down"> <b>Token</b> </td>
                                    <td class="hidden-md-down">:</td>
                                    <td class="text-left">
                                        <?php echo $data[ 'token'] ?> 
									</td>
                                </tr>
                                <tr>
                                    <td class="hidden-md-down"> <b>Chat_id</b> </td>
                                    <td class="hidden-md-down">:</td>
                                    <td class="text-left">
                                        <?php echo $data[ 'chat_id'] ?> 
									</td>
                                </tr>
                                <tr>
                                    <td class="hidden-md-down"> <b>Kategori</b> </td>
                                    <td class="hidden-md-down">:</td>
                                    <td class="text-left">
                                        <?php if($data[ 'sector']=="infrastruktur" ){?> <span class="btn btn-sm btn-success">Infrastruktur</span>
                                        <?php } else if($data[ 'sector']=="kesehatan" ){?> <span class="btn btn-sm btn-warning">Kesehatan</span>
                                        <?php } else if($data[ 'sector']=="pendidikan" ){?> <span class="btn btn-sm btn-danger">Pendidikan</span>
                                        <?php } else if($data[ 'sector']=="administrasi" ){?> <span class="btn btn-sm btn-info">Administrasi</span>
                                        <?php } else { ?> <span class="btn btn-sm btn-primary">Lainnya</span>
                                        <?php } ?> 
									</td>
                                </tr>
                                <tr>
                                    <td class="hidden-md-down"> <b>Lokasi</b> </td>
                                    <td class="hidden-md-down">:</td>
                                    <td class="text-left">
                                        <a class="btn btn-link" target="_blank" href="https://maps.google.co.id/?q=<?php echo $data['location'] ?>">
                                            <?php echo $data[ 'location'] ?> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="hidden-md-down"> <b>Konten</b> </td>
                                    <td class="hidden-md-down">:</td>
                                    <td class="text-left">
                                        <p class=" text-justify">
                                            <?php echo $data[ 'content'] ?> </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="hidden-md-down"> <b>Gambar</b> </td>
                                    <td class="hidden-md-down">:</td>
                                    <td class="text-left">
                                        <?php if(!$data['is_file']){?> 
                                            <img class="img-thumbnail img-fluid" src="<?php echo base_url("assets/panel/images/img-icon.png") ?>" alt="Gambar" style="max-height:300px">
                                        <?php } else {
                                            $files = explode(PHP_EOL, $data['file_name']);
                                            foreach ($files as $file) { ?>
                                            <img class="img-thumbnail d-inline" src="<?php echo base_url("photos/".$file); ?>" alt="Gambar" style="max-width:200px; max-height:200">
                                        <?php }} ?> 
									</td>
                                </tr>
                                <tr>
                                    <td class="hidden-md-down"> <b>Status</b> </td>
                                    <td class="hidden-md-down">:</td>
                                    <td class="text-left">
                                        <form id="changeStatus" method="post" action="<?php echo base_url('req/report/changestat')?>" enctype="multipart/form-data" accept-charset="utf-8">
                                            <input type="hidden" name="token" value="<?php echo $data['token'] ?>">
                                            <select name="status" class="form-control">
                                                <option value="terdaftar" <?php if($data['status']=='terdaftar'){echo 'selected';}?>>Terdaftar</option>
                                                <option value="didiskusikan" <?php if($data['status']=='didiskusikan'){echo 'selected';}?>>Didiskusikan</option>
                                                <option value="agenda rapat" <?php if($data['status']=='agenda rapat'){echo 'selected';}?>>Agenda rapat</option>
                                                <option value="dilaksanakan" <?php if($data['status']=='dilaksanakan'){echo 'selected';}?>>Dilaksanakan</option>
                                                <option value="ditolak" <?php if($data['status']=='ditolak'){echo 'selected';}?>>Ditolak</option>
                                                <option value="selesai" <?php if($data['status']=='selesai'){echo 'selected';}?>>Selesai</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2">
            <!-- DIRECT CHAT PRIMARY -->
            <div class="card direct-chat direct-chat-primary">
                <input type="hidden" name="last-row-id" value="<?php if ($discussion){ echo $discussion[0]['id']; }else{ echo 0; } ?>">
                <div class="card-header bg-white">
                    <h3 class="card-title">Diskusi
						<span class="pull-right">
							<span class="badge badge-light new-msg"></span>
							<?php if($pattern_control){ if($pattern_control['current_processed']=='idle'){ ?>
							<span class="badge badge-success badge-pill current_processed" style="text-transform:none !important;">
								<?php echo $pattern_control['current_processed'] ?>
							</span>
							<?php }else{ ?>
							<span class="badge badge-danger badge-pill current_processed" style="text-transform:none !important;">
								<?php echo $pattern_control['current_processed'] ?>
							</span>
							<?php }} ?>
							<button class="btn btn-sm btn-secondary hidden" id="startDiscuss">Mulai Diskusi</button>
							<button class="btn btn-sm btn-secondary hidden" id="stopDiscuss">Hentikan Diskusi</button>
						</span>
					</h3> </div>
                <div class="card-body p-r-20">
                    <div class="direct-chat-messages">
                        <?php if ($discussion){$discussion = array_reverse($discussion); foreach ($discussion as $discuss){ if($discuss[ 'privilege']=='user' ){?>
                        <div class="direct-chat-msg col-md-7 p-10 right pull-right">
                            <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">
									<?php echo $discuss['chat_id']?>

									<span class="badge badge-success">
										<?php echo $discuss['privilege']?>
									</span> </span> <span class="direct-chat-timestamp pull-right">
									<?php echo $discuss['created_at']?>
								</span> </div> <img class="direct-chat-img" src="https://bootdey.com/img/Content/user_1.jpg" alt="Message User Image">
                            <div class="direct-chat-text">
                                <?php echo $discuss[ 'content']?> </div>
                        </div>
                        <?php }else{?>
                        <div class="direct-chat-msg col-md-7 p-10 pull-left">
                            <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">
									<?php echo $discuss['sender_name']?>

									<span class="badge badge-danger">
										<?php echo $discuss['privilege']?>
									</span> </span> <span class="direct-chat-timestamp pull-right">
									<?php echo $discuss['created_at']?>
								</span> </div> <img class="direct-chat-img" src="https://bootdey.com/img/Content/user_1.jpg" alt="Message User Image">
                            <div class="direct-chat-text">
                                <?php echo $discuss[ 'content']?> </div>
                        </div>
                        <?php }}} ?> </div>
                </div>
                <div class="card-footer bg-white">
                    <form id="addRespon" method="post" action="<?php echo base_url('req/response/add') ?>" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="input-group">
                            <input type="hidden" name="token" value="<?php echo $data['token'] ?>">
                            <input type="hidden" name="chat_id" value="<?php echo $data['chat_id'] ?>">
                            <input type="text" name="content" placeholder="Tulis respon" class="form-control" disabled>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-success pull-right" disabled>Kirim </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>