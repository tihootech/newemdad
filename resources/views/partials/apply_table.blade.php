<table class="table table-sm table-striped table-bordered data-table">
    <thead>
        <tr>
            <th> # </th>
            <th> نام و نام خانوادگی شخص </th>
            <th> شهر </th>
            <th> تاریخ ایجاد </th>
            <th> تاریخ آخرین تغییر </th>
            <th> کدرهگیری </th>
            <th colspan="2"> عملیات </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($actions[$type] as $i => $apply)
            <tr>
                <th> {{$i+1}} </th>
                <td> {{$apply->full_name ?? $apply->person->full_name ?? '-'}} </td>
                <td> {{$apply->city ?? $apply->person->city ?? '-'}} </td>
                <td> {{date_picker_date($apply->created_at)}} </td>
                <td> {{date_picker_date($apply->updated_at)}} </td>
                <td> {{$apply->uid}} </td>
                <td> <a href="{{route('madadju.edit', [$type, $apply->id])}}" class="btn btn-outline-success btn-sm"> ویرایش </a> </td>
                <td> <a href="#{{$type}}-modal-{{$apply->id}}" data-toggle="modal" class="btn btn-outline-primary btn-sm"> بررسی </a> </td>
            </tr>
        @endforeach
    </tbody>
</table>

@foreach ($actions[$type] as $i => $apply)
    <div class="modal fade" id="{{$type}}-modal-{{$apply->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" action="{{route('apply.reject', [$type, $apply->id])}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{$apply->full_name ?? $apply->person->full_name ?? '-'}}
                        <span class="badge {{$apply->status == 1 ? 'badge-warning' : 'badge-success'}}">
                            {{$apply->status == 1 ? 'درخواست جدید' : 'ویرایش یافته'}}
                        </span>
                        <span class="badge badge-primary">
                            @lang($type.'_apply')
                        </span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row justify-content-center modal-summury">

                        @include('partials.apply_content')

                    </div>

                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <input type="text" class="form-control" name="rejection_reason" placeholder="در صورت رد کردن علت رد کردن نیز باید ذکر شود" required>
                        <div class="text-center mt-3">
                            <button type="button" class="btn mx-1 btn-secondary" data-dismiss="modal">
                                <i class="fa fa-arrow-right ml-1"></i> انصراف
                            </button>
                            <button type="submit" class="btn mx-1 btn-warning"> <i class="fa fa-times ml-1"></i> رد کردن </button>
                            <button type="button" class="btn mx-1 btn-success" onclick="$('#{{$type}}-accept-form-{{$apply->id}}').submit()">
                                <i class="fa fa-check ml-1"></i> تایید اطلاعات
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form id="{{$type}}-accept-form-{{$apply->id}}" class="d-none" action="{{route('apply.accept', [$type, $apply->id])}}" method="post">
        @csrf
    </form>
@endforeach
