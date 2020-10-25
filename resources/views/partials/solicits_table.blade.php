<table class="table table-sm table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th> ردیف </th>
            @admins
                <th> کارفرما </th>
            @endadmins
            <th> سن </th>
            <th> تحصیلات </th>
            <th> رشته تحصیلی </th>
            <th> گرایش تحصیلی </th>
            <th> وضعیت جسمانی </th>
            <th> نوع معلولیت </th>
            <th> شدت معلولیت </th>
            <th> وسیله نقلیه </th>
            <th> نوع مهارت </th>
            <th colspan="2"> عملیات </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($solicits as $r => $solicit)
            <tr>
                <th> {{$r+1}} </th>
                @admins
                    <th> {{$solicit->organ->workshop_title}} </th>
                @endadmins
                <td> از {{$solicit->age_from}} تا {{$solicit->age_to}} </td>
                <td> {{$solicit->educations ?? 'مهم نیست'}} </td>
                <td> {{$solicit->field_of_study ?? 'مهم نیست'}} </td>
                <td> {{$solicit->academic_orientation ?? 'مهم نیست'}} </td>
                <td> {{$solicit->health_status ?? 'مهم نیست'}} </td>
                <td> {{$solicit->disability_type ?? 'مهم نیست'}} </td>
                <td> {{$solicit->disability_level ?? 'مهم نیست'}} </td>
                <td> {{$solicit->vehicle_type ?? 'مهم نیست'}} </td>
                <td> {{$solicit->skill_type ?? 'مهم نیست'}} </td>
                @organ
                    <td> <a href="{{route('solicit.edit', $solicit)}}" class="btn btn-sm btn-outline-success"> ویرایش </a> </td>
                @endorgan
                @admins
                    <td> <a href="{{route('introduce.form', $solicit)}}" class="btn btn-sm btn-outline-info"> معرفی مددجو </a> </td>
                @endadmins
                <td>
                    <form class="d-inline" action="{{route('solicit.destroy', $solicit)}}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-sm btn-outline-danger delete">
                            حذف
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
