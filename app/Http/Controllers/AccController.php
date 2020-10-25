<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use App\Branch;
use App\UserActivity;

class AccController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admins')->only(['index', 'admin_update']);
	}

	public function index()
	{
		$users = User::whereIn('type', ['user', 'organ']);
		if (user('type') == 'expert') {
			$user_ids = [];
			$users = $user->whereIn('id', $user_ids);
		}
		$users = $users->get();
		return view('dash.acc.index', compact('users'));
	}

	public function admin_update(User $user, Request $request)
	{
		if (!$request->newpass) {
			return back()->withError('این شخص کد ملی ندارد.');
		}
		$user->password = bcrypt($request->newpass);
		$user->save();
		return back()->withMessage(__('رمزعبور این شخص ریست شد.'));
	}

    public function edit()
    {
    	$user = auth()->user();
		return view('dash.acc.edit', compact('user'));
    }

	public function update(Request $request)
	{
		$user = auth()->user();

		$request->validate([
			"name" => "required|unique:users,name,$user->id",
			"current_password" => "required",
			"new_password" => "nullable|confirmed|string|min:4",
		]);

		$change = false;
		if (\Hash::check($request->current_password, $user->password)) {
			if ($user->name != $request->name) {
				$user->name = $request->name;
				$change =true;
			}
			if ($request->new_password) {
				$user->password = bcrypt($request->new_password);
				$change =true;
			}
			if ($change) {
				$user->save();
				return redirect('login')->with(\Auth::logout())->withMessage(__('UPDATE_ACC_MESSAGE'));
			}else {
				return back()->withError(__('NO_CHANGES_MADE'));
			}
		}else {
			return back()->withError(__('WRONG_CURRENT_PASSWORD'));
		}
	}

}
