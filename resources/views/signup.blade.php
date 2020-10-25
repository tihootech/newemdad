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
                @elseif ($type == 3)
                    بیمه خویش فرمائی و کارفرمائی
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
                        حوزه دارای پرونده
                    @endif
                    @if ($step == 4)
                        اطلاعات مورد نیاز با توجه به نوع در خواست شما
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
            @if ($step > 1)
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{($step-1)*25}}%;" aria-valuenow="{{($step-1)*25}}" aria-valuemin="0" aria-valuemax="100">
                        روند ثبت نام،
                        {{($step-1)*25}}% تکمیل شده است
                    </div>
                </div>
            @endif
            @if ($step == 5)
                <div class="text-center mt-4">
                    <a href="{{url('/')}}" class="btn btn-outline-danger"> رفتن به صفحه اصلی </a>
                </div>
            @endif
        </div>
        @if ($step > 1 && $step < 5)
            <div class="card-footer d-flex">
                <a href="{{route('signup', [$type, $step-1])}}" class="btn btn-secondary btn-round ml-auto"> مرحله قبل </a>
                <button form="wizard-form" class="btn btn-danger btn-round mr-auto">
                    @if ($step == 4)
                        خاتمه دادن
                    @else
                         مرحله بعد
                    @endif
                </button>
            </div>
        @endif
    </div>


@endsection
