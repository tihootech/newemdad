@extends('layouts.dashboard')
@section('title')
	<title> لیست مسئولین شهرستان ها </title>
@endsection

@section('main')

	<div class="tile text-left">
		<a href="{{route('expert.create')}}" class="btn btn-outline-primary"> <i class="fa fa-user-plus ml-1"></i> تعریف مسئول جدید </a>
	</div>

	<div class="tile">
		<div class="table-responsive-lg">
			<table class="table table-sm table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th> ردیف </th>
						<th> نام </th>
						<th> نام خانوادگی </th>
						<th> شهرستان </th>
						<th> کدملی </th>
						<th> نام کاربری </th>
						<th colspan="2"> عملیات </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($experts as $r => $expert)
						<tr>
							<th> {{$r+1}} </th>
							<td> {{$expert->first_name}} </td>
							<td> {{$expert->last_name}} </td>
							<td> {{$expert->city}} </td>
							<td> {{$expert->national_code}} </td>
							<td> {{$expert->user->name ?? 'DB ERROR'}} </td>
							<td> <a href="{{route('expert.edit', $expert)}}" class="btn btn-sm btn-outline-success"> ویرایش </a> </td>
							<td>
								<form class="d-inline" action="{{route('expert.destroy', $expert)}}" method="post">
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
	</div>
@endsection
