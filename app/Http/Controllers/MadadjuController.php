<?php

namespace App\Http\Controllers;

use App\Person;
use App\User;
use App\Expert;
use App\Exports\MadadjusExport;
use Illuminate\Http\Request;

use App\Rules\NationalCode as NationalCodeRule;
use App\Rules\PersianDate as PersianDateRule;
use Illuminate\Validation\Rule;

class MadadjuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admins');
    }

    public function export(Request $request)
    {
        $filename = now();
        return (new MadadjusExport)->forType($request->type)->download("$filename.xlsx");
    }

    public function edit($type, $id)
    {
        $class = class_name($type).'Apply';
        if (class_exists($class)) {
            $object = $class::findOrFail($id);
            $person = $object->person;
            $edit_by_admins_mode = true;
            return view('dash.madadju.edit', compact('object', 'person', 'type', 'edit_by_admins_mode'));
        }else {
            abort(404);
        }
    }

    public function update($type, $id, Request $request)
    {
        // init objects
        $class = class_name($type).'Apply';
        $apply = $class::findOrFail($id);
        $person = $apply->person;

        // validate request
        $person_data = $request->validate([

            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'father_name' => 'required|string',
            'city' => Rule::in( defaults('city') ),
            'lifestyle' => Rule::in( defaults('lifestyle') ),
            'national_code' => ['required', new NationalCodeRule, 'unique:people,national_code,'.$person->id],
            'address' => 'required|string',
            'postal_code' => 'required|string|size:10',
            'mobile' => 'required|string|size:11|unique:people,mobile,'.$person->id,
            'birth_date' => new PersianDateRule,
            'birth_certificate_number' => 'required|string',
            'reference' => 'nullable',
            'madadkar_name' => 'required|string',
            'marital_status' => Rule::in( defaults('marital_status') ),
            'military_status' => ['nullable', Rule::in( defaults('military_status') )],
            'family_members' => 'required|integer',
            'gender' => Rule::in( defaults('gender') ),
            'education' => Rule::in( defaults('education') ),
            'field_of_study' => 'nullable',
            'academic_orientation' => 'nullable',
            'warden_type' => Rule::in( defaults('warden_type') ),
            'health_status' => Rule::in( defaults('health_status') ),
            'disables_in_family' => 'required|integer',

            'file_domain' => [ 'required', Rule::in( defaults('file_domain') )],
            'disability_type' => [
                'nullable',
                Rule::requiredIf($request->file_domain == 'توانبخشی'),
                Rule::in( defaults('disability_type') )
            ],
            'disability_level' => [
                'nullable',
                Rule::requiredIf($request->file_domain == 'توانبخشی'),
                Rule::in( defaults('disability_level') )
            ],
            'file_status1' => [
                'nullable',
                Rule::requiredIf($request->file_domain == 'اجتماعی'),
                Rule::in( defaults('file_status_1') )
            ],
            'file_status2' => [
                'nullable',
                Rule::requiredIf($request->file_domain == 'پیشگیری'),
                Rule::in( defaults('file_status_2') )
            ],

            'payed' => [ 'nullable', Rule::requiredIf($request->are_you_payed == 'هستم') , 'integer'],
            'activity_section' => [ 'required', Rule::in( defaults('activity_section') ) ],
            'housing_status' => [ 'required', Rule::in( defaults('housing_status') ) ],
            'mortgage' => [ 'nullable', Rule::requiredIf($request->housing_status == 'استیجاری') , 'integer'],
            'rent' => [ 'nullable', Rule::requiredIf($request->housing_status == 'استیجاری') , 'integer'],
            'information' => 'nullable'
        ]);

        if ($type == 'job') {
            $apply_data = $request->validate([
                'skill_type' => 'required',
                'interests' => 'required',
                'vehicle_type' => [ 'required', Rule::in( defaults('vehicle_type') ) ],
            ]);
        }
        if ($type == 'loan') {
            $apply_data = $request->validate([
                'workshop_name' => 'required|string',
                'license_type' => 'required|string',
                'license_system' => 'required|string',
                'plan_title' => 'required|string',
                'required_finance' => 'required|integer',
                'suggested_bank' => 'required|string',
                'insurance_number' => 'nullable',
            ]);
        }
        if ($type == 'insurance') {
            $apply_data = $request->validate([
                'workshop_name' => 'required|string',
                'workshop_code' => 'required|string|size:10',
                'license_type' => 'required|string',
                'license_system' => 'required|string',
                'plan_title' => 'required|string',
                'insurance_status' => [ 'required', Rule::in( defaults('insurance_status') ) ],
                'insurance_number' => 'required|string',
                'monthly_amount' => 'required|integer',
                'shaba' => 'required|string',
                'bank' => 'required|string',
            ]);
        }

        // prepare and fix data
        $person_data['english_birth_date'] = persian_to_carbon($person_data['birth_date']);
        $person_data['disability_type'] = $request->file_domain == 'توانبخشی' ? $request->disability_type : null;
        $person_data['disability_level'] = $request->file_domain == 'توانبخشی' ? $request->disability_level : null;
        $person_data['file_status'] = $request->file_domain == 'اجتماعی' ? $request->file_status1 : $request->file_status2;
        unset($person_data['file_status1']);
        unset($person_data['file_status2']);

        // update database
        $person->update($person_data);
        $apply->update($apply_data);

        // redirect
        return back()->withMessage(__('MADADJU_UPDATED'));
    }

    public function index($type, Request $request)
    {
        $class = class_name($type).'Apply';
        $table = "{$type}_applies";
        if (class_exists($class)) {
            $applies = $class::join('people', 'people.id', '=', "$table.person_id");
            $applies = $applies->select('people.*', "$table.*");

            if (is('expert')) {
                $expert = Expert::where('user_id', user('id'))->firstOrFail();
                $applies = $applies->where('city', $expert->city);
            }

            if ( $request->name ) {
                $applies = $applies->where(function ($q) use ($request) {
                    $q->where('first_name', 'like', "%$request->name%")->orWhere('last_name', 'like', "%$request->name%");
                });
            }
            if ( $request->national_code ) {
                $applies = $applies->where('national_code', 'like', "%$request->national_code%");
            }
            if ( $request->city ) {
                $applies = $applies->where('city', $request->city);
            }
            if ( $request->mobile ) {
                $applies = $applies->where('mobile', 'like', "%$request->mobile%");
            }

            $applies = $applies->orderBy('people.created_at', 'DESC')->paginate(12);
            return view('dash.madadju.index', compact('applies', 'type'));
        }else {
            abort(404);
        }
    }

    public function destroy($type, $id)
    {
        $class = class_name($type).'Apply';
        if (class_exists($class)) {
            $object = $class::findOrFail($id);
            $expert = Expert::where('user_id', user('id'))->firstOrFail();
            if ($object->person->city != $expert->city) {
                return back()->withError(__('ERROR'));
            }
            Person::where('id', $object->person->id)->delete();
            User::where('id', $object->person->user_id)->delete();
            $object->delete();
            return back()->withMessage( __('DELETED_SUCCESSFULLY') );
        }else {
            abort(404);
        }
    }
}
