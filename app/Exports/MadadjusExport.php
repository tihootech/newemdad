<?php

namespace App\Exports;

use App\Person;
use App\Expert;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MadadjusExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function headings(): array
    {
        $init = [
            'id',
            'user_id',
            __('state'),
            __('city'),
            __('lifestyle'),
            __('address'),
            __('postal_code'),
            __('national_code'),
            __('first_name'),
            __('last_name'),
            __('father_name'),
            __('birth_certificate_number'),
            __('birth_date'),
            __('english_birth_date'),
            __('reference'),
            __('madadkar_name'),
            __('marital_status'),
            __('family_members'),
            __('gender'),
            __('education'),
            __('field_of_study'),
            __('academic_orientation'),
            __('warden_type'),
            __('health_status'),
            __('disables_in_family'),
            __('mobile'),
            __('information'),
            __('payed'),
            __('activity_section'),
            __('housing_status'),
            __('mortgage'),
            __('rent'),
            __('file_domain'),
            __('file_status'),
            __('disability_type'),
            __('disability_level'),
            __('created_at'),
            __('updated_at'),
        ];

        $rest['job'] = [
            __('person_id'),
            __('rahgiri_code'),
            __('skill_type'),
            __('interests'),
            __('vehicle_type'),
            __('status'),
        ];

        $rest['loan'] = [
            __('person_id'),
            __('rahgiri_code'),
            __('workshop_name'),
            __('license_type'),
            __('license_system'),
            __('plan_title'),
            __('required_finance'),
            __('suggested_bank'),
            __('insurance_number'),
            __('status'),
        ];

        $rest['insurance'] = [
            __('person_id'),
            __('rahgiri_code'),
            __('license_type'),
            __('license_system'),
            __('plan_title'),
            __('insurance_status'),
            __('insurance_number'),
            __('workshop_name'),
            __('monthly_amount'),
            __('shaba'),
            __('bank'),
            __('status'),
        ];

        return array_merge($init, $rest[$this->type]);
    }

    public function forType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    public function query()
    {
        $class = class_name($this->type).'Apply';
        $table = "{$this->type}_applies";
        if (class_exists($class)) {
            $applies = $class::join('people', 'people.id', '=', "$table.person_id");
            $applies = $applies->select('people.*', "$table.*");
            if (is('expert')) {
                $expert = Expert::where('user_id', user('id'))->firstOrFail();
                $applies = $applies->where('city', $expert->city);
            }
            $applies = $applies->orderBy('people.created_at', 'DESC');
        }
        return $applies;
    }
}
