<?php

namespace App\Http\Controllers\Api;

use App\Person;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Rules\NationalCode;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{

    public function index()
    {
        return response()->json(Person::latest()->get(), 200);
    }

    public function show(Person $person)
    {
        return response()->json($person, 200);
    }

    public function store(Request $request)
    {
        $validator = self::getValidator();
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else {
            $data = $validator->valid();
            $data['uid'] = rand(1000000000, 9999999999);
            $person = Person::create($data);
            return response()->json($person, 201);
        }
    }

    public function update(Person $person, Request $request)
    {
        $validator = self::getValidator($person->id);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else {
            $data = $validator->valid();
            $person->update($data);
            return response()->json($person, 200);
        }
    }

    public function destroy(Person $person)
    {
        $person->delete();
        if ($user = $person->user) {
            $user->delete();
        }
        return response()->json(null, 204);
    }

    public static function getValidator($person_id = 0)
    {
        $isRequired = $person_id ? 'nullable' : 'required';

        $rules = [
            "user_id" => "$isRequired|integer",
            "type" => "$isRequired|integer",
            "first_name" => "$isRequired|string",
            "last_name" => "$isRequired|string",
            "national_code" => [$isRequired, new NationalCode, "unique:people,national_code,$person_id"],
            "madadju_code" => "$isRequired|string",
            "mobile" => "$isRequired|string|size:11|unique:people,mobile,$person_id",
            "address" => "nullable|string",
            "birth_date" => "nullable|string",
            "military_status" => "nullable|string",
            "gender" => "nullable|string",
            "education" => "nullable|string",
            "field_of_study" => "nullable|string",
        ];
        return Validator::make(request()->all(), $rules);
    }

}
