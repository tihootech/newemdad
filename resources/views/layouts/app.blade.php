<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('img/favicon.png')}}" type="image/gif">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    @yield('title')

    <link href="{{ asset('css/app.css') }}?v=2.5" rel="stylesheet">
    <link href="{{ asset('css/pdp.css') }}?v=2.5" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}?v=2.5" rel="stylesheet">
</head>
<body>

    <section class="main-banner">

        <div class="banner-container">

            <nav class="navbar navbar-expand-lg navbar-dark mb-auto mt-4">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto snip-nav">
                        <li class="nav-item @if(rn() == 'welcome') current @endif">
                            <a class="nav-link" href="{{url('/')}}">
                                <i class="fa fa-home ml-1"></i>
                                صفحه اصلی وبسایت
                            </a>
                        </li>
                        <li class="nav-item @if(rn() == 'login') current @endif">
                            <a class="nav-link" href="{{route('login')}}">
                                <i class="fa fa-user ml-1"></i>
                                ورود به کارتابل
                            </a>
                        </li>
                        <li class="nav-item @if(rn() == 'nots') current @endif">
                            <a class="nav-link" href="{{route('nots')}}">
                                <i class="fa fa-bullhorn ml-1"></i>
                                اطلاعیه های عمومی
                            </a>
                        </li>
                        <li class="nav-item @if(rn() == 'contactus') current @endif">
                            <a class="nav-link" href="{{route('contactus')}}">
                                <i class="fa fa-phone ml-1"></i>
                                تماس با ما
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="mb-auto mx-auto content-yield">
                @yield('content')
            </div>
        </div>

    </section>


    <script src="{{ asset('js/app.js') }}?v=2.5"></script>
    <script src="{{ asset('js/pdp.min.js') }}?v=2.5"></script>
    <script src="{{ asset('js/main.js') }}?v=2.5"></script>
</body>
</html>
