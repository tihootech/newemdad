<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organ;
use App\Expert;
use App\JobApply;
use App\LoanApply;
use App\Solicit;
use App\InsuranceApply;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('home');

    }
}
