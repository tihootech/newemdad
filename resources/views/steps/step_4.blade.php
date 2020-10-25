<form id="wizard-form" class="row justify-content-center" method="POST" action="{{route('wizard', [$type, $step])}}">

	@csrf

	<div class="form-froup col-md-3">
		<b class="text-danger"> * </b>
		<label for="ayp"> مستمری بگیر هستید؟ </label>
		<select class="form-control" name="are_you_payed" id="ayp" required>
			<option> هستم </option>
			<option @if($apply && !$person->payed) selected @endif > نیستم </option>
		</select>
	</div>
	@include('partials.input', ['type' => 'number', 'name'=>'payed', 'col' => 4, 'required' => 0, 'placeholder' => 'به ریال',
		'more_info' => 'درصورتی که مستمری بگیر نیستید این فیلد را خالی بگذارید'
	])
	@include('partials.input', ['type' => 'select', 'name'=>'activity_section', 'col' => 3, 'required' => 1,
		'options' => defaults('activity_section')
	])
	@include('partials.input', ['type' => 'select', 'name'=>'housing_status', 'col' => 3, 'required' => 1,
		'options' => defaults('housing_status')
	])
	@include('partials.input', ['type' => 'number', 'name'=>'mortgage', 'col' => 3, 'required' => 0, 'placeholder' => 'به ریال',
		'more_info' => 'درصورتی که مستاجر هستید'
	])
	@include('partials.input', ['type' => 'number', 'name'=>'rent', 'col' => 3, 'required' => 0, 'placeholder' => 'به ریال',
		'more_info' => 'درصورتی که مستاجر هستید'
	])

	<hr class="w-100">

	@if ($type == 1)

		@include('partials.input', ['type' => 'text', 'name'=>'skill_type', 'col' => 5, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'text', 'name'=>'interests', 'col' => 5, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'select', 'name'=>'vehicle_type', 'col' => 2, 'required' => 1, 'object' => $apply,
			'options' => defaults('vehicle_type')
		])

	@endif

	@if ($type == 2)
		@include('partials.input', ['type' => 'text', 'name'=>'workshop_name', 'col' => 4, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'text', 'name'=>'license_type', 'col' => 4, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'text', 'name'=>'license_system', 'col' => 4, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'text', 'name'=>'plan_title', 'col' => 3, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'number', 'name'=>'required_finance', 'placeholder' => 'به ریال', 'col' => 3, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'text', 'name'=>'suggested_bank', 'col' => 3, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'text', 'name'=>'insurance_number', 'col' => 3, 'required' => 0, 'object' => $apply,
			'more_info'=> 'در صورتی که بیمه ندارید این فیلد را خالی بگذارید'
		])
	@endif

	@if ($type == 3)

		@include('partials.input', ['type' => 'text', 'name'=>'workshop_name', 'col' => 3, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'text', 'name'=>'workshop_code', 'col' => 3, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'text', 'name'=>'license_type', 'col' => 3, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'text', 'name'=>'license_system', 'col' => 3, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'text', 'name'=>'plan_title', 'col' => 3, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'select', 'name'=>'insurance_status', 'col' => 3, 'required' => 1, 'object' => $apply,
			'options' => defaults('insurance_status')
		])
		@include('partials.input', ['type' => 'text', 'name'=>'insurance_number', 'col' => 3, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'number', 'name'=>'monthly_amount', 'col' => 3, 'required' => 1, 'object' => $apply])
		<div class="w-100"></div>
		@include('partials.input', ['type' => 'text', 'name'=>'shaba', 'col' => 3, 'required' => 1, 'object' => $apply])
		@include('partials.input', ['type' => 'text', 'name'=>'bank', 'col' => 3, 'required' => 1, 'object' => $apply])
		<div class="w-100 text-center">
			<a href="https://www.rade.ir/%D8%AF%D8%B1%DB%8C%D8%A7%D9%81%D8%AA-%D8%B4%D9%85%D8%A7%D8%B1%D9%87-%D8%B4%D8%A8%D8%A7/" target="_blank">
				**
				شماره شبا خود را نمیدانید؟
				برای آموزش پیدا کردن شماره شبا کلیک کنید
				**
			</a>
		</div>

	@endif

	<hr class="w-100">
	@include('partials.input', ['type' => 'text', 'name'=>'information', 'col' => 12, 'required' => 0, 'placeholder' => 'اختیاری'])

</form>
