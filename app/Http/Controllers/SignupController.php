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
        if ($step > 3) {
            abort(404);
        }
		if ($step > 1) {
			if (!$user) {
				return back()->withError(__('YOU_NEED_TO_LOGIN'));
			}
            if ($user->type != 'user') {
                return back()->withError(__('CANT_SIGNUP_WITH_THIS_ACCOUNT', ['username' => $user->name, 'access' => $user->access]));
            }
		}
    	return view('signup', compact('type', 'step', 'person'));
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
            'national_code' => ['required', new NationalCodeRule, 'unique:people,national_code,'.$id],
            'mobile' => 'required|string|size:11|unique:people,mobile,'.$id,
            'madadju_code' => 'required|string|unique:people,madadju_code,'.$id,
            'address' => 'nullable|string',
            'birth_date' => ['nullable', new PersianDateRule],
            'military_status' => ['nullable', Rule::in( defaults('military_status') )],
            'gender' => ['nullable', Rule::in( defaults('gender') )],
            'education' => ['nullable', Rule::in( defaults('education') )],
            'field_of_study' => 'nullable',
        ]);

        $user = user();
        if ($user && $user->type == 'user') {
            $data['user_id'] = $user->id;
            $data['type'] = $type;
            $data['uid'] = rand(10000000, 99999999);
            $data['english_birth_date'] = $data['birth_date'] ? persian_to_carbon($data['birth_date']) : null;
            if ($person) {
                $person->update($data);
            }else {
                Person::create($data);
            }
            return redirect()->route('signup', [$type, $step+1])->withMessage(__('STORED_SUCCESSFULLY'));
        }else {
            return back()->withError(__('ERROR'));
        }

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
