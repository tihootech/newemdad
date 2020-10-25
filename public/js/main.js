$(document).ready(function () {

	// initializers
	$('.pdp').persianDatepicker();
	$('[data-toggle=popover]').popover();
	$('[data-popover]').popover({
		html: true,
		trigger: 'hover',
		placement: 'top'
	});

	// form changes
	$('#education').change(function () {
		var val = $(this).val();
		if (val == 'بیسواد' || val == 'ابتدایی' || val == 'سیکل') {
			$('#field_of_study').prop('required',false).parents('.form-group').hide();
			$('#academic_orientation').prop('required',false).parents('.form-group').hide();
		}else if (val == 'دیپلم ناقص' || val == 'دیپلم' ) {
			$('#field_of_study').prop('required',true).parents('.form-group').show();
			$('#academic_orientation').prop('required',false).parents('.form-group').hide();
		}else {
			$('#field_of_study').prop('required',true).parents('.form-group').show();
			$('#academic_orientation').prop('required',true).parents('.form-group').show();
		}
	});
	$('#gender').change(function () {
		var val = $(this).val();
		if (val == 'مرد') {
			$('#military_status').prop('required',true).parents('.form-group').show();
		}else {
			$('#military_status').prop('required',false).parents('.form-group').hide();
		}
	});
	$('input[name=file_domain]').change(function () {
		var val = $(this).val();
		if (val == 'توانبخشی') {
			$('select[name=disability_type]').prop('required', true).parents('.form-group').show();
			$('select[name=disability_level]').prop('required', true).parents('.form-group').show();
			$('select[name=file_status1').prop('required', false).parents('.form-group').hide();
			$('select[name=file_status2').prop('required', false).parents('.form-group').hide();
		}
		if (val == 'اجتماعی') {
			$('select[name=disability_type]').prop('required', false).parents('.form-group').hide();
			$('select[name=disability_level]').prop('required', false).parents('.form-group').hide();
			$('select[name=file_status1').prop('required', true).parents('.form-group').show();
			$('select[name=file_status2').prop('required', false).parents('.form-group').hide();
		}
		if (val == 'پیشگیری') {
			$('select[name=disability_type]').prop('required', false).parents('.form-group').hide();
			$('select[name=disability_level]').prop('required', false).parents('.form-group').hide();
			$('select[name=file_status1').prop('required', false).parents('.form-group').hide();
			$('select[name=file_status2').prop('required', true).parents('.form-group').show();
		}
	});

});
