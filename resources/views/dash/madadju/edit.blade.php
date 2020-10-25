@extends('layouts.dashboard')
@section('title')
	<title> ویرایش مددجو </title>
@endsection

@section('main')
    <form class="tile" class="tile" action="{{route('madadju.update', [$type, $object->id])}}" method="post">

        @csrf
        @method('PUT')

        <div class="row justify-content-center">
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

            <hr class="w-100">

            @php
        		$a = $person->file_domain == 'توانبخشی';
        		$b = $person->file_domain == 'اجتماعی';
        		$c = $person->file_domain == 'پیشگیری';
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

        	<div class="w-100 my-2"></div>
        	@include('partials.input', ['type' => 'select', 'name'=>'disability_type', 'col' => 3, 'required' =>$a, 'hide' => !$a,
        		'options' => defaults('disability_type')
        	])
        	@include('partials.input', ['type' => 'select', 'name'=>'disability_level', 'col' => 3, 'required' => $a, 'hide' => !$a,
        		'options' => defaults('disability_level')
        	])
        	@include('partials.input', ['type' => 'select', 'name'=>'file_status1', 'col' => 3, 'required' => $b, 'hide' => !$b,
        		'options' => defaults('file_status_1'), 'raw_value' => $person->file_status
        	])
        	@include('partials.input', ['type' => 'select', 'name'=>'file_status2', 'col' => 3, 'required' => $c, 'hide' => !$c,
        		'options' => defaults('file_status_2'), 'raw_value' => $person->file_status
        	])


            <hr class="w-100">

            <div class="form-froup col-md-3">
        		<b class="text-danger"> * </b>
        		<label for="ayp"> مستمری بگیر </label>
        		<select class="form-control" name="are_you_payed" id="ayp" required>
        			<option> هستم </option>
        			<option @if(!$person->payed) selected @endif > نیستم </option>
        		</select>
        	</div>
        	@include('partials.input', ['type' => 'number', 'name'=>'payed', 'col' => 4, 'required' => 0, 'placeholder' => 'به ریال'])
        	@include('partials.input', ['type' => 'select', 'name'=>'activity_section', 'col' => 3, 'required' => 1,
        		'options' => defaults('activity_section')
        	])
        	@include('partials.input', ['type' => 'select', 'name'=>'housing_status', 'col' => 3, 'required' => 1,
        		'options' => defaults('housing_status')
        	])
        	@include('partials.input', ['type' => 'number', 'name'=>'mortgage', 'col' => 3, 'required' => 0, 'placeholder' => 'به ریال'])
        	@include('partials.input', ['type' => 'number', 'name'=>'rent', 'col' => 3, 'required' => 0, 'placeholder' => 'به ریال'])

        	<hr class="w-100">
            @php
                $edit_by_admins_mode = false;
            @endphp

        	@if ($type == 'job')

        		@include('partials.input', ['type' => 'text', 'name'=>'skill_type', 'col' => 5, 'required' => 1])
        		@include('partials.input', ['type' => 'text', 'name'=>'interests', 'col' => 5, 'required' => 1])
        		@include('partials.input', ['type' => 'select', 'name'=>'vehicle_type', 'col' => 2, 'required' => 1,
        			'options' => defaults('vehicle_type')
        		])

        	@endif

        	@if ($type == 'loan')
        		@include('partials.input', ['type' => 'text', 'name'=>'workshop_name', 'col' => 4, 'required' => 1])
        		@include('partials.input', ['type' => 'text', 'name'=>'license_type', 'col' => 4, 'required' => 1])
        		@include('partials.input', ['type' => 'text', 'name'=>'license_system', 'col' => 4, 'required' => 1])
        		@include('partials.input', ['type' => 'text', 'name'=>'plan_title', 'col' => 3, 'required' => 1])
        		@include('partials.input', ['type' => 'number', 'name'=>'required_finance', 'placeholder' => 'به ریال', 'col' => 3, 'required' => 1])
        		@include('partials.input', ['type' => 'text', 'name'=>'suggested_bank', 'col' => 3, 'required' => 1])
        		@include('partials.input', ['type' => 'text', 'name'=>'insurance_number', 'col' => 3, 'required' => 0])
        	@endif

        	@if ($type == 'insurance')

        		@include('partials.input', ['type' => 'text', 'name'=>'workshop_name', 'col' => 3, 'required' => 1])
        		@include('partials.input', ['type' => 'text', 'name'=>'workshop_code', 'col' => 3, 'required' => 1])
        		@include('partials.input', ['type' => 'text', 'name'=>'license_type', 'col' => 3, 'required' => 1])
        		@include('partials.input', ['type' => 'text', 'name'=>'license_system', 'col' => 3, 'required' => 1])
        		@include('partials.input', ['type' => 'text', 'name'=>'plan_title', 'col' => 3, 'required' => 1])
        		@include('partials.input', ['type' => 'select', 'name'=>'insurance_status', 'col' => 3, 'required' => 1,
        			'options' => defaults('insurance_status')
        		])
        		@include('partials.input', ['type' => 'text', 'name'=>'insurance_number', 'col' => 3, 'required' => 1])
        		@include('partials.input', ['type' => 'number', 'name'=>'monthly_amount', 'col' => 3, 'required' => 1])
        		<div class="w-100"></div>
        		@include('partials.input', ['type' => 'text', 'name'=>'shaba', 'col' => 3, 'required' => 1])
        		@include('partials.input', ['type' => 'text', 'name'=>'bank', 'col' => 3, 'required' => 1])

        	@endif

        	<hr class="w-100">
        	@include('partials.input', ['type' => 'text', 'name'=>'information', 'col' => 12, 'required' => 0, 'placeholder' => 'اختیاری'])

            <hr class="w-100">

        	<div class="col-md-2">
        		<button type="submit" class="btn btn-success btn-block"> ویرایش </button>
        	</div>

        </div>

    </form>
@endsection
