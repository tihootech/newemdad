@extends('layouts.dashboard')
@section('title')
	<title>
		لیست اطلاعیه ها
	</title>
@endsection

@section('main')

	<div class="tile">
		@foreach ($notifications as $notification)
			<div class="card mb-3">
				<div class="card-header">
					<h5> {{$notification->subject}} </h5>
				</div>
				<div class="card-body">
					{{$notification->body}}
					@master
						<hr>
						<div class="text-left">
							<a href="{{route('notification.edit', $notification)}}" class="btn btn-success btn-sm"> ویرایش </a>
							<form class="d-inline" action="{{route('notification.destroy', $notification)}}" method="post">
		                        @method('DELETE')
		                        @csrf
		                        <button type="button" class="btn btn-sm btn-danger delete">
		                            حذف
		                        </button>
		                    </form>
						</div>
					@endmaster
				</div>
				<div class="card-footer">
					<div class="row text-center justify-content-center">
						<div class="col-md-3">
							<i class="fa fa-calendar-o ml-1"></i>
							<b> {{human_date($notification->created_at)}} </b>
						</div>
						<div class="col-md-3">
							<i class="fa fa-clock-o ml-1"></i>
							<b> {{$notification->created_at->format('H:i')}} </b>
						</div>
						@master
							<div class="col-md-3">
								<i class="fa fa-address-book-o ml-1"></i>
								<b> @lang($notification->contact) </b>
							</div>
							<div class="col-md-3">
								<i class="fa fa-map-marker ml-1"></i>
								<b> {{$notification->city ?? 'همه شهر ها'}} </b>
							</div>
						@endmaster
					</div>
				</div>
			</div>
		@endforeach
	</div>

@endsection
