<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use App\Rules\NationalCode as NationalCodeRule;
use App\Rules\PersianDate as PersianDateRule;

use App\User;
use App\Person;
use App\JobApply;
use App\LoanApply;
use App\InsuranceApply;
use App\Organ;
use App\Expert;
use App\History;

class SignupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['accept', 'reject']);
        $this->middleware('admins')->only(['accept', 'reject']);
    }

    public function form($type, $step=1)
    {
		$user = user();
        $person = Person::firstWhere('user_id', $user->id ?? 0);
        $apply = $person ? $person->applied($type) : null;
        if ($step > 6) {
            abort(404);
        }
        if ($step == 5 && !$apply) {
            return back()->withError( __('ERROR') );
        }
		if ($step > 1) {
			if (!$user) {
				return back()->withError(__('YOU_NEED_TO_LOGIN'));
			}
            if ($user->type != 'user') {
                return back()->withError(__('CANT_SIGNUP_WITH_THIS_ACCOUNT', ['username' => $user->name, 'access' => $user->access]));
            }
		}
    	return view('signup', compact('type', 'step', 'person', 'apply'));
    }

	public function wizard($type, $step, Request $request)
	{
        $method = "step{$step}";
        if( method_exists($this, $method) ){
            return $this->$method($type, $step, $request);
        }else{
            abort(404);
        }
	}


    private function step1($type, $step, $request)
    {
        $request->validate([
            'username' => 'required|string|min:4',
            'password' => 'required|string|min:4',
        ]);

        $user = $found = User::where('name', $request->username)->first();
        if ($request->acc_type == 'register') {
            if ($found) {
                return back()->withError(__('USER_EXISTS'));
            }else {
                $user = User::create([
                    'name' => $request->username,
                    'password' => bcrypt($request->password)
                ]);
            }
            $message = __('ACC_CREATED_SUCCESSFULLY');
        }elseif ($request->acc_type == 'login') {
            if (!$found) {
                return back()->withError(__('USER_DOSNT_EXISTS'));
            }
            if ($user->type != 'user') {
                return back()->withError(__('CANT_SIGNUP_WITH_THIS_ACCOUNT'));
            }
            if (\Hash::check($request->password, $user->password)) {
                $message = __('LOGIN_SUCCESSFUL');
            }else {
                return back()->withMessage( __('WRONG_PASSWORD') );
            }
        }

        \Auth::login($user);
        return redirect()->route('signup', [$type, $step+1])->withMessage($message);
    }

    private function step2($type, $step, $request) {

        $person = Person::firstWhere('user_id', user('id'));
        $id = $person->id ?? 0;

        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'father_name' => 'required|string',
            'city' => Rule::in( defaults('city') ),
            'lifestyle' => Rule::in( defaults('lifestyle') ),
            'national_code' => ['required', new NationalCodeRule, 'unique:people,national_code,'.$id],
            'address' => 'required|string',
            'postal_code' => 'required|string|size:10',
            'mobile' => 'required|string|size:11|unique:people,mobile,'.$id,
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
        ]);

        $user = user();
        if ($user && $user->type == 'user') {
            $data['state'] = 'کرمانشاه';
            $data['user_id'] = $user->id;
            $data['english_birth_date'] = persian_to_carbon($data['birth_date']);
            if ($person) {
                $person->update($data);
                $person->make_fresh();
            }else {
                Person::create($data);
            }
            return redirect()->route('signup', [$type, $step+1])->withMessage(__('STORED_SUCCESSFULLY'));
        }else {
            return back()->withError(__('ERROR'));
        }

    }

    private function step3($type, $step, $request) {

        $person = Person::where('user_id', user('id'))->firstOrFail();
        if ($person->user_id == user('id')) {
            $data = $request->validate([
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
            ]);

            $person->make_fresh();
            $person->update([
                'file_domain' => $request->file_domain,
                'disability_type' => $request->file_domain == 'توانبخشی' ? $request->disability_type : null,
                'disability_level' => $request->file_domain == 'توانبخشی' ? $request->disability_level : null,
                'file_status' => $request->file_domain == 'اجتماعی' ? $request->file_status1 : $request->file_status2,
            ]);

            return redirect()->route('signup', [$type, $step+1])->withMessage(__('STORED_SUCCESSFULLY'));

        }else {
            return back()->withError(__('ERROR'));
        }
    }

    public function step4($type, $step, $request)
    {
        $person = Person::where('user_id', user('id'))->firstOrFail();
        $apply = $person->applied($type);

        $person_data = $request->validate([
            'payed' => [ 'nullable', Rule::requiredIf($request->are_you_payed == 'هستم') , 'integer'],
            'activity_section' => [ 'required', Rule::in( defaults('activity_section') ) ],
            'housing_status' => [ 'required', Rule::in( defaults('housing_status') ) ],
            'mortgage' => [ 'nullable', Rule::requiredIf($request->housing_status == 'استیجاری') , 'integer'],
            'rent' => [ 'nullable', Rule::requiredIf($request->housing_status == 'استیجاری') , 'integer'],
            'information' => 'nullable'
        ]);

        if ($type == 1) {
            $apply_data = $request->validate([
                'skill_type' => 'required',
                'interests' => 'required',
                'vehicle_type' => [ 'required', Rule::in( defaults('vehicle_type') ) ],
            ]);
        }
        if ($type == 2) {
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
        if ($type == 3) {
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

        if ($apply) {
            $apply_data['status'] = 1;
            $apply->update($apply_data);
        }else {
            if ($type == 1) $class = 'App\JobApply';
            if ($type == 2) $class = 'App\LoanApply';
            if ($type == 3) $class = 'App\InsuranceApply';
            $apply_data['uid'] = rand(100000000,999999999);
            $apply_data['person_id'] = $person->id;
            $class::create($apply_data);
            History::make($type, $person->id);
        }

        $person->update($person_data);

        return redirect()->route('signup', [$type, $step+1])->withMessage(__('APPLIED_SUCCESSFULLY'));
    }

    public function organ_form()
    {
        return view('signup.organ_signup_form');
    }

    public function organ_register(Request $request)
    {
        $data = $request->validate([
            'in_charge_first_name' => 'required|string',
            'in_charge_last_name' => 'required|string',
            'city' => Rule::in( defaults('city') ),
            'national_code' => ['required', new NationalCodeRule, 'unique:organs,national_code'],
            'address' => 'required|string',
            'postal_code' => 'required|string|size:10',
            'phone' => 'required|string|unique:organs,phone',
            'birth_date' => new PersianDateRule,
            'educations' => Rule::in( defaults('education') ),
            'workshop_location' => 'required|string',
            'workshop_title' => 'required|string',
            'service' => Rule::in( defaults() ),
            'shifts' => Rule::in( defaults() ),
            'shift_hours' => 'required|string',
            'meal' => Rule::in( defaults('meal') ),
            'payment_amount' => Rule::in( defaults('payment_amount') ),
            'offered_payment' => 'nullable|integer',
            'madadjus_insurance' => Rule::in( defaults() ),
            'full_insurance' => Rule::in( defaults() ),
            'username' => 'required|string|unique:users,name|min:4',
            'password' => 'required|string|min:4',
        ]);

        $user = User::create([
            'name' => $request->username,
            'password' => bcrypt($request->password),
            'type' => 'organ'
        ]);

        unset($data['username']);
        unset($data['password']);
        $data['uid'] = rand(100000000,999999999);
        $data['user_id'] = $user->id;
        $data['state'] = 'کرمانشاه';

        $organ = Organ::create($data);

        return redirect()->route('organ.finished', $organ->uid)->withMessage(__('APPLIED_SUCCESSFULLY'));
    }

    public function organ_finished($uid)
    {
        $organ = Organ::where('uid', $uid)->firstOrFail();
        return view('signup.organ_signup_finished', compact('uid'));
    }

    public function accept($type, $id)
    {
        $class = $type == 'organ' ? class_name($type) : class_name($type).'Apply';
        if (class_exists($class)) {
            $object = $class::findOrFail($id);
            if (!is('master')) {
                $city = $object->person->city ?? $object->city;
                $expert = Expert::where('user_id', user('id'))->firstOrFail();
                if ($city != $expert->city) {
                    return back()->withError(__('ERROR'));
                }
            }
            $object->status = 4;
            $object->rejection_reason = null;
            $object->save();
            return back()->withMessage( __('REQUEST_ACCEPTED') );
        }else {
            abort(404);
        }
    }

    public function reject($type, $id)
    {
        request()->validate(['rejection_reason'=>'required']);
        $class = $type == 'organ' ? class_name($type) : class_name($type).'Apply';
        if (class_exists($class)) {
            $object = $class::findOrFail($id);
            if (!is('master')) {
                $city = $object->person->city ?? $object->city;
                $expert = Expert::where('user_id', user('id'))->firstOrFail();
                if ($city != $expert->city) {
                    return back()->withError(__('ERROR'));
                }
            }
            $object->status = 3;
            $object->rejection_reason = request('rejection_reason');
            $object->save();
            return back()->withMessage( __('REQUEST_ACCEPTED') );
        }else {
            abort(404);
        }
    }

}
