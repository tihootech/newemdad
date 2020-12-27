<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Http\Controllers\Controller;

class UserApiController extends Controller
{

    public function index()
    {
        return response()->json(User::latest()->get(), 200);
    }

    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    public function store(Request $request)
    {
        $validator = self::getValidator();
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else {
            $data = $validator->valid();
            $data['password'] = bcrypt($data['password']);
            $user = User::create($data);
            return response()->json($user, 201);
        }
    }

    public function update(User $user, Request $request)
    {
        $validator = self::getValidator($user->id);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else {
            $data = $validator->valid();
            if (isset($data['password']) && $data['password']) {
                $data['password'] = bcrypt($data['password']);
            }
            $user->update($data);
            return response()->json($user, 200);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public static function getValidator($user_id = 0)
    {
        $isRequired = $user_id ? 'nullable' : 'required';

        $rules = [
            "type" => [$isRequired, Rule::in(['organ', 'user'])],
            "name" => "$isRequired|string|unique:users,name,$user_id",
            "password" => "$isRequired|string|min:6",
        ];

        return Validator::make(request()->all(), $rules);
    }

}
