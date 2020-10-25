@extends('layouts.dashboard')
@section('title')
	<title>
		@if ($expert->id)
			ویرایش
		@else
			تعریف
		@endif
		مسئول شهرستان
	</title>
@endsection

@section('main')

	<div class="tile text-left">
		<a href="{{route('expert.index')}}" class="btn btn-outline-primary">
			<i class="fa fa-list ml-1"></i>
			 لیست مسئولین شهرستان ها
		</a>
	</div>

	<div class="tile">
		<form class="row" action="@if($expert->id) {{route('expert.update', $expert)}} @else {{route('expert.store')}} @endif" method="post">
			@csrf
			@if ($expert->id)
				@method('PUT')
			@endif

			@include('partials.input', ['type' => 'text', 'name'=>'first_name', 'col' => 2, 'required' => 1, 'object' => $expert])
			@include('partials.input', ['type' => 'text', 'name'=>'last_name', 'col' => 2, 'required' => 1, 'object' => $expert])
			@include('partials.input', ['type' => 'text', 'name'=>'username', 'col' => 2, 'required' => 1, 'object' => $expert])
			@include('partials.input', ['type' => 'text', 'name'=>'national_code', 'col' => 3, 'required' => 1, 'object' => $expert])
			@include('partials.input', ['type' => 'select', 'name'=>'city', 'col' => 3, 'required' => 1, 'object' => $expert,
				'options' => defaults('city')
			])

			<hr class="w-100">
			@unless ($expert->id)
				<p class="w-100 text-center text-info">
					پس از ایجاد کاربر در سیستم، رمزعبور کاربر کدملی او خواهد شد.
				</p>
			@endunless
			<div class="col-md-2 mx-auto">
				<button type="submit" class="btn btn-outline-primary btn-block"> تایید </button>
			</div>


		</form>
	</div>

@endsection
