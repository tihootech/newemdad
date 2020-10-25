@extends('layouts.app')

@section('title')
    <title> ورود به حساب کاربری </title>
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/main.css?v=2.4')}}">
@endsection

@section('content')
    <div class="wrap-login100 p-t-30 p-b-50 mx-auto">
        <span class="login100-form-title p-b-41">
            ورود به کارتابل
        </span>
        <form class="login100-form validate-form p-b-33 p-t-5" action="{{ route('login') }}" method="POST">
            <div class="text-center" style="color:red">
                @include('partials.errors_and_messages')
            </div>
            @csrf
            <div class="wrap-input100 validate-input" data-validate = "نام کاربری الزامی است">
                <input class="input100" type="text" name="name" placeholder="نام کاربری">
                <!-- <span class="focus-input100" data-placeholder="&#xe82a;"></span> -->
            </div>

            <div class="wrap-input100 validate-input" data-validate="رمزعبور الزامی است">
                <input class="input100" type="password" name="password" placeholder="رمزعبور">
                <!-- <span class="focus-input100" data-placeholder="&#xe80f;"></span> -->
            </div>

            <div class="container-login100-form-btn m-t-32">
                <button class="login100-form-btn">
                    ورود
                </button>
            </div>

        </form>
    </div>
@endsection
