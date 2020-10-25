<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['publics']);
        $this->middleware('master')->except(['publics', 'index']);
    }

    public function publics()
    {
        $nots = Notification::whereContact('public')->latest()->paginate(25);
        return view('nots', compact('nots'));
    }

    public function index()
    {
        $notifications = Notification::query();
        if (!is('master')) {
            $user = auth()->user();
            $owner = $user->owner;
            $notifications = $notifications->where('contact', user('type'))->where(function ($query) {
                $query->where('city', $owner->city)->orWhereNull('city');
            });
        }
        $notifications = $notifications->latest()->get();
        return view('dash.notification.index', compact('notifications'));
    }

    public function create()
    {
        $notification = new Notification;
        return view('dash.notification.form', compact('notification'));
    }

    public function store(Request $request)
    {
        $data = self::validation();
        Notification::create($data);
        return redirect()->route('notification.index')->withMessage( __('NEW_NOTIFICATION') );
    }

    public function edit(Notification $notification)
    {
        return view('dash.notification.form', compact('notification'));
    }

    public function update(Request $request, Notification $notification)
    {
        $data = self::validation();
        $notification->update($data);
        return redirect()->route('notification.index')->withMessage( __('SUCCESS') );
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('notification.index')->withMessage( __('DELETED_SUCCESSFULLY') );
    }

    private function validation()
    {
        return request()->validate([
            'subject' => 'required|string',
            'contact' => 'required|string',
            'city' => 'nullable|string',
            'body' => 'required|string',
        ]);
    }
}
