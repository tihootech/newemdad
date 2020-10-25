@extends('layouts.dashboard')

@section('main')
	<div class="tile">

		<div class="table-responsive-lg">
			<table class="table table-sm table-bordered table-striped table-hover data-table">
				<thead>
					<tr>
						<th> نام کاربری </th>
						<th> نام شخص </th>
						<th> کدملی </th>
						<th> شهر </th>
						<th> نوع حساب کاربری </th>
						<th> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						@if ($user->owner)
							<tr>
								<td> {{$user->name}} </td>
								<td> {{$user->owner->full_name ?? '-'}} </td>
								<td> {{$user->owner->national_code ?? '-'}} </td>
								<td> {{$user->owner->city}} </td>
								<td>
									@if ($user->type == 'organ')
										کارفرما
									@else
										مددجو
									@endif
								</td>
								<td>
									<form class="d-flex" action="{{route('user.admin_update', $user)}}" method="post">
										@csrf
										@method('PUT')
										<input type="hidden" name="newpass" value="{{$user->owner->national_code}}">
										<button type="button" class="btn btn-warning btn-sm change-pass"> ریست کردن رمز عبور </button>
									</form>
								</td>
							</tr>
						@endif
					@endforeach
				</tbody>
			</table>
		</div>

	</div>
@endsection
