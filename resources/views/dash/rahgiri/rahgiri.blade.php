@extends('layouts.dashboard')
@section('title')
	<title> جستجوی کدرهگیری </title>
@endsection

@section('main')

	<div class="tile">

        <div class="row">

			<div class="col-md-6 mb-2">
				<form class="row justify-content-center">
		            <div class="col-md-6 form-group">
		                <label for="c"> کدرهگیری </label>
		                <input type="text" class="form-control" id="c" name="c" value="{{$request->c}}" autocomplete="off">
		            </div>
		            <div class="col-md-6 form-group align-self-end">
		                <button type="submit" class="btn btn-primary btn-block"> جستجو بر اساس کدرهگیری </button>
		            </div>
		        </form>
			</div>

			<hr class="w-100 d-block d-md-none">

	        <div class="col-md-6 mb-2">
				<form class="row justify-content-center">
		            <div class="col-md-6 form-group">
		                <label for="n"> کدملی </label>
		                <input type="text" class="form-control" id="n" name="n" value="{{$request->n}}" autocomplete="off">
		            </div>
		            <div class="col-md-6 form-group align-self-end">
		                <button type="submit" class="btn btn-primary btn-block"> جستجو بر اساس کدملی </button>
		            </div>
		        </form>
	        </div>

        </div>

	</div>

	@if ($request->c)

		<div class="tile">
			<h4 class="text-center text-primary mb-3"> کد رهگیری وارد شده </h4>

			@if ($job)
				<div class="alert alert-info">
					<h5> @lang('job_apply') </h5>
					<hr>
					<b> {{$job->person->full_name}} </b>
					<p class="my-2"> وضعیت : {{$job->stat}} </p>
				</div>
				<div class="row modal-summury">
					@include('partials.apply_content', ['type' => 'job', 'apply' => $job])
				</div>
			@elseif ($loan)
				<div class="alert alert-info">
					<h5> @lang('loan_apply') </h5>
					<hr>
					<b> {{$loan->person->full_name}} </b>
					<p class="my-2"> وضعیت : {{$loan->stat}} </p>
				</div>
				<div class="row modal-summury">
					@include('partials.apply_content', ['type' => 'loan', 'apply' => $loan])
				</div>
			@elseif ($insurance)
				<div class="alert alert-info">
					<h5> @lang('insurance_apply') </h5>
					<hr>
					<b> {{$insurance->person->full_name}} </b>
					<p class="my-2"> وضعیت : {{$insurance->stat}} </p>
				</div>
				<div class="row modal-summury">
					@include('partials.apply_content', ['type' => 'insurance', 'apply' => $insurance])
				</div>
			@elseif ($organ)
				<div class="alert alert-info">
					<h5> کارفرما </h5>
					<hr>
					<b> {{$organ->full_name}} </b>
					<p class="my-2"> وضعیت : {{$organ->stat}} </p>
				</div>
			@else

				<div class="alert alert-warning">
					هیچ آیتمی در سیستم با این کد رهگیری پیدا نشد.
				</div>

			@endif
		</div>

	@endif

	@if ($request->n)
		@if ($person)
			@foreach ($types as $i => $type)
				<div class="tile">
					<h4 class="text-center my-3">
						@if ($type == 'job')
							درخواست شغل
						@elseif ($type == 'loan')
							درخواست وام
						@elseif ($type == 'insurance')
							بیمه کارفرمایی
						@endif
					</h4>
					<div class="row modal-summury">
						@if ($apply = $person->applied($i+1))
							@include('partials.apply_content')
							<div class="w-75 mx-auto text-center py-3 my-2 alert alert-info">
								وضعیت : {{$apply->stat}}
							</div>
						@else
							<div class="w-75 mx-auto text-center py-3 alert alert-warning">
								عدم ثبت نام
							</div>
						@endif
					</div>
				</div>
			@endforeach
		@else
			<div class="tile">
				<div class="alert alert-warning">
					شخصی با این کدملی در سیستم یافت نشد.
				</div>
			</div>
		@endif
	@endif
@endsection
