<form id="wizard-form" class="row justify-content-center" method="POST" action="{{route('wizard', [$type, $step])}}">

	@csrf

	@include('partials.input', ['type' => 'text', 'name'=>'first_name', 'col' => 2, 'required' => 1])
	@include('partials.input', ['type' => 'text', 'name'=>'last_name', 'col' => 2, 'required' => 1])
	@include('partials.input', ['type' => 'text', 'name'=>'father_name', 'col' => 2, 'required' => 1])
	@include('partials.input', ['type' => 'select', 'name'=>'city', 'col' => 2, 'required' => 1,
		'options' => defaults('city')
	])
	@include('partials.input', ['type' => 'select', 'name'=>'lifestyle', 'col' => 2, 'required' => 1,
		'options' => defaults('lifestyle')
	])
	@include('partials.input', ['type' => 'text', 'name'=>'national_code', 'col' => 2, 'required' => 1])


	@include('partials.input', ['type' => 'text', 'name'=>'address', 'col' => 9, 'required' => 1])
	@include('partials.input', ['type' => 'text', 'name'=>'postal_code', 'col' => 3, 'required' => 1])

	<hr class="w-100">

	@include('partials.input', ['type' => 'text', 'name'=>'mobile', 'col' => 2, 'required' => 1])
	@include('partials.input', ['type' => 'date', 'name'=>'birth_date', 'col' => 2, 'required' => 1])
	@include('partials.input', ['type' => 'text', 'name'=>'birth_certificate_number', 'col' => 2, 'required' => 1])
	@include('partials.input', ['type' => 'text', 'name'=>'reference', 'col' => 3, 'required' => 0])
	@include('partials.input', ['type' => 'text', 'name'=>'madadkar_name', 'col' => 2, 'required' => 1])
	@include('partials.input', ['type' => 'number', 'name'=>'family_members', 'col' => 1, 'required' => 1])
	@include('partials.input', ['type' => 'select', 'name'=>'marital_status', 'col' => 2, 'required' => 1,
		'options' => defaults('marital_status')
	])


	@include('partials.input', ['type' => 'select', 'name'=>'gender', 'col' => 2, 'required' => 1,
		'options' => defaults('gender')
	])
	@php
		$g = $person->gender ?? old('gender');
	@endphp
	@include('partials.input', ['type' => 'select', 'name'=>'military_status', 'col' => 2, 'required' => $g == 'مرد',
		'options' => defaults('military_status'), 'hide' => $g == 'زن'
	])
	@include('partials.input', ['type' => 'select', 'name'=>'education', 'col' => 2, 'required' => 1,
		'options' => defaults('education')
	])
	@php
		$edval = $person->education ?? old('education');
		$f = in_array($edval, ['بیسواد', 'ابتدایی', 'سیکل']);
		$a = in_array($edval, ['بیسواد', 'ابتدایی', 'سیکل', 'دیپلم', 'دیپلم ناقص']);
	@endphp
	@include('partials.input', ['type' => 'text', 'name'=>'field_of_study', 'col' => 2, 'required' => !$f, 'hide'=>$f])
	@include('partials.input', ['type' => 'text', 'name'=>'academic_orientation', 'col' => 2, 'required' => !$a, 'hide'=>$a])

	<hr class="w-100">

	@include('partials.input', ['type' => 'select', 'name'=>'warden_type', 'col' => 2, 'required' => 1,
		'options' => defaults('warden_type')
	])
	@include('partials.input', ['type' => 'select', 'name'=>'health_status', 'col' => 2, 'required' => 1,
		'options' => defaults('health_status')
	])
	@include('partials.input', ['type' => 'number', 'name'=>'disables_in_family', 'col' => 2, 'required' => 1])

</form>
