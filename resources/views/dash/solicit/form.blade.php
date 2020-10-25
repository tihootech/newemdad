@extends('layouts.dashboard')
@section('title')
	<title> @if($solicit->id) ویرایش درخواست @else درخواست مددجو @endif </title>
@endsection

@section('main')

    <div class="tile text-left">
		<a href="{{route('solicit.index')}}" class="btn btn-outline-primary"> <i class="fa fa-list ml-1"></i> لیست درخواست های قبلی </a>
	</div>

	<div class="tile">

        <form class="row" action="@if($solicit->id) {{route('solicit.update', $solicit)}} @else {{route('solicit.store')}} @endif" method="post">
            @csrf
            @if ($solicit->id)
                @method('PUT')
            @endif

            @include('partials.input', ['type' => 'number', 'name'=>'age_from', 'col' => 2, 'required' => 1, 'object' => $solicit])
            @include('partials.input', ['type' => 'number', 'name'=>'age_to', 'col' => 2, 'required' => 1, 'object' => $solicit])
            @include('partials.input', ['type' => 'select', 'name'=>'educations', 'col' => 4, 'required' => 0, 'multiple' => 1, 'select_all' => 1,
        		'options' => defaults('education')
        	])
            @include('partials.input', ['type' => 'text', 'name'=>'field_of_study', 'col' => 2, 'required' => 0, 'object' => $solicit])
            @include('partials.input', ['type' => 'text', 'name'=>'academic_orientation', 'col' => 2, 'required' => 0, 'object' => $solicit])
            @include('partials.input', ['type' => 'select', 'name'=>'health_status', 'col' => 3, 'required' => 1,
                'options' => defaults('health_status')
            ])
            @include('partials.input', ['type' => 'select', 'name'=>'disability_type', 'col' => 3, 'required' => 0, 'multiple' => 1,
                'options' => defaults('disability_type')
            ])
            @include('partials.input', ['type' => 'select', 'name'=>'disability_level', 'col' => 3, 'required' => 0, 'multiple' => 1,
                'options' => defaults('disability_level')
            ])
            @php
                $options = defaults('vehicle_type');
                unset($options[0]);
            @endphp
            @include('partials.input', ['type' => 'select', 'name'=>'vehicle_type', 'col' => 3, 'required' => 0, 'multiple' => 1,
                'options' => $options
            ])
            @include('partials.input', ['type' => 'text', 'name'=>'skill_type', 'col' => 12, 'required' => 0, 'object' => $solicit])

            <hr class="w-100">

            <div class="col-md-2 mx-auto">
                <button type="submit" class="btn btn-primary btn-block"> تایید </button>
            </div>

        </form>

	</div>

@endsection
