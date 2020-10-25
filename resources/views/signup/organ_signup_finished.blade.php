@extends('layouts.app')

@section('title')
<title>
    پیگری ثبت نام
</title>
@endsection

@section('content')

    <section class="align-items-center d-flex bg-dark main-banner">
        <div class="banner-container">
            <div class="card">
                <div class="card-header text-center">
                    <h1 class="h3"> کد رهگیری </h1>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                    	<div class="rahgiri">
                    		<b> کد رهگیری شما </b>
                    		<hr>
                    		<p class="m-0 p-0">
                    			@foreach ( str_split($uid) as $i => $char)
                    				@if ($i)
                    					<b class="text-danger"> - </b>
                    				@endif
                    				<span class="rahgiri-char"> {{$char}} </span>
                    			@endforeach
                    		</p>
                    	</div>
                    </div>
                    <hr>
                    <p class="text-danger text-center">
                        * همچنین نام کاربری و رمزعبوری که انتخاب کردید را به خاطر بسپارید *
                    </p>
                    <hr>
                    <div class="text-center mt-4">
                        <a href="{{url('/')}}" class="btn btn-outline-danger"> رفتن به صفحه اصلی </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
