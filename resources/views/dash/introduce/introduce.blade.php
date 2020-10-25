@extends('layouts.dashboard')
@section('title')
	<title> معرفی مددجو </title>
@endsection

@section('main')

	<div class="tile">

        <h4 class="text-center"> <i class="fa fa-list ml-1"></i> لیست مددجویانی که بادرخواست شخص تطابق دارند </h4>
        <hr>
        @if ($list->count())
            @include('partials.madadjus_table', ['type' => 'job', 'imode' => 1])
        @else
            <div class="alert alert-info">
                متاسفانه هیچ مددجویی با این مشخصات در سیستم پیدا نشد.
                <hr>
                <a href="{{route('madadjus', 'job')}}" class="btn btn-outline-dark"> جستجو بین تمام مددجویان </a>
            </div>
        @endif

        <form class="row" action="{{route('introduce.action', $solicit)}}" method="post">
            @csrf
        </form>

	</div>

@endsection
