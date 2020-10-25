<?php

namespace App\Http\Controllers;

use App\Solicit;
use App\Organ;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SolicitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('not_user');
        $this->middleware('organ')->only(['create', 'edit', 'store', 'update']);
    }

    public function index()
    {
        $solicits = Solicit::query();
        if (is('organ')) {
            $organ = Organ::where('user_id', user('id'))->firstOrFail();
            $solicits = $solicits->where('organ_id', $organ->id);
        }
        $solicits = $solicits->latest()->get();
        return view('dash.solicit.index', compact('solicits'));
    }

    public function create()
    {
        $solicit = new Solicit;
        return view('dash.solicit.form', compact('solicit'));
    }

    public function store(Request $request)
    {
        $data = self::validation();
        $organ = Organ::where('user_id', user('id'))->firstOrFail();
        if ($organ->status != 4) {
            return back()->withError('ACCOUNT_NOT_ACTIVATED');
        }
        $data['organ_id'] = $organ->id;
        Solicit::create($data);
        return redirect()->route('solicit.index')->withMessage('SOLICIT_CREATED');
    }

    public function edit(Solicit $solicit)
    {
        return view('dash.solicit.form', compact('solicit'));
    }

    public function update(Request $request, Solicit $solicit)
    {
        $data = self::validation();
        $solicit->update($data);
        return redirect()->route('solicit.index')->withMessage('SUCCESS');
    }

    public function destroy(Solicit $solicit)
    {
        $solicit->delete();
        return back()->withMessage( __('DELETED_SUCCESSFULLY') );
    }

    private function validation()
    {
        $data =  request()->validate([
            'age_from' => 'required|integer',
            'age_to' => 'required|integer',
            'field_of_study' => 'nullable|string',
            'academic_orientation' => 'nullable|string',
            'health_status' => Rule::in(defaults('health_status')),
            'educations.*' => ['nullable', Rule::in(defaults('education'))],
            'disability_type.*' => ['nullable', Rule::in(defaults('disability_type'))],
            'disability_level.*' => ['nullable', Rule::in(defaults('disability_level'))],
            'vehicle_type.*' => ['nullable', Rule::in(defaults('vehicle_type'))],
        ]);

        if (isset($data['educations'])) {
            $data['educations'] = implode('-', $data['educations']);
        }

        if (isset($data['disability_type'])) {
            $data['disability_type'] = implode('-', $data['disability_type']);
        }

        if (isset($data['disability_level'])) {
            $data['disability_level'] = implode('-', $data['disability_level']);
        }

        if (isset($data['vehicle_type'])) {
            $data['vehicle_type'] = implode('-', $data['vehicle_type']);
        }

        return $data;
    }
}
