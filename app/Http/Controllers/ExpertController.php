<?php

namespace App\Http\Controllers;

use App\Expert;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Rules\NationalCode as NationalCodeRule;

class ExpertController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('master');
    }

    public function index()
    {
        $experts = Expert::all();
        return view('dash.expert.index', compact('experts'));
    }

    public function create()
    {
        $expert = new Expert;
        return view('dash.expert.form', compact('expert'));
    }

    public function store(Request $request)
    {
        $data = self::validation();
        $user = User::create([
            'name' => $request->username,
            'password' => bcrypt($request->national_code),
            'type' => 'expert',
        ]);
        $data['user_id'] = $user->id;
        Expert::create($data);
        return redirect()->route('expert.index')->withMessage( __('SUCCESS') );
    }

    public function edit(Expert $expert)
    {
        return view('dash.expert.form', compact('expert'));
    }

    public function update(Request $request, Expert $expert)
    {
        $data = self::validation($expert);
        $expert->update($data);
        return redirect()->route('expert.index')->withMessage( __('SUCCESS') );
    }

    public function destroy(Expert $expert)
    {
        $expert->delete();
        User::where('id', $expert->user_id)->delete();
        return redirect()->route('expert.index')->withMessage( __('DELETED_SUCCESSFULLY') );
    }

    private static function validation($expert=null)
    {
        $user_id = $expert->user->id ?? 0;
        $id = $expert->id ?? 0;
        $data = request()->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string|unique:users,name,'.$user_id,
            'national_code' => ['required', new NationalCodeRule, 'unique:experts,national_code,'.$id],
            'city' => Rule::in( defaults('city') ),
        ]);
        unset($data['username']);
        return $data;
    }
}
