@extends('layouts.app')
@section('title')
<title> کمیته امداد استان کرمانشاه </title>
@endsection
@section('content')

    <div class="text-center">
        <h1 class="text-light h2 my-4">
            <strong class="d-block my-4"> کمیته امداد استان کرمانشاه </strong>
            <strong class="d-block my-4"> معاونت اشتغال و کارآفرینی </strong>
        </h1>
        <hr class="border-light w-50">
        <a href="{{route('signup', 1)}}" class="btn bg-light btn-round m-1">
            مددجوی متقاضی شغل
        </a>
        <a href="{{route('signup', 2)}}" class="btn bg-light btn-round m-1">
            متقاضی تسهیلات (وام)
        </a>
        <a href="{{route('organ.signup')}}" class="btn bg-light btn-round m-1">
            ثبت نام کارفرمایان
        </a>
    </div>

    {{-- <img src="{{asset('img/white-logo.png')}}" alt="کمیته امداد استان کرمانشاه" class="main-logo"> --}}

@endsection
