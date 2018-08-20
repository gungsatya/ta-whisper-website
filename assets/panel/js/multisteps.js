$(document).ready(function () {

	var minProgress = 1;
	var maxProgress = 11;
	var currentProgress = 1;
	var tmp_ato = 1;

	function changeStep(step) {
		var percent = (parseInt(step) / maxProgress) * 100;

		$('.active').removeClass('active');
		$('a[href$="#step-' + step + '"]').addClass('active');
		$('#step-' + step).addClass('active');
		$('.progress-bar').css({
			width: percent + '%'
		});
		$('#formProgress').text(step + " dari " + maxProgress);

		currentProgress = step;
	};

	function refreshStep() {
		ato_tmp_jawaban = $('#formAddParamIn input[name^="ato_jawaban"]').val('');
		ato_tmp_nilai = $('#formAddParamIn input[name^="ato_nilai"]').val('');
		ato_tmp_tipe = $('#formAddParamIn select[name^="ato_tipe"]').val('');
		rp_tmp_param = $('#formAddParamIn input[name^="rp_parameter"]').val('');
		rp_tmp_nilai = $('#formAddParamIn input[name^="rp_nilai"]').val('');

		param_in_order = $('#formAddParamIn input[name="param_in_order"]').val('');
		param_in = $('#formAddParamIn input[name="param_in"]').val('');
		question = $('#formAddParamIn textarea[name="question"]').val('');

		answer_type = $('#formAddParamIn select[name="answer_type"]').val('');
		question_type = $('#formAddParamIn select[name="question_type"]').val('');
		is_long_answer = $('#formAddParamIn select[name="is_long_answer"]').val('');
		is_restricted = $('#formAddParamIn select[name="is_restricted"]').val('');
		is_buffer_value = $('#formAddParamIn select[name="is_buffer_value"]').val('');
		default_value = $('#formAddParamIn input[name="default_value"]').val('');

		$('.ans-opt-child').remove();
		$('.req_param-child').remove();
		$('#addAnsOpt').attr('disabled', false);
		$('#addReqParam').attr('disabled', false);
		$('#formAddParamIn input').attr('readonly', false);
		$('#formAddParamIn textarea').attr('readonly', false);
		$('#formAddParamIn select').attr('readonly', false);

		changeStep(minProgress);
	};

	$('#formStep-4').change(function () {
		if ($('#formStep-4').val() == "Foto") {
			$('#formStep-5').attr('readonly', true);
			$('#formStep-5').val('Terbuka');

			$('.answer_opt').attr('readonly', true);
			$('.answer_opt').attr('required', false);
			$('.answer_opt').val('');
			$('.ans-opt-child').remove();
			$('#addAnsOpt').attr('disabled', true);

		} else {
			$('#formStep-5').attr('readonly', false);
			$('#formStep-5').val('');

			$('.answer_opt').attr('readonly', false);
			$('.answer_opt').attr('required', true);
			$('#addAnsOpt').attr('disabled', false);
		}
	});
	$('#formStep-5').change(function () {
		if ($('#formStep-5').val() == "Terbuka") {
			$('.answer_opt').attr('readonly', true);
			$('.answer_opt').attr('required', false);
			$('.answer_opt').val('');
			$('.ans-opt-child').remove();
			$('#addAnsOpt').attr('disabled', true);
		} else {
			$('.answer_opt').attr('readonly', false);
			$('.answer_opt').attr('required', true);
			$('#addAnsOpt').attr('disabled', false);
		}
	});
	$('#formStep-8').change(function () {
		if ($('#formStep-8').val() == "Tidak Terikat") {
			$('.req_param').attr('readonly', true);
			$('.req_param').attr('required', false);
			$('.req_param').val('');
			$('.req_param-child').remove();
			$('#formStep-10').val('Tidak Ada Tetapan');
			$('#formStep-10').attr('readonly', true);
			$('#formStep-11').val('');
			$('#formStep-11').attr('readonly', true);
			$('#formStep-11').attr('required', false);
			$('#addReqParam').attr('disabled', true);
		} else {
			$('.req_param').attr('readonly', false);
			$('.req_param').attr('required', true);
			$('#formStep-10').val('');
			$('#formStep-10').attr('readonly', false);
			$('#formStep-11').val('');
			$('#formStep-11').attr('readonly', false);
			$('#formStep-11').attr('required', true);
			$('#addReqParam').attr('disabled', false);
		}
	});
	$('#formStep-10').change(function () {
		if ($('#formStep-10').val() == "Tidak Ada Tetapan") {
			$('#formStep-11').val('');
			$('#formStep-11').attr('disabled', true);
			$('#formStep-11').attr('required', false);
		} else {
			$('#formStep-11').val('');
			$('#formStep-11').attr('disabled', false);
			$('#formStep-11').attr('required', true);
		}
	});

	$('.progress-bar').css({
		width: ((minProgress / maxProgress) * 100) + '%'
	});
	$('#formProgress').text(minProgress + " dari " + maxProgress);

	$('#next').click(function () {
		temp = currentProgress + 1;
		if (temp <= maxProgress) {
			changeStep(temp)
		}
	});
	$('#prev').click(function () {
		temp = currentProgress - 1;
		if (temp >= minProgress) {
			changeStep(temp)
		}
	});
	$('#paramIn').on('click', '.removeParamIn', function () {
		$(this).closest('tr').remove();
	});
	$('#addAnsOpt').click(function () {
		$("#ansOpt > tbody").append('<tr class="ans-opt-child"><td><input type="text" name="ato_jawaban" class="form-control answer_opt"></td><td><input type="text" name="ato_nilai" class="form-control answer_opt"></td><td><select name="ato_tipe" class="form-control answer_opt"><option value="" disabled hidden selected></option><option value="Teks">Teks</option><option value="Lokasi">Lokasi</option></select></td><td><button class="btn btn-sm btn-danger removeAnsOpt" type="button"><i class="fa fa-minus"></i></button></td></tr>');
	});
	$('#ansOpt').on('click', '.removeAnsOpt', function () {
		$(this).closest('tr').remove();
	});
	$('#addReqParam').click(function () {
		$("#reqParam > tbody").append('<tr class="req_param-child"> <td> <input type="text" name="rp_parameter" class="form-control req_param"> </td> <td> <input type="text" name="rp_nilai" class="form-control req_param"> </td> <td> <button class="btn btn-sm btn-danger removeReqParam" type="button"><i class="fa fa-minus"></i></button> </td> </tr>');
	});
	$('#reqParam').on('click', '.removeReqParam', function () {
		$(this).closest('tr').remove();
	});
	$('#formAddParamIn').submit(function (event) {
		frm = $('#formAddParamIn');
		data = frm.serializeArray();
		ato = [];
		ato_tmp_jawaban = $('#formAddParamIn input[name^="ato_jawaban"]').serializeArray();
		ato_tmp_nilai = $('#formAddParamIn input[name^="ato_nilai"]').serializeArray();
		ato_tmp_tipe = $('#formAddParamIn select[name^="ato_tipe"]').serializeArray();
		rp = [];
		rp_tmp_param = $('#formAddParamIn input[name^="rp_parameter"]').serializeArray();
		rp_tmp_nilai = $('#formAddParamIn input[name^="rp_nilai"]').serializeArray();

		param_in_order = $('#formAddParamIn input[name="param_in_order"]').serializeArray()[0]['value'];
		param_in = $('#formAddParamIn input[name="param_in"]').serializeArray()[0]['value'];
		question = $('#formAddParamIn textarea[name="question"]').serializeArray()[0]['value'];

		answer_type = $('#formAddParamIn select[name="answer_type"]').serializeArray()[0]['value'];
		question_type = $('#formAddParamIn select[name="question_type"]').serializeArray()[0]['value'];
		is_long_answer = $('#formAddParamIn select[name="is_long_answer"]').serializeArray()[0]['value'];
		is_restricted = $('#formAddParamIn select[name="is_restricted"]').serializeArray()[0]['value'];

		default_value = '';
		is_buffer_value = 'Tidak Terikat';
		answer_text_option = '[]';
		require_param = '[]';

		if (question_type == 'Tertutup') {
			$.each(ato_tmp_jawaban, function (i, v) {
				ato.push({
					'answer': ato_tmp_jawaban[i]['value'],
					'val': ato_tmp_nilai[i]['value'],
					'markup_type': ato_tmp_tipe[i]['value']
				});
			});
			answer_text_option = JSON.stringify(ato);
		}
		if (is_restricted == 'Terikat') {
			$.each(rp_tmp_param, function (i, v) {
				rp.push({
					'param': rp_tmp_param[i]['value'],
					'value': rp_tmp_nilai[i]['value']
				});
			});
			require_param = JSON.stringify(rp);
			is_buffer_value = $('#formAddParamIn select[name="is_buffer_value"]').serializeArray()[0]['value'];

			if (is_buffer_value == 'Ada Tetapan') {
				default_value = $('#formAddParamIn input[name="default_value"]').serializeArray()[0]['value'];
			}
		}
		description = '' + answer_type + '|' + question_type + '|' + is_long_answer + '|' + is_restricted + '|' + is_buffer_value;

		$("#paramIn > tbody").append('<tr> <td> <input id="param_in_order' + tmp_ato + '" readonly type="number" name="param_in_order" class="form-control"> </td> <td> <input id="param_in' + tmp_ato + '" readonly type="text" name="param_in" class="form-control"> </td> <td> <input id="question' + tmp_ato + '" readonly type="text" name="question" class="form-control"> </td> <td> <input id="description' + tmp_ato + '" readonly type="text" name="description" class="form-control"> </td> <td> <input id="answer_text_option' + tmp_ato + '" readonly type="text" name="answer_text_option" class="form-control"> </td> <td> <input id="require_param' + tmp_ato + '" readonly type="text" name="require_param" class="form-control"> </td> <td> <input id="default_value' + tmp_ato + '" readonly type="text" name="default_value" class="form-control"> </td> <td> <button class="btn btn-danger"> <i class="fa fa-minus removeParamIn"></i> </button> </td> </tr>');
		$('#param_in_order' + tmp_ato).val(param_in_order);
		$('#param_in' + tmp_ato).val(param_in);
		$('#question' + tmp_ato).val(question);
		$('#description' + tmp_ato).val(description);
		$('#answer_text_option' + tmp_ato).val(answer_text_option);
		$('#require_param' + tmp_ato).val(require_param);
		$('#default_value' + tmp_ato).val(default_value);
		tmp_ato += 1;
		refreshStep()
		$('#myModal').modal('toggle');
		event.preventDefault();
	});

	$('#refreshForm').click(function (event) {
		refreshStep();
	});
});
