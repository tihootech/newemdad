@extends('layouts.dashboard')
@section('title')
	<title> لیست مددجویان </title>
@endsection

@section('main')

	<div class="tile">
		<div class="text-left">
			<a href="#search-box" class="btn btn-warning" data-toggle="collapse">
				<i class="fa fa-search ml-1"></i> جستجوی پیشرفته
			</a>
			<form class="d-inline" action="{{route('madadju.excel')}}" method="get">
				<input type="hidden" name="type" value="{{$type}}">
				<button type="submit" class="btn btn-success">
					<i class="fa fa-file-excel-o ml-1"></i> خروجی اکسل
				</button>
			</form>
		</div>
		<div class="collapse" id="search-box">
			<hr>
			<form class="row justify-content-center">
				@include('partials.input', ['type' => 'text', 'name'=>'name', 'col' => 3, 'required' => 0, 'raw_value' => request('name')])
				@include('partials.input', ['type' => 'text', 'name'=>'mobile', 'col' => 3, 'required' => 0, 'raw_value' => request('mobile')])
				@include('partials.input', ['type' => 'text', 'name'=>'national_code', 'col' => 3, 'required' => 0, 'raw_value' => request('national_code')])
				@master
					@include('partials.input', ['type' => 'select', 'name'=>'city', 'col' => 3, 'required' => 0, 'raw_value' => request('city'),
						'options' => defaults('city')
					])
				@endmaster
				<hr class="w-100">
				<div class="col-md-2">
					<button type="submit" class="btn btn-outline-primary btn-block"> تایید و جستجو </button>
				</div>
			</form>
		</div>
	</div>

	<div class="tile">

		@include('partials.madadjus_table', ['list' => $applies, 'imode' => 0])

		<div class="table-responsive-lg">
			{{$applies->links()}}
		</div>

	</div>
@endsection
