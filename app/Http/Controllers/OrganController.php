<?php

namespace App\Http\Controllers;

use App\Organ;
use App\User;
use App\Expert;
use App\Exports\OrgansExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class OrganController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admins');
    }

    public function export(Request $request)
    {
        $filename = now();
        return Excel::download(new OrgansExport, "$filename.xlsx");
    }

    public function index(Request $request)
    {
        $organs = Organ::query();
        if (is('expert')) {
            $expert = Expert::where('user_id', user('id'))->firstOrFail();
            $organs = $organs->where('city', $expert->city);
        }
        if ( $request->operator ) {
            $organs = $organs->where(function ($q) use ($request) {
                $q->where('in_charge_first_name', 'like', "%$request->operator%")->orWhere('in_charge_last_name', 'like', "%$request->operator%");
            });
        }
        if ( $request->phone ) {
            $organs = $organs->where('phone', 'like', "%$request->phone%");
        }
        if ( $request->national_code ) {
            $organs = $organs->where('national_code', 'like', "%$request->national_code%");
        }
        if ( $request->city ) {
            $organs = $organs->where('city', $request->city);
        }
        if ( $request->workshop_location ) {
            $organs = $organs->where('workshop_location', $request->workshop_location);
        }
        if ( $request->workshop_name ) {
            $organs = $organs->where('workshop_name', 'like', "%$request->phone%");
        }
        if ( $request->service ) {
            $organs = $organs->where('service', $request->service);
        }
        if ( $request->shifts ) {
            $organs = $organs->where('shifts', $request->shifts);
        }
        // $ids = implode(',', $organs->pluck('id')->toArray());
        $organs = $organs->latest()->paginate(12);


        return view('dash.organ.index', compact('organs'));
    }

    public function destroy(Organ $organ)
    {
        if (!is('master')) {
            $expert = Expert::where('user_id', user('id'))->firstOrFail();
            if ($organ->city != $expert->city) {
                return back()->withError(__('ERROR'));
            }
        }
        $organ->delete();
        User::where('id', $organ->user_id)->delete();
        return redirect()->route('organ.index')->withMessage( __('DELETED_SUCCESSFULLY') );
    }
}
