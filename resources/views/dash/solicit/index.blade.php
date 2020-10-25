@extends('layouts.dashboard')
@section('title')
	<title> لیست مسئولین شهرستان ها </title>
@endsection

@section('main')

	<div class="tile">
		@include('partials.solicits_table')
	</div>
@endsection
