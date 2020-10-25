@extends('layouts.dashboard')
@section('title')
	<title> لیست مسئولین شهرستان ها </title>
@endsection

@section('main')

	<div class="tile">
		<div class="text-left">
			<a href="#search-box" class="btn btn-warning" data-toggle="collapse">
				<i class="fa fa-search ml-1"></i> جستجوی پیشرفته
			</a>
			<form class="d-inline" action="{{route('organ.excel')}}" method="get">
				<button type="submit" class="btn btn-success">
					<i class="fa fa-file-excel-o ml-1"></i> خروجی اکسل
				</button>
			</form>
		</div>
		<div class="collapse" id="search-box">
			<hr>
			<form class="row justify-content-center">
				@include('partials.input', ['type' => 'text', 'name'=>'operator', 'col' => 3, 'required' => 0, 'raw_value' => request('operator')])
				@include('partials.input', ['type' => 'text', 'name'=>'phone', 'col' => 3, 'required' => 0, 'raw_value' => request('phone')])
				@include('partials.input', ['type' => 'text', 'name'=>'national_code', 'col' => 3, 'required' => 0, 'raw_value' => request('national_code')])
				@master
					@include('partials.input', ['type' => 'select', 'name'=>'city', 'col' => 3, 'required' => 0, 'raw_value' => request('city'),
						'options' => defaults('city')
					])
				@endmaster
				@include('partials.input', ['type' => 'select', 'name'=>'workshop_location', 'col' => 3, 'required' => 0,
					'raw_value' => request('workshop_location'), 'options' => defaults('workshop_location')
				])
				@include('partials.input', ['type' => 'text', 'name'=>'workshop_name', 'col' => 3, 'required' => 0, 'raw_value' => request('workshop_name')])
				@include('partials.input', ['type' => 'select', 'name'=>'service', 'col' => 3, 'required' => 0,
					'raw_value' => request('service'), 'options' => defaults()
				])
				@include('partials.input', ['type' => 'select', 'name'=>'shifts', 'col' => 3, 'required' => 0,
					'raw_value' => request('shifts'), 'options' => defaults()
				])
				<hr class="w-100">
				<div class="col-md-2">
					<button type="submit" class="btn btn-outline-primary btn-block"> تایید و جستجو </button>
				</div>
			</form>
		</div>
	</div>

	<div class="tile">

		<div class="table-responsive mb-3">
			<table class="table table-sm table-bordered table-striped table-hover fixed-width text-center">
				<thead>
					<tr>
						<th> ردیف </th>
						<th> وضعیت </th>
						<th style="min-width:200px">@lang('operator')</th>
						<th> @lang('phone') </th>
						<th> استان </th>
						<th> @lang('city') </th>
						<th> @lang('national_code') </th>
						<th> @lang('birth_date') </th>
						<th> @lang('educations') </th>
						<th> @lang('workshop_location') </th>
						<th style="min-width:200px"> نام کارگاه </th>
						<th> @lang('postal_code') </th>
						<th style="min-width:175px"> @lang('service') </th>
						<th> @lang('shifts') </th>
						<th> @lang('shift_hours') </th>
						<th> @lang('meal') </th>
						<th style="min-width:150px"> @lang('payment_amount') </th>
						<th style="min-width:200px"> @lang('offered_payment') </th>
						<th> @lang('madadjus_insurance') </th>
						<th> @lang('full_insurance') </th>
						<th> کدرهگیری </th>
						<th colspan="2"> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($organs as $r => $organ)
						<tr>
							<th> {{$r+1}} </th>
							<td class="
								@if($organ->status == 1)
									bg-warning
								@elseif($organ->status == 2)
									bg-info text-light
								@elseif($organ->status == 3)
									bg-danger text-light
								@else bg-success text-light
							@endif">
								{{$organ->stat}}
							</td>
							<td> {{$organ->full_name}} </td>
							<td dir="ltr"> {{$organ->phone}} </td>
							<td> {{$organ->state}} </td>
							<td> {{$organ->city}} </td>
							<td> {{$organ->national_code}} </td>
							<td> {{$organ->birth_date}} </td>
							<td> {{$organ->educations}} </td>
							<td> {{$organ->workshop_location}} </td>
							<td> {{$organ->workshop_title}} </td>
							<td> {{$organ->postal_code}} </td>
							<td> {{$organ->service}} </td>
							<td> {{$organ->shifts}} </td>
							<td> {{$organ->shift_hours}} </td>
							<td> {{$organ->meal}} </td>
							<td> {{$organ->payment_amount}} </td>
							<td> {{nf($organ->offered_payment)}} ریال </td>
							<td> {{$organ->madadjus_insurance}} </td>
							<td> {{$organ->full_insurance}} </td>
							<td> {{$organ->uid}} </td>
							<td>
								<form class="d-inline" action="{{route('organ.destroy', $organ)}}" method="post">
									@method('DELETE')
									@csrf
									<button type="button" class="btn btn-sm btn-outline-danger delete">
										حذف
									</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		{{$organs->links()}}
	</div>
@endsection
