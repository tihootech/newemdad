@extends('layouts.app')
@section('title')
<title> اطلاعیه های عمومی </title>
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h1 class="h3"> اطلاعیه های عمومی </h1>
        </div>
        <div class="card-body">

            @if ($nots->count())

                @foreach ($nots as $not)

                    <div class="alert alert-secondary py-3 my-3" role="alert">
                        <h4 class="alert-heading">{{$not->subject}}</h4>
                        <p>{{$not->body}}</p>
                        <hr>
                        <p class="mb-0">
                            تاریخ اطلاعیه: {{human_date($not->created_at)}}
                        </p>
                    </div>

                @endforeach
                {{$nots->links()}}

            @else
                <div class="alert alert-warning">
                    اطلاعیه ای یافت نشد.
                </div>
            @endif

        </div>
    </div>
@endsection
