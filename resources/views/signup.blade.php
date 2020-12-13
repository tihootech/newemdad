@extends('layouts.app')

@section('title')
<title>
    @if ($type == 1)
        مددجوی متقاضی شغل
    @elseif ($type == 2)
        متقاضی تسهیلات (وام)
    @elseif ($type == 3)
        بیمه خویش فرمائی و کارفرمائی
    @endif
</title>
@endsection

@section('content')

    <div class="card mb-5">
        <div class="card-header text-center">
            <h1 class="h3">
                @if ($type == 1)
                    مددجوی متقاضی شغل
                @elseif ($type == 2)
                    متقاضی تسهیلات (وام)
                @endif
            </h1>
            @if ($step < 5)
                <p class="mb-0">
                    مرحله {{$step}} :
                    @if ($step == 1)
                         ایجاد حساب کاربری
                    @endif
                    @if ($step == 2)
                         تکمیل اطلاعات فردی
                    @endif
                    @if ($step == 3)
                        کد رهگیری
                    @endif
                </p>
            @endif
        </div>
        <div class="card-body px-md-5 px-3 pb-5">

            <div class="mb-4">
                @include('partials.errors_and_messages')
            </div>


            @include('steps.step_'.$step)

            <hr>

            @if ($step == 3)
                <div class="text-center mt-4">
                    <a href="{{url('/')}}" class="btn btn-outline-danger"> رفتن به صفحه اصلی </a>
                    <a href="{{route('home')}}" class="btn btn-outline-danger"> رفتن به داشبورد </a>
                </div>
            @endif
        </div>

        @if ($step > 1 && $step < 3)
            <div class="card-footer d-flex">
                <a href="{{route('signup', [$type, $step-1])}}" class="btn btn-secondary btn-round ml-auto"> مرحله قبل </a>
                <button form="wizard-form" class="btn btn-danger btn-round mr-auto">
                    @if ($step == 2)
                        خاتمه دادن
                    @else
                         مرحله بعد
                    @endif
                </button>
            </div>
        @endif
    </div>


@endsection
