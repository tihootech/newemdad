@extends('layouts.dashboard')

@section('title')
    <title> داشبورد شما </title>
@endsection

@section('main')

    @if (is('admin') && count($solicits))
        <div class="tile">
            <h4 class="text-center"> <i class="fa fa-list ml-1"></i> کارفرمایانی که نیاز به مددجو دارند </h4>
            <hr>
            <div class="table-responsive-lg">
                @include('partials.solicits_table')
            </div>
        </div>
    @endif

    <div class="tile">
        @admins

            <h4 class="text-center"> <i class="fa fa-list ml-1"></i> لیست درخواست هایی که به بررسی احتیاج دارند </h4>
            <hr>
            @if ($actions_count)
                <div class="row justify-content-center">
                    @if (count($actions['job']))
                        <div class="col-md-12 col-lg-9">
                            <h4 class="text-primary text-center my-3"> @lang('job_apply') </h4>
                            <div class="table-responsive-lg">
                                @include('partials.apply_table', ['type' => 'job'])
                            </div>
                            <hr class="w-100">
                        </div>
                    @endif
                    @if (count($actions['loan']))
                        <div class="col-md-12 col-lg-9">
                            <h4 class="text-primary text-center my-3"> @lang('loan_apply') </h4>
                            <div class="table-responsive-lg">
                                @include('partials.apply_table', ['type' => 'loan'])
                            </div>
                            <hr class="w-100">
                        </div>
                    @endif
                    @if (count($actions['insurance']))
                        <div class="col-md-12 col-lg-9">
                            <h4 class="text-primary text-center my-3"> @lang('insurance_apply') </h4>
                            <div class="table-responsive-lg">
                                @include('partials.apply_table', ['type' => 'insurance'])
                            </div>
                            <hr class="w-100">
                        </div>
                    @endif
                    @if (count($actions['organ']))
                        <div class="col-md-12 col-lg-9">
                            <h4 class="text-primary text-center my-3"> @lang('organ_apply') </h4>
                            <div class="table-responsive-lg">
                                @include('partials.apply_table', ['type' => 'organ'])
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <div class="alert alert-info">
                    <i class="fa fa-check ml-1"></i>
                    درحال حاضر
                    ثبت نام جدیدی برای بررسی وجود ندارد.
                </div>
            @endif

        @endadmins

        @regular_user
            <h3> اطلاعات ثبت شده شما </h3>
            <hr>
            @foreach ($types as $i => $type)
                <h4 class="text-center my-3">
                    @if ($type == 'job')
                        درخواست شغل
                    @elseif ($type == 'loan')
                        درخواست وام
                    @elseif ($type == 'insurance')
                        بیمه کارفرمایی
                    @endif
                </h4>
                <div class="row modal-summury">
                    @if ($apply = $person->applied($i+1))
                        @include('partials.apply_content')
                        <div class="w-75 py-2 mx-auto alert alert-info my-3 text-center">
                            <span>
                                درصورتی که تمایل دارید این اطلاعات را ویرایش کنید
                                <a href="{{route('signup' , [$i+1, 2])}}"> کلیک کنید </a>
                            </span>
                            <br>
                            <span> توجه داشته باشید که در صورت ویرایش این اطلاعات، وضعیت درخواست شما معلق میشود و کارشناس مجدد درخواست شما را بررسی میکند. </span>
                        </div>
                    @else
                        <div class="w-75 mx-auto text-center py-3 alert alert-warning">
                            عدم ثبت نام
                        </div>
                    @endif
                </div>
            @endforeach
        @endregular_user
    </div>
@endsection
