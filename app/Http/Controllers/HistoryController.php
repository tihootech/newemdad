<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\History;
use App\Person;

class HistoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admins');
    }

    public function note()
    {
        $data = self::validation();
        $data['user_id'] = auth()->id();
        History::create($data);
        return back()->withMessage( __('SUCCESS') );
    }

    public function update(History $history, Request $request)
    {
        request()->validate([
            'description' => 'required',
        ]);
        if ($history->user_id == auth()->id()) {
            $history->description = $request->description;
            $history->save();
            return back()->withMessage( __('SUCCESS') );
        }else {
            abort(404);
        }
    }

    public static function validation()
    {
        return request()->validate([
            'description' => 'required',
            'person_id' => 'required|exists:people,id'
        ]);
    }
}
