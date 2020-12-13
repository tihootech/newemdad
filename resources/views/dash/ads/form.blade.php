@extends('layouts.dashboard')
@section('title')
	<title> تعریف آگهی جدید  </title>
@endsection

@section('main')

	<div class="tile">

		<div class="text-left">
            <a href="{{route('ad.index')}}" class="btn btn-info btn-sm"> لیست آگهی ها </a>
        </div>
        <hr>
        <form class="row justify-content-center" action="{{$ad->id ? route('ad.update', $ad) : route('ad.store')}}" method="post" enctype="multipart/form-data">
			@csrf
			@if ($ad->id)
				@method('PUT')
			@endif
			@include('partials.input', ['type' => 'text', 'name'=>'title', 'col' => 4, 'required' => 1, 'object' => $ad])
			@include('partials.input', ['type' => 'number', 'name'=>'payment', 'col' => 2, 'required' => 1, 'object' => $ad])
			@include('partials.input', ['type' => 'number', 'name'=>'count', 'col' => 2, 'required' => 1, 'object' => $ad])
			@include('partials.input', ['type' => 'select', 'name'=>'gender', 'col' => 2, 'required' => 1, 'object' => $ad, 'mapped' => true,
				'options' => [
					'm' => 'آقا',
					'f' => 'خانم',
					'b' => 'مهم نیست',
				]
			])
			@include('partials.input', ['type' => 'select', 'name'=>'service', 'col' => 2, 'required' => 1, 'object' => $ad, 'mapped' => true,
				'options' => [
					'1' => 'دارد',
					'0' => 'ندارد',
				]
			])
			@include('partials.input', ['type' => 'text', 'name'=>'shifts', 'col' => 4, 'required' => 1, 'object' => $ad])
			@include('partials.input', ['type' => 'select', 'name'=>'dorm', 'col' => 2, 'required' => 1, 'object' => $ad, 'mapped' => true,
				'options' => [
					'1' => 'دارد',
					'0' => 'ندارد',
				]
			])
			@include('partials.input', ['type' => 'select', 'name'=>'job_type', 'col' => 2, 'required' => 1, 'object' => $ad, 'mapped' => true,
				'options' => [
					'f' => 'تمام وقت',
					'p' => 'پاره وقت',
				]
			])
			@include('partials.input', ['type' => 'file', 'name'=>'image', 'col' => 3, 'required' => 0, 'object' => $ad])
			@include('partials.input', ['type' => 'text', 'name'=>'address', 'col' => 12, 'required' => 1, 'object' => $ad])
			@include('partials.input', ['type' => 'text', 'name'=>'info', 'col' => 12, 'required' => 0, 'object' => $ad])

			<hr class="w-100">

			<div class="w-100 text-center">
				<button type="submit" class="btn btn-primary"> تایید </button>
			</div>

        </form>

	</div>
@endsection
