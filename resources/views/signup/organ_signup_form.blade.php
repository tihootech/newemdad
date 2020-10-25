@extends('layouts.app')

@section('title')
<title>
    ثبت نام کارفرمایان
</title>
@endsection

@section('content')

    <form action="{{route('organ.register')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header text-center">
                <h1 class="h3"> ثبت نام کارفرمایان </h1>
            </div>
            <div class="card-body">

                <p class="h5 text-center text-danger">
                    ***
                    این آیتم مختص کارفرمایانی است که تمایل به همکاری با اداره کل بهزیستی داشته و مایل هستند که به دلیل مسئولیت اجتماعی و یا دریافت تسهیلات و مشوق های حمایتی بیمه ای نسبت به جذب مددجویان تحت پوشش در کارگاه های تولیدی یا خدماتی خود اقدام نمایند.
                </p>

                <hr>

                <div class="mb-4">
                    @include('partials.errors_and_messages')
                </div>

                <div class="row justify-content-center">
                    @include('partials.input', ['type' => 'text', 'name'=>'in_charge_first_name', 'col' => 3, 'required' => 1])
                    @include('partials.input', ['type' => 'text', 'name'=>'in_charge_last_name', 'col' => 3, 'required' => 1])
                    @include('partials.input', ['type' => 'select', 'name'=>'city', 'col' => 3, 'required' => 1,
                        'options' => defaults('city')
                    ])
                    @include('partials.input', ['type' => 'text', 'name'=>'national_code', 'col' => 3, 'required' => 1])
                    @include('partials.input', ['type' => 'date', 'name'=>'birth_date', 'col' => 3, 'required' => 1])
                    @include('partials.input', ['type' => 'select', 'name'=>'educations', 'col' => 3, 'required' => 1,
                        'options' => defaults('education')
                    ])
                    @include('partials.input', ['type' => 'select', 'name'=>'workshop_location', 'col' => 3, 'required' => 1,
                        'options' => defaults('workshop_location')
                    ])
                    @include('partials.input', ['type' => 'text', 'name'=>'workshop_title', 'col' => 3, 'required' => 1])
                    @include('partials.input', ['type' => 'text', 'name'=>'address', 'col' => 9, 'required' => 1])
                    @include('partials.input', ['type' => 'text', 'name'=>'postal_code', 'col' => 3, 'required' => 1])
                    @include('partials.input', ['type' => 'select', 'name'=>'service', 'col' => 2, 'required' => 1,
                        'options' => defaults()
                    ])
                    @include('partials.input', ['type' => 'select', 'name'=>'shifts', 'col' => 2, 'required' => 1,
                        'options' => defaults()
                    ])
                    @include('partials.input', ['type' => 'text', 'name'=>'shift_hours', 'col' => 3, 'required' => 1])
                    @include('partials.input', ['type' => 'select', 'name'=>'meal', 'col' => 2, 'required' => 1,
                        'options' => defaults('meal')
                    ])
                    @include('partials.input', ['type' => 'select', 'name'=>'payment_amount', 'col' => 3, 'required' => 1,
                        'options' => defaults('payment_amount')
                    ])
                    @include('partials.input', ['type' => 'text', 'name'=>'offered_payment', 'col' => 3, 'required' => 0, 'placeholder' => 'به ریال'])
                    @include('partials.input', ['type' => 'select', 'name'=>'madadjus_insurance', 'col' => 2, 'required' => 1,
                        'options' => defaults()
                    ])
                    @include('partials.input', ['type' => 'select', 'name'=>'full_insurance', 'col' => 2, 'required' => 1,
                        'options' => defaults()
                    ])
                    @include('partials.input', ['type' => 'text', 'name'=>'phone', 'col' => 3, 'required' => 1])

                    <hr class="w-100">
                    <p class="w-100 text-center text-danger">
                        برای ثبت نام شما نیاز به یک حساب کاربری خواهید داشت. لطفا یک نام و یک رمز عبور به دلخواه خود انتخاب کنید.
                    </p>
                    @include('partials.input', ['type' => 'text', 'name'=>'username', 'col' => 3, 'required' => 1])
                    @include('partials.input', ['type' => 'password', 'name'=>'password', 'col' => 3, 'required' => 1])
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary"> تایید و ثبت نام </button>
            </div>
        </div>

    </form>


@endsection
