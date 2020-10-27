<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class AdController extends Controller
{

    public function index()
    {
        return response()->json(Ad::latest()->get(), 200);
    }

    public function show(Ad $ad)
    {
        return response()->json($ad, 200);
    }

    public function store(Request $request)
    {
        $validator = self::getValidator();
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else {
            $ad = Ad::create($validator->valid());
            return response()->json($ad, 201);
        }
    }

    public function update(Request $request, Ad $ad)
    {
        $validator = self::getValidator();
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }else {
            $ad->update($validator->valid());
            return response()->json($ad, 200);
        }
    }

    public function destroy(Ad $ad)
    {
        $ad->delete();
        return response()->json(null, 204);
    }

    public static function getValidator()
    {
        $rules = [
            'title' => 'required|string',
            'payment' => 'required|integer',
            'service' => 'nullable|boolean',
            'dorm' => 'nullable|boolean',
            'count' => 'required|integer',
            'gender' => ['required', Rule::in(['m', 'f', 'b'])],
            'shifts' => 'required|string',
            'address' => 'required|string',
            'info' => 'nullable|string',
        ];
        return Validator::make(request()->all(), $rules);
    }
}
