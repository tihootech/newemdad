@extends('layouts.dashboard')
@section('title')
	<title>
		@if ($notification->id)
			ویرایش اطلاعیه
		@else
            اطلاع رسانی
		@endif
	</title>
@endsection

@section('main')

	<div class="tile text-left">
		<a href="{{route('notification.index')}}" class="btn btn-outline-primary">
			<i class="fa fa-list ml-1"></i>
			 لیست اطلاع رسانی های قبلی
		</a>
	</div>

	<div class="tile">
		<form class="row justify-content-center" action="@if($notification->id) {{route('notification.update', $notification)}} @else {{route('notification.store')}} @endif" method="post">
			@csrf
			@if ($notification->id)
				@method('PUT')
			@endif

			@include('partials.input', ['type' => 'text', 'name'=>'subject', 'col' => 5, 'required' => 1, 'object' => $notification])
			<div class="col-md-2 form-group">
                <label for="contact-type"> <b class="text-danger"> * </b> @lang('contact') </label>
                <select class="form-control" id="contact-type" name="contact" required>
                    <option value=""> -- انتخاب کنید -- </option>
                    <option @if($notification->contact == 'public') selected @endif value="public"> @lang('public') </option>
					<option @if($notification->contact == 'expert') selected @endif value="expert"> @lang('organs') </option>
                    <option @if($notification->contact == 'user') selected @endif value="user"> @lang('madadjus') </option>
                    <option @if($notification->contact == 'organ') selected @endif value="organ"> @lang('organs') </option>
                </select>
            </div>
			@include('partials.input', ['type' => 'select', 'name'=>'city', 'col' => 4, 'required' => 0, 'object' => $notification,
				'options' => defaults('city'), 'more_info' => 'در صورت تمایل میتوانید شهر را نیز ذکر کنید.', 'hide' => $notification->contact == 'public'
			])
            <div class="col-md-12 form-group">
                <label for="body"> <b class="text-danger"> * </b> متن اطلاعیه </label>
                <textarea name="body" id="body" rows="8" class="form-control">{{$notification->body}}</textarea>
            </div>

			<hr class="w-100">
			<div class="col-md-2 mx-auto">
				<button type="submit" class="btn btn-outline-primary btn-block"> تایید </button>
			</div>


		</form>
	</div>

@endsection
