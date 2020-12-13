<form id="wizard-form" class="row justify-content-center" method="POST" action="{{route('wizard', [$type, $step])}}">

	@csrf

	@include('partials.input', ['type' => 'text', 'name'=>'first_name', 'col' => 2, 'required' => 1])
	@include('partials.input', ['type' => 'text', 'name'=>'last_name', 'col' => 2, 'required' => 1])
	@include('partials.input', ['type' => 'text', 'name'=>'national_code', 'col' => 2, 'required' => 1])
	@include('partials.input', ['type' => 'text', 'name'=>'madadju_code', 'col' => 2, 'required' => 1])
	@include('partials.input', ['type' => 'text', 'name'=>'mobile', 'col' => 2, 'required' => 1])



	<hr class="w-100">

	@include('partials.input', ['type' => 'text', 'name'=>'address', 'col' => 10, 'required' => 0])
	<div class="w-100"></div>
	@include('partials.input', ['type' => 'date', 'name'=>'birth_date', 'col' => 2, 'required' => 0])


	@include('partials.input', ['type' => 'select', 'name'=>'gender', 'col' => 2, 'required' => 0,
		'options' => defaults('gender')
	])
	@php
		$g = $person->gender ?? old('gender');
	@endphp
	@include('partials.input', ['type' => 'select', 'name'=>'military_status', 'col' => 2, 'required' => $g == 'مرد',
		'options' => defaults('military_status'), 'hide' => $g == 'زن'
	])
	@include('partials.input', ['type' => 'select', 'name'=>'education', 'col' => 2, 'required' => 0,
		'options' => defaults('education')
	])
	@php
		$edval = $person->education ?? old('education');
		$f = in_array($edval, ['بیسواد', 'ابتدایی', 'سیکل']);
		$a = in_array($edval, ['بیسواد', 'ابتدایی', 'سیکل', 'دیپلم', 'دیپلم ناقص']);
	@endphp
	@include('partials.input', ['type' => 'text', 'name'=>'field_of_study', 'col' => 2, 'required' => 0, 'hide'=>$f])

</form>
