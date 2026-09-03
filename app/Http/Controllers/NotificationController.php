<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()->latest()->get();
        $request->user()->unreadNotifications->markAsRead();
        return view('warga.notifications', compact('notifications'));
    }
}
