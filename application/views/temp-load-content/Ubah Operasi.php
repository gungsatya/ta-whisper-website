<!-- Bread crumb -->

<div class="row page-titles">

	<div class="col-md-5 align-self-center">

		<h3 class="text-primary">Ubah Operasi</h3>

	</div>

	<div class="col-md-7 align-self-center">

		<ol class="breadcrumb">

			<li class="breadcrumb-item">Operasi</li>

			<li class="breadcrumb-item active">Ubah</li>

		</ol>

	</div>

</div>

<!-- End Bread crumb -->

<!-- Container fluid  -->

<div class="container-fluid">

	<!-- Start Page Content -->

	<div class="row">

		<div class="col-md-8 offset-md-2">

			<form id="update_operation" method="post" action="<?php echo base_url('req/operation/update')?>" class="form-horizontal" enctype="multipart/form-data" accept-charset="utf-8">

			<input type="hidden" name="id">

			<div class="card">

				<div class="card-header">

					<h4>Data Operasi</h4>

				</div>

				<div class="card-body p-20">

					<div class="form-group">

						<label>Sintaks</label>

						<input type="text" name="in_syntax" class="form-control" placeholder="Masukkan sintaks operasi">

					</div>

					<div class="form-group">

						<label>Penjelasan</label>

						<input type="text" name="explain" class="form-control" placeholder="Masukkan penjelasan dari operasi">

					</div>

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

				<div class="card-footer">

					<a class="btn btn-danger pull-left" href="#">Delete</a>

					<button class="btn btn-warning pull-right" type="submit">Ubah</button>

				</div>

			</div>

			</form>

		</div>

		<div class="col-md-12">

			<div class="card">

				<div class="card-title">

					<h4>Parameter Masukkan</h4>

				</div>

				<div class="card-body">

					<div class="table-responsive">

						<table class="table" id="paramIn">

							<thead>

								<tr>

									<th class="">Urutan</th>

									<th class="">Param</th>

									<th class="">Pertanyaan</th>

									<th class="">Deskripsi</th>

									<th class="">Jawaban</th>

									<th class="">Syarat</th>

									<th class="">Nilai Tetapan</th>

									<th class="">Aksi</th>

								</tr>

							</thead>

							<tbody>

							</tbody>

							<tfoot>

								<tr>

									<td colspan="8">

										<button class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#addParamInModal" type="button">Tambah Parameter Masukkan</button>

									</td>

								</tr>

							</tfoot>

						</table>

					</div>

				</div>

			</div>

		</div>

		<div class="col-md-12">

			<div class="card">

				<div class="card-title">

					<h4>Parameter Keluaran</h4>

				</div>

				<div class="card-body">

					<div class="table-responsive">

						<table class="table" id="paramOut">

							<thead>

								<tr>

									<th class="w-60">Respon</th>

									<th class="w-35">Tipe Respon</th>

									<th class="w-5">Aksi</th>

								</tr>

							</thead>

							<tbody>

								<tr class="hidden">

									<td>

										<input type="text" name="" id="" class="form-control">

									</td>

									<td>

										<select name="" id="" class="form-control">

											<option value="" disabled hidden selected>...</option>

											<option value="">Teks</option>

											<option value="">Lokasi</option>

											<option value="">Foto</option>

										</select>

									</td>

									<td>

										<button class="btn btn-danger">

											<i class="fa fa-minus"></i>

										</button>

									</td>

								</tr>

							</tbody>

							<tfoot>

								<tr>

									<td colspan="3">

										<button class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#addParamOutModal" type="button">Tambah Parameter Keluaran</button>

									</td>

								</tr>

							</tfoot>

						</table>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- End PAge Content -->

</div>

<!-- End Container fluid  -->

<!-- Modal addParamInModal-->

<div id="addParamInModal" class="modal bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<form id="addParamInForm" method="post" class="form-horizontal">

				<div class="modal-header">

					<h3>Tambah Parameter Masukkan</h3>

					<span class="pull-right" id="formProgress"></span>

				</div>

				<div class="modal-body">

					<!-- Tab panes -->

					<div class="tab-content">

						<div id="step-1" class="tab-pane active container-fluid">

							<div class="row">

								<div class="col-12">

									<div class="card bg-light">

										<div class="card-body">

											<div class="form-grup">

												<label for="formStep-1">Urutan ke</label>

												<input name="param_in_order" type="number" class="form-control" id="formStep-1" min="1" max="20" required>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

						<div id="step-2" class="tab-pane container-fluid">

							<div class="row">

								<div class="col-12">

									<div class="card bg-light">

										<div class="card-body">

											<div class="form-grup">

												<label for="formStep-2">Param</label>

												<input name="param_in" type="text" class="form-control" id="formStep-2" minlenght="2" maxlenght="20" required>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

						<div id="step-3" class="tab-pane container-fluid">

							<div class="row">

								<div class="col-md-12">

									<div class="card bg-light">

										<div class="card-body">

											<div class="form-grup">

												<label for="formStep-3">Pertanyaan</label>

												<textarea name="question" class="form-control" id="formStep-3" required></textarea>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

						<div id="step-4" class="tab-pane container-fluid">

							<div class="row">

								<div class="col-md-12">

									<div class="card bg-light">

										<div class="card-body">

											<div class="form-grup">

												<label for="formStep-4">Jenis Jawaban</label>

												<select name="answer_type" class="form-control" id="formStep-4" required>

													<option value="" disabled selected hidden>..</option>

													<option value="Teks">Teks</option>

													<option value="Lokasi">Lokasi</option>

													<option value="Foto">Foto</option>

												</select>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

						<div id="step-5" class="tab-pane container-fluid">

							<div class="row">

								<div class="col-md-12">

									<div class="card bg-light">

										<div class="card-body">

											<div class="form-grup">

												<label for="formStep-5">Pertanyaan Terbuka ?</label>

												<select name="question_type" class="form-control" id="formStep-5" required>

													<option value="" disabled selected hidden>..</option>

													<option value="Terbuka">Ya</option>

													<option value="Tertutup">Tidak</option>

												</select>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

						<div id="step-6" class="tab-pane container-fluid">

							<div class="row">

								<div class="col-md-12">

									<div class="card bg-light">

										<div class="card-title">

											<h5>Jawaban</h5>

										</div>

										<div class="card-body">

											<div class="table-responsive">

												<table class="table table-bordered" id="ansOpt">

													<thead>

														<tr>

															<th class="w-30">Jawaban</th>

															<th class="w-30">Nilai</th>

															<th class="w-30">Tipe Markup</th>

															<th class="w-10">Aksi</th>

														</tr>

													</thead>

													<tbody>

														<tr>

															<td>

																<input type="text" name="ato_jawaban" class="form-control answer_opt">

															</td>

															<td>

																<input type="text" name="ato_nilai" class="form-control answer_opt">

															</td>

															<td>

																<select name="ato_tipe" class="form-control answer_opt">

																	<option value="" disabled hidden selected></option>

																	<option value="text">Teks</option>

																	<option value="location">Lokasi</option>

																</select>

															</td>

															<td>

															</td>

														</tr>

													</tbody>

													<tfoot>

														<tr>

															<td colspan="4">

																<button class="btn btn-block" id="addAnsOpt" type="button">Tambah</button>

															</td>

														</tr>

													</tfoot>

												</table>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

						<div id="step-7" class="tab-pane container-fluid">

							<div class="row">

								<div class="col-md-12">

									<div class="card bg-light">

										<div class="card-body">

											<div class="form-grup">

												<label for="formStep-7">Jawaban Panjang ?</label>

												<select name="is_long_answer" class="form-control" id="formStep-7" required>

													<option value="" disabled selected hidden>..</option>

													<option value="Jawaban Panjang">Ya</option>

													<option value="Jawaban Pendek">Tidak</option>

												</select>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

						<div id="step-8" class="tab-pane container-fluid">

							<div class="row">

								<div class="col-md-12">

									<div class="card bg-light">

										<div class="card-body">

											<div class="form-grup">

												<label for="formStep-8">Parameter Terikat ?</label>

												<select name="is_restricted" class="form-control" id="formStep-8" required>

													<option value="" disabled selected hidden>..</option>

													<option value="Terikat">Ya</option>

													<option value="Tidak Terikat">Tidak</option>

												</select>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

						<div id="step-9" class="tab-pane container-fluid">

							<div class="row">

								<div class="col-md-12">

									<div class="card bg-light">

										<div class="card-body">

											<div class="table-responsive">

												<table class="table table-bordered" id="reqParam">

													<thead>

														<tr>

															<th class="w-45">Parameter</th>

															<th class="w-45">Nilai</th>

															<th class="w-10">Aksi</th>

														</tr>

													</thead>

													<tbody>

														<tr>

															<td>

																<input type="text" name="rp_parameter" class="form-control req_param">

															</td>

															<td>

																<input type="text" name="rp_nilai" class="form-control req_param">

															</td>

															<td>



															</td>

														</tr>

													</tbody>

													<tfoot>

														<tr>

															<td colspan="3">

																<button class="btn btn-block" id="addReqParam" type="button">Tambah</button>

															</td>

														</tr>

													</tfoot>

												</table>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

						<div id="step-10" class="tab-pane container-fluid">

							<div class="row">

								<div class="col-md-12">

									<div class="card bg-light">

										<div class="card-body">

											<div class="form-grup">

												<label for="formStep-10">Ada Nilai Tetapan ?</label>

												<select name="is_buffer_value" class="form-control" id="formStep-10" required>

													<option value="" disabled selected hidden>..</option>

													<option value="Ada Tetapan">Ya</option>

													<option value="Tidak Ada Tetapan">Tidak</option>

												</select>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

						<div id="step-11" class="tab-pane container-fluid">

							<div class="row">

								<div class="col-md-12">

									<div class="card bg-light">

										<div class="card-body">

											<div class="form-grup">

												<label for="formStep-11">Nilai Tetapan</label>

												<input name="default_value" type="text" class="form-control" id="formStep-11">

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

					</div>

					<!-- End Tab panes -->

					<div class="progress">

						<div class="progress-bar bg-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="10">

						</div>

					</div>

				</div>

				<div class="modal-footer">

					<div class="w-100 d-flex justify-content-between">

						<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>

						<div class="btn-group">

							<button class="btn btn-gradient waves-effect" type="button" id="prev">

								<i class="fa fa-chevron-left"></i> Balik

							</button>

							<button class="btn btn-gradient waves-effect" type="button" id="next">

								Lanjut

								<i class="fa fa-chevron-right"></i>

							</button>

						</div>

						<button class="btn btn-primary" type="submit" id="submitForm">Tambahkan</button>

					</div>

				</div>

			</form>

		</div>

	</div>

</div>

<!--End Modal addParamInModal-->

<!--Modal addParamOutModal-->

<div id="addParamOutModal" class="modal bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<form id="addParamOutForm" method="post" class="form-horizontal">

				<div class="modal-header">

					<h3>Tambah Parameter Keluaran</h3>

					<span class="pull-right" id="formProgress"></span>

				</div>

				<div class="modal-body">

					<!-- Tab panes -->

					<div class="tab-content">

						<div id="step-1" class="tab-pane active container-fluid">

							<div class="row">

								<div class="col-12">

									<div class="card bg-light">

										<div class="card-body">

											<div class="form-grup">

												<label for="formStep-1">Respon</label>

												<textarea name="response" class="form-control" id="formStep-1" required></textarea>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

						<div id="step-2" class="tab-pane container-fluid">

							<div class="row">

								<div class="col-12">

									<div class="card bg-light">

										<div class="card-body">

											<div class="form-grup">

												<label for="formStep-2">Tipe Respon</label>

												<select name="response_type" class="form-control" id="formStep-2" required>

													<option value="" disabled hidden selected>...</option>

													<option value="text">Teks</option>

													<option value="location">Lokasi</option>

													<option value="photo">Foto</option>

												</select>

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

					</div>

					<!-- End Tab panes -->

					<div class="progress">

						<div class="progress-bar bg-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="10">

						</div>

					</div>

				</div>

				<div class="modal-footer">

					<div class="w-100 d-flex justify-content-between">

						<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>

						<div class="btn-group">

							<button class="btn btn-gradient waves-effect" type="button" id="prev">

								<i class="fa fa-chevron-left"></i> Balik

							</button>

							<button class="btn btn-gradient waves-effect" type="button" id="next">

								Lanjut

								<i class="fa fa-chevron-right"></i>

							</button>

						</div>

						<button class="btn btn-primary" type="submit" id="submitForm">Tambahkan</button>

					</div>

				</div>

			</form>

		</div>

	</div>

</div>

