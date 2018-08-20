<script type="text/javascript">

	$(document).ready(function () {

		var minStepParamIn = 1;
		var maxStepParamIn = 11;
		var currentStepParamIn = 1;
		var tmp_param_in = 1;
		var minStepParamOut = 1;
		var maxStepParamOut = 2;
		var currentStepParamOut = 1;
		var tmp_param_out = 1;

		$('#addParamInModal .progress-bar').css({

			width: ((minStepParamIn / maxStepParamIn) * 100) + '%'

		});

		$('#addParamInModal #formProgress').text(minStepParamIn + " dari " + maxStepParamIn);

		function changeStepParamIn(step) {

			var percent = (parseInt(step) / maxStepParamIn) * 100;



			$('#addParamInModal .active').removeClass('active');

			$('#addParamInModal #step-' + step).addClass('active');

			$('#addParamInModal .progress-bar').css({

				width: percent + '%'

			});

			$('#addParamInModal #formProgress').text(step + " dari " + maxStepParamIn);



			currentStepParamIn = step;

		};

		function refreshStepParamIn() {

			$('#addParamInModal input[name^="ato_jawaban"]').val('');

			$('#addParamInModal input[name^="ato_nilai"]').val('');

			$('#addParamInModal select[name^="ato_tipe"]').val('');

			$('#addParamInModal input[name^="rp_parameter"]').val('');

			$('#addParamInModal input[name^="rp_nilai"]').val('');



			$('#addParamInModal input[name="param_in_order"]').val('');

			$('#addParamInModal input[name="param_in"]').val('');

			$('#addParamInModal textarea[name="question"]').val('');



			$('#addParamInModal select[name="answer_type"]').val('');

			$('#addParamInModal select[name="question_type"]').val('');

			$('#addParamInModal select[name="is_long_answer"]').val('');

			$('#addParamInModal select[name="is_restricted"]').val('');

			$('#addParamInModal select[name="is_buffer_value"]').val('');

			$('#addParamInModal input[name="default_value"]').val('');



			$('#addParamInModal .ans-opt-child').remove();

			$('#addParamInModal .req_param-child').remove();

			$('#addParamInModal #addAnsOpt').attr('disabled', false);

			$('#addParamInModal #addReqParam').attr('disabled', false);

			$('#addParamInModal input').attr('readonly', false);

			$('#addParamInModal textarea').attr('readonly', false);

			$('#addParamInModal select').attr('readonly', false);



			changeStepParamIn(minStepParamIn);

		};

		$('#addParamInModal #formStep-4').change(function () {

			if ($('#addParamInModal #formStep-4').val() == "Foto") {

				$('#addParamInModal #formStep-5').attr('readonly', true);

				$('#addParamInModal #formStep-5').val('Terbuka');



				$('#addParamInModal .answer_opt').attr('readonly', true);

				$('#addParamInModal .answer_opt').attr('required', false);

				$('#addParamInModal .answer_opt').val('');

				$('#addParamInModal .ans-opt-child').remove();

				$('#addParamInModal #addAnsOpt').attr('disabled', true);



			} else {

				$('#addParamInModal #formStep-5').attr('readonly', false);

				$('#addParamInModal #formStep-5').val('');



				$('#addParamInModal .answer_opt').attr('readonly', false);

				$('#addParamInModal .answer_opt').attr('required', true);

				$('#addParamInModal #addAnsOpt').attr('disabled', false);

			}

		});

		$('#addParamInModal #formStep-5').change(function () {

			if ($('#addParamInModal #formStep-5').val() == "Terbuka") {

				$('#addParamInModal .answer_opt').attr('readonly', true);

				$('#addParamInModal .answer_opt').attr('required', false);

				$('#addParamInModal .answer_opt').val('');

				$('#addParamInModal .ans-opt-child').remove();

				$('#addParamInModal #addAnsOpt').attr('disabled', true);

			} else {

				$('#addParamInModal .answer_opt').attr('readonly', false);

				$('#addParamInModal .answer_opt').attr('required', true);

				$('#addParamInModal #addAnsOpt').attr('disabled', false);

			}

		});

		$('#addParamInModal #formStep-8').change(function () {

			if ($('#addParamInModal #formStep-8').val() == "Tidak Terikat") {

				$('#addParamInModal .req_param').attr('readonly', true);

				$('#addParamInModal .req_param').attr('required', false);

				$('#addParamInModal .req_param').val('');

				$('#addParamInModal .req_param-child').remove();

				$('#addParamInModal #formStep-10').val('Tidak Ada Tetapan');

				$('#addParamInModal #formStep-10').attr('readonly', true);

				$('#addParamInModal #formStep-11').val('');

				$('#addParamInModal #formStep-11').attr('readonly', true);

				$('#addParamInModal #formStep-11').attr('required', false);

				$('#addParamInModal #addReqParam').attr('disabled', true);

			} else {

				$('#addParamInModal .req_param').attr('readonly', false);

				$('#addParamInModal .req_param').attr('required', true);

				$('#addParamInModal #formStep-10').val('');

				$('#addParamInModal #formStep-10').attr('readonly', false);

				$('#addParamInModal #formStep-11').val('');

				$('#addParamInModal #formStep-11').attr('readonly', false);

				$('#addParamInModal #formStep-11').attr('required', true);

				$('#addParamInModal #addReqParam').attr('disabled', false);

			}

		});

		$('#addParamInModal #formStep-10').change(function () {

			if ($('#addParamInModal #formStep-10').val() == "Tidak Ada Tetapan") {

				$('#addParamInModal #formStep-11').val('');

				$('#addParamInModal #formStep-11').attr('disabled', true);

				$('#addParamInModal #formStep-11').attr('required', false);

			} else {

				$('#addParamInModal #formStep-11').val('');

				$('#addParamInModal #formStep-11').attr('disabled', false);

				$('#addParamInModal #formStep-11').attr('required', true);

			}

		});

		$('#addParamInModal #next').click(function () {

			temp = currentStepParamIn + 1;

			if (temp <= maxStepParamIn) {

				changeStepParamIn(temp)

			}

		});

		$('#addParamInModal #prev').click(function () {

			temp = currentStepParamIn - 1;

			if (temp >= minStepParamIn) {

				changeStepParamIn(temp)

			}

        });

		$('#paramIn').on('click', '.removeParamIn', function () {

			$(this).closest('tr').remove();

		});

		$('#addParamInModal #addAnsOpt').click(function () {

			$("#ansOpt > tbody").append(

				'<tr class="ans-opt-child"><td><input type="text" name="ato_jawaban" class="form-control answer_opt"></td><td><input type="text" name="ato_nilai" class="form-control answer_opt"></td><td><select name="ato_tipe" class="form-control answer_opt"><option value="" disabled hidden selected></option><option value="Teks">Teks</option><option value="Lokasi">Lokasi</option></select></td><td><button class="btn btn-sm btn-danger removeAnsOpt" type="button"><i class="fa fa-minus"></i></button></td></tr>'

			);

		});

		$('#addParamInModal #ansOpt').on('click', '.removeAnsOpt', function () {

			$(this).closest('tr').remove();

		});

		$('#addParamInModal #addReqParam').click(function () {

			$("#reqParam > tbody").append(

				'<tr class="req_param-child"> <td> <input type="text" name="rp_parameter" class="form-control req_param"> </td> <td> <input type="text" name="rp_nilai" class="form-control req_param"> </td> <td> <button class="btn btn-sm btn-danger removeReqParam" type="button"><i class="fa fa-minus"></i></button> </td> </tr>'

			);

		});

		$('#addParamInModal #reqParam').on('click', '.removeReqParam', function () {

			$(this).closest('tr').remove();

		});

		$('#addParamInModal #addParamInForm').submit(function (event) {

            

			param_in_order = $('#addParamInModal input[name="param_in_order"]').serializeArray()[0]['value'];

			param_in = $('#addParamInModal input[name="param_in"]').serializeArray()[0]['value'];

			question = $('#addParamInModal textarea[name="question"]').serializeArray()[0]['value'];



			answer_type = $('#addParamInModal select[name="answer_type"]').serializeArray()[0]['value'];

			question_type = $('#addParamInModal select[name="question_type"]').serializeArray()[0]['value'];

			is_long_answer = $('#addParamInModal select[name="is_long_answer"]').serializeArray()[0]['value'];

			is_restricted = $('#addParamInModal select[name="is_restricted"]').serializeArray()[0]['value'];



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

				is_buffer_value = $('#addParamInModal select[name="is_buffer_value"]').serializeArray()[0]['value'];



				if (is_buffer_value == 'Ada Tetapan') {

					default_value = $('#addParamInModal input[name="default_value"]').serializeArray()[0]['value'];

				}

			}

			description = '' + answer_type + '|' + question_type + '|' + is_long_answer + '|' + is_restricted + '|' +

				is_buffer_value;



			$("#paramIn > tbody").append('<tr> <td> <input id="param_in_order' + tmp_param_in +

				'" readonly type="number" name="param_in_order" class="form-control"> </td> <td> <input id="param_in' +

				tmp_param_in + '" readonly type="text" name="param_in" class="form-control"> </td> <td> <input id="question' +

				tmp_param_in +

				'" readonly type="text" name="question" class="form-control"> </td> <td> <input id="description' +

				tmp_param_in +

				'" readonly type="text" name="description" class="form-control"> </td> <td> <input id="answer_text_option' +

				tmp_param_in +

				'" readonly type="text" name="answer_text_option" class="form-control"> </td> <td> <input id="require_param' +

				tmp_param_in +

				'" readonly type="text" name="require_param" class="form-control"> </td> <td> <input id="default_value' +

				tmp_param_in +

				'" readonly type="text" name="default_value" class="form-control"> </td> <td> <button class="btn btn-danger"> <i class="fa fa-minus removeParamIn"></i> </button> </td> </tr>'

            );



			$('#param_in_order' + tmp_param_in).val(param_in_order);

			$('#param_in' + tmp_param_in).val(param_in);

			$('#question' + tmp_param_in).val(question);

			$('#description' + tmp_param_in).val(description);

			$('#answer_text_option' + tmp_param_in).val(answer_text_option);

			$('#require_param' + tmp_param_in).val(require_param);

            $('#default_value' + tmp_param_in).val(default_value);



			tmp_param_in += 1;

			refreshStepParamIn()

			$('#addParamInModal').modal('toggle');

			event.preventDefault();

        });

    	$('#addParamOutModal .progress-bar').css({

			width: ((minStepParamOut / maxStepParamOut) * 100) + '%'

		});

		$('#addParamOutModal #formProgress').text(minStepParamOut + " dari " + maxStepParamOut);

        function changeStepParamOut(step) {

			var percent = (parseInt(step) / maxStepParamOut) * 100;



			$('#addParamOutModal .active').removeClass('active');

			$('#addParamOutModal #step-' + step).addClass('active');

			$('#addParamOutModal .progress-bar').css({

				width: percent + '%'

			});

			$('#addParamOutModal #formProgress').text(step + " dari " + maxStepParamOut);



			currentStepParamOut = step;

		};

		function refreshStepParamOut() {

			$('#addParamOutModal textarea').val('');

			$('#addParamOutModal select').val('');



			changeStepParamOut(minStepParamOut);

		};

		$('#addParamOutModal #next').click(function () {

			temp = currentStepParamOut + 1;

			if (temp <= maxStepParamOut) {

				changeStepParamOut(temp)

			}

		});

		$('#addParamOutModal #prev').click(function () {

			temp = currentStepParamOut - 1;

			if (temp >= minStepParamOut) {

				changeStepParamOut(temp)

			}

		});

		$('#paramOut').on('click', '.removeParamOut', function () {

			$(this).closest('tr').remove();

		});

		$('#addParamOutModal #addParamOutForm').submit(function (event) {

			response = $('#addParamOutModal textarea[name="response"]').serializeArray()[0]['value'];

			response_type = $('#addParamOutModal select[name="response_type"]').serializeArray()[0]['value'];

			$("#paramOut > tbody").append('<tr> <td> <input readonly type="text" name="response" id="response' +

				tmp_param_out + '" class="form-control"> </td> <td> <select readonly name="response_type" id="response_type' +

				tmp_param_out +

				'" class="form-control"> <option value="" disabled hidden selected>...</option> <option value="text">Teks</option> <option value="location">Lokasi</option> <option value="photo">Foto</option> </select> </td> <td> <button class="btn btn-danger removeParamOut" type="button"> <i class="fa fa-minus"></i> </button> </td> </tr>'

			);

			$('#response' + tmp_param_out).val(response);

			$('#response_type' + tmp_param_out).val(response_type);

			tmp_param_out += 1;

			refreshStepParamOut()

			$('#addParamOutModal').modal('toggle');

			event.preventDefault();

		});

	});

</script>

