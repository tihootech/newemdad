<div class="table-responsive mb-3" @if($imode) style="max-height:400px; overflow-y:auto" @endif>
    <table class="table table-bordered table-sm table-striped table-hover fixed-width text-center">
        <thead>
            <tr>
                <th> ردیف </th>
                <th> یادداشت ها </th>
                <th style="min-width:200px"> نام </th>
                <th> @lang('city') </th>
                <th> @lang('lifestyle') </th>
                <th style="min-width:200px"> @lang('address') </th>
                <th> @lang('postal_code') </th>
                <th> @lang('national_code') </th>
                <th> @lang('father_name') </th>
                <th> @lang('birth_certificate_number') </th>
                <th> @lang('birth_date') </th>
                <th> ارجاع دهنده </th>
                <th style="min-width:200px"> @lang('madadkar_name') </th>
                <th> @lang('marital_status') </th>
                <th> @lang('family_members') </th>
                <th> @lang('gender') </th>
                <th> @lang('military_status') </th>
                <th> @lang('education') </th>
                <th> @lang('field_of_study') </th>
                <th> @lang('academic_orientation') </th>
                <th> @lang('warden_type') </th>
                <th> @lang('health_status') </th>
                <th style="min-width:200px"> @lang('disables_in_family') </th>
                <th> @lang('mobile') </th>

                @if ($type == 'job')
                    <th style="min-width:200px"> @lang('skill_type') </th>
                    <th style="min-width:200px"> @lang('interests') </th>
                    <th> @lang('vehicle_type') </th>
                @endif

                @if ($type == 'loan')
                    <th> @lang('workshop_name') </th>
                    <th> @lang('license_type') </th>
                    <th style="min-width:200px"> @lang('license_system') </th>
                    <th> @lang('plan_title') </th>
                    <th style="min-width:200px"> @lang('required_finance') </th>
                    <th> @lang('suggested_bank') </th>
                    <th> @lang('insurance_number') </th>
                @endif

                @if ($type == 'insurance')
                    <th> @lang('license_type') </th>
                    <th style="min-width:200px"> @lang('license_system') </th>
                    <th> @lang('plan_title') </th>
                    <th> @lang('insurance_status') </th>
                    <th> @lang('insurance_number') </th>
                    <th> @lang('workshop_name') </th>
                    <th> @lang('workshop_code') </th>
                    <th style="min-width:200px"> @lang('monthly_amount') </th>
                    <th style="min-width:200px"> @lang('shaba') </th>
                    <th> @lang('bank') </th>
                @endif

                <th style="min-width:200px"> @lang('information') </th>
                <th> تاریخ درخواست </th>
                <th> کدرهگیری </th>
                <th colspan="2"> عملیات </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $r => $person)
                <tr>
                    <th> {{$r+1}} </th>
                    <td> <a href="#" data-toggle="modal" data-target="#histroy-{{$person->id}}"> <i class="fa fa-calendar-o"></i> </a> </td>
                    <td> {{$person->full_name ?? '-'}} </td>
                    <td> {{$person->city ?? '-'}} </td>
                    <td> {{$person->lifestyle ?? '-'}} </td>
                    <td data-content="{{$person->address}}"> {{short($person->address, 20)}} </td>
                    <td> {{$person->postal_code ?? '-'}} </td>
                    <td> {{$person->national_code ?? '-'}} </td>
                    <td> {{$person->father_name ?? '-'}} </td>
                    <td> {{$person->birth_certificate_number ?? '-'}} </td>
                    <td> {{$person->birth_date ?? '-'}} </td>
                    <td> {{$person->reference ?? '-'}} </td>
                    <td> {{$person->madadkar_name ?? '-'}} </td>
                    <td> {{$person->marital_status ?? '-'}} </td>
                    <td> {{$person->family_members ?? '-'}} </td>
                    <td> {{$person->gender ?? '-'}} </td>
                    <td> {{$person->gender == 'مرد' ? ($person->military_status ?? 'نامشخص') : '-'}} </td>
                    <td> {{$person->education ?? '-'}} </td>
                    <td> {{$person->field_of_study ?? '-'}} </td>
                    <td> {{$person->academic_orientation ?? '-'}} </td>
                    <td> {{$person->warden_type ?? '-'}} </td>
                    <td> {{$person->health_status ?? '-'}} </td>
                    <td> {{$person->disables_in_family ?? '-'}} </td>
                    <td dir="ltr"> {{$person->mobile ?? '-'}} </td>

                    @if ($type == 'job')
                        <td data-content="{{$person->skill_type}}"> {{short($person->skill_type, 20)}} </td>
                        <td data-content="{{$person->interests}}"> {{short($person->interests, 20)}} </td>
                        <td> {{$person->vehicle_type}} </td>
                    @endif

                    @if ($type == 'loan')
                        <td> {{$person->workshop_name}} </td>
                        <td> {{$person->license_type}} </td>
                        <td> {{$person->license_system}} </td>
                        <td> {{$person->plan_title}} </td>
                        <td> {{nf($person->required_finance)}} ریال </td>
                        <td> {{$person->suggested_bank}} </td>
                        <td> {{$person->insurance_number}} </td>
                    @endif

                    @if ($type == 'insurance')
                        <td> {{$person->license_type}} </td>
                        <td> {{$person->license_system}} </td>
                        <td> {{$person->plan_title}} </td>
                        <td> {{$person->insurance_status}} </td>
                        <td> {{$person->insurance_number}} </td>
                        <td> {{$person->workshop_name}} </td>
                        <td> {{$person->workshop_code ?? '-'}} </td>
                        <td> {{nf($person->monthly_amount)}} ریال </td>
                        <td> {{$person->shaba}} </td>
                        <td> {{$person->bank}} </td>
                    @endif

                    <td data-content="{{$person->information}}"> {{short($person->information, 20)}} </td>
                    <td> {{date_picker_date($person->created_at)}} </td>
                    <td> {{$person->uid}} </td>
                    @unless ($imode)
                        <td>
                            <a href="{{route('madadju.edit', [$type, $person->id])}}" class="btn btn-sm btn-outline-success">
                                ویرایش
                            </a>
                        </td>
                    @endunless
                    <td>
                        @if ($imode)
                            <button type="button" class="btn btn-sm btn-outline-info">
                                معرفی
                            </button>
                        @else
                            <form class="d-inline" action="{{route('apply.destroy', [$type, $person->id])}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="btn btn-sm btn-outline-danger delete">
                                    حذف
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@foreach ($list as $r => $person)
    <div class="modal fade" id="histroy-{{$person->id}}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$person->full_name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($person && $person->histories->count())

                        <div class="text-center mb-3">
                            <a href="#new-note-{{$person->id}}" data-toggle="collapse"> <i class="fa fa-plus ml-1"></i> یادداشت جدید </a>
                        </div>
                        <form class="text-center collapse" method="post" action="{{route('note')}}" id="new-note-{{$person->id}}">
                            @csrf
                            <input type="hidden" name="person_id" value="{{$person->id}}">
                            <textarea required name="description" rows="4" class="form-control"></textarea>
                            <button type="submit" class="btn btn-primary my-2"> ذخیره یادداشت جدید </button>
                        </form>

                        @foreach ($person->histories as $history)
                            <div class="card my-2">
                                <div class="card-body">
                                    <p>
                                        <b class="text-primary"> {{$history->description}} </b>
                                        @if ($history->user_id == auth()->id())
                                            <a class="text-info float-left" href="#edit-note-{{$person->id}}" data-toggle="collapse"> ویرایش </a>
                                            <form class="text-center collapse" method="post" action="{{route('note.update', $history->id)}}" id="edit-note-{{$person->id}}">
                                                @csrf
                                                <textarea required name="description" rows="4" class="form-control">{{$history->description}}</textarea>
                                                <button type="submit" class="btn btn-primary my-2"> ویرایش یادداشت </button>
                                            </form>
                                        @endif
                                    </p>
                                    <hr>
                                    <div class="row text-center justify-content-center">
                                        <div class="col-md-3">
                                            <i class="fa fa-calendar"></i>
                                            {{human_date($history->created_at)}}
                                        </div>
                                        <div class="col-md-3">
                                            <i class="fa fa-clock-o"></i>
                                            {{$history->created_at->format('H:i')}}
                                        </div>
                                        <div class="col-md-6">
                                            <i class="fa fa-user"></i>
                                            @if ($user = $history->user)
                                                @if ($user->type == 'master')
                                                    ناظر سیستم
                                                @elseif($user->owner)
                                                    {{$user->owner->full_name ?? '--'}}
                                                    ({{$user->owner->city ?? '--'}})
                                                @else
                                                    <em> کاربر حذف شده است </em>
                                                @endif
                                            @else
                                                یادداشت اتوماتیک سیستم
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @else
                        <div class="alert alert-warning">
                            تاریخچه این شخص خالی است.
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
