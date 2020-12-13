@extends('layouts.dashboard')
@section('title')
	<title> لیست آگهی ها </title>
@endsection

@section('main')

	<div class="tile">

		<div class="text-left">
            <a href="{{route('ad.create')}}" class="btn btn-info btn-sm"> + تعریف آگهی جدید </a>
        </div>
        <hr>
        <table class="table table-responsive-lg table-bordered">
            <thead>
                <tr>
                    <th> # </th>
                    <th> @lang('title') </th>
                    <th> @lang('payment') </th>
                    <th> @lang('count') </th>
                    <th> @lang('gender') </th>
                    <th> @lang('service') </th>
                    <th> @lang('dorm') </th>
                    <th> @lang('shifts') </th>
                    <th> @lang('job_type') </th>
                    <th> @lang('address') </th>
                    <th> @lang('info') </th>
                    <th> @lang('image') </th>
                    <th> تایید شده </th>
                    <th colspan="3"> عملیات </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ads as $i => $ad)
                    <tr>
                        <th> {{$i+1}} </th>
                        <td> {{$ad->title}} </td>
                        <td> {{number_format($ad->payment)}} </td>
                        <td> {{$ad->count}} </td>
                        <td> {{$ad->gender}} </td>
                        <td>
                            @if ($ad->service)
                                <i class="fa fa-check text-success"></i>
                            @else
                                <i class="fa fa-times text-danger"></i>
                            @endif
                        </td>
                        <td>
                            @if ($ad->doem)
                                <i class="fa fa-check text-success"></i>
                            @else
                                <i class="fa fa-times text-danger"></i>
                            @endif
                        </td>
                        <td> {{$ad->shifts}} </td>
                        <td> {{$ad->job_type_persian}} </td>
                        <td> <a href="#" data-toggle="popover" data-content="{{$ad->address}}"> <i class="fa fa-comment"></i> </a> </td>
                        <td>
                            @if ($ad->info)
                                <a href="#" data-toggle="popover" data-content="{{$ad->info}}"> <i class="fa fa-comment"></i> </a>
                            @else
                                -
                            @endif
                        </td>
                        <td> <a href="{{asset($ad->image)}}" target="_blank"> <i class="fa fa-image"></i> </a> </td>
                        <td>
                            @if ($ad->accepted)
                                <i class="fa fa-check text-success"></i>
                            @else
                                <i class="fa fa-times text-danger"></i>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('ad.edit', $ad)}}" class="text-success" data-toggle="tooltip" data-title="ویرایش"> <i class="fa fa-edit"></i> </a>
                        </td>
                        <td>
                            <a href="{{route('ad.stat', $ad)}}" data-title="{{$ad->accepted ? 'ردکردن' : 'تاییدکردن'}}" data-toggle="tooltip" class="text-warning">
                                <i class="fa fa-{{$ad->accepted ? 'times' : 'check'}}"></i>
                            </a>
                        </td>
                        <td>
                            <form class="d-inline" action="{{route('ad.destroy', $ad)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="btn btn-sm btn-link text-danger m-0 p-0 delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

	</div>
@endsection
