<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobApply;
use App\LoanApply;
use App\InsuranceApply;
use App\Organ;
use App\Person;

class RahgiriController extends Controller
{
    public function rahgiri(Request $request)
    {
        $job = JobApply::whereUid($request->c)->first();
        $loan = LoanApply::whereUid($request->c)->first();
        $insurance = InsuranceApply::whereUid($request->c)->first();
        $organ = Organ::whereUid($request->c)->first();
        $person = Person::whereNationalCode($request->n)->first();
        $types = ['job', 'loan', 'insurance'];
        return view('dash.rahgiri.rahgiri', compact('request', 'job', 'loan', 'insurance', 'organ', 'person', 'types'));
    }
}
