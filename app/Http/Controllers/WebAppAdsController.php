<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class WebAppAdsController extends Controller
{

    public function __construct($value='')
    {
        $this->middleware('admins_or_organ');
        $this->middleware('admins')->only('changeAccepted');
    }

    public function index()
    {
        return view('dash.ads.index', ['ads' => Ad::latest()->get()]);
    }

    public function create()
    {
        return view('dash.ads.form', ['ad' => new Ad]);
    }

    public function edit(Ad $ad)
    {
        return view('dash.ads.form', ['ad' => $ad]);
    }

    public function store(Request $request)
    {
        $data = self::validation();
        if ($request->image) {
            $data['image'] = upload($request->image);
        }
        if (is('admin')) {
            $data['accepted'] = true;
        }
        $ad = Ad::create($data);
        return redirect()->route('ad.index')->withMessage(  __('SUCCESS') );
    }

    public function update(Request $request, Ad $ad)
    {
        $data = self::validation();
        if ($request->image) {
            $data['image'] = upload($request->image, $ad->image);
        }
        $ad->update($data);
        return redirect()->route('ad.index')->withMessage(  __('SUCCESS') );
    }

    public function destroy(Ad $ad)
    {
        $ad->delete();
        delete_file($ad->image);
        return redirect()->route('ad.index')->withMessage(  __('SUCCESS') );
    }

    public static function validation()
    {
        return request()->validate([
            'title' => 'required|string',
            'payment' => 'required|integer',
            'service' => 'nullable|boolean',
            'dorm' => 'nullable|boolean',
            'count' => 'required|integer',
            'gender' => ['required', Rule::in(['m', 'f', 'b'])],
            'job_type' => ['required', Rule::in(['f', 'p'])],
            'shifts' => 'required|string',
            'address' => 'required|string',
            'info' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
    }

    public function changeAccepted(Ad $ad)
    {
        $ad->accepted = !$ad->accepted;
        $ad->save();
        return redirect()->route('ad.index')->withMessage(  __('SUCCESS') );
    }
}
