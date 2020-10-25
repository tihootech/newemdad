<form id="wizard-form" class="row justify-content-center" method="POST" action="{{route('wizard', [$type, $step])}}">

	@csrf

	@php
		$val = $person->file_domain ?? old('file_domain') ?? 'توانبخشی';
		$a = $val == 'توانبخشی';
		$b = $val == 'اجتماعی';
		$c = $val == 'پیشگیری';
	@endphp

	<div class="col-md-2 custom-control custom-radio">
		<input type="radio" id="cr1" name="file_domain" value="توانبخشی" class="custom-control-input" @if($a) checked @endif>
		<label class="custom-control-label" for="cr1"> <span class="mr-2"> توانبخشی </span> </label>
	</div>
	<div class="col-md-2 custom-control custom-radio">
		<input type="radio" id="cr2" name="file_domain" value="اجتماعی" class="custom-control-input" @if($b) checked @endif>
		<label class="custom-control-label" for="cr2"> <span class="mr-2"> اجتماعی </span> </label>
	</div>
	<div class="col-md-2 custom-control custom-radio">
		<input type="radio" id="cr3" name="file_domain" value="پیشگیری" class="custom-control-input" @if($c) checked @endif>
		<label class="custom-control-label" for="cr3"> <span class="mr-2"> پیشگیری </span> </label>
	</div>

	<hr class="w-100">
	@include('partials.input', ['type' => 'select', 'name'=>'disability_type', 'col' => 3, 'required' =>$a, 'hide' => !$a,
		'options' => defaults('disability_type')
	])
	@include('partials.input', ['type' => 'select', 'name'=>'disability_level', 'col' => 3, 'required' => $a, 'hide' => !$a,
		'options' => defaults('disability_level')
	])
	@include('partials.input', ['type' => 'select', 'name'=>'file_status1', 'col' => 3, 'required' => $b, 'hide' => !$b,
		'options' => defaults('file_status_1')
	])
	@include('partials.input', ['type' => 'select', 'name'=>'file_status2', 'col' => 3, 'required' => $c, 'hide' => !$c,
		'options' => defaults('file_status_2')
	])

</form>
