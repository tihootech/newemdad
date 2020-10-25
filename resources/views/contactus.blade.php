@extends('layouts.app')
@section('title')
<title> تماس با ما </title>
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h1 class="h3"> تماس با ما </h1>
        </div>
        <div class="card-body p-0">

            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="card my-2">
                            <div class="card-header">
                                شماره تماس
                            </div>
                            <div class="card-body">
                                <a href="tel:08338380065"> 08338380065 </a>
                                و
                                <a href="tel:08338380067"> 08338380067 </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card my-2">
                            <div class="card-header">
                                آدرس
                            </div>
                            <div class="card-body">
                                کرمانشاه – میدان سپاه پاسداران (نفت) – بلوار زن – بلوار بهزیستی – ساختمان شهید سردار قاسم سلیمانی – معاونت اشتغال و کارآفرینی
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6781.473739169777!2d47.09531001598906!3d34.34515361217466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ffaed777835b5d3%3A0x52130fd66e71a735!2sBehzisti%2C%20Kermanshah%2C%20Kermanshah%20Province!5e0!3m2!1sen!2s!4v1591718648489!5m2!1sen!2s" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

        </div>
    </div>
@endsection
