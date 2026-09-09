<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()->latest()->get();
        $request->user()->unreadNotifications->markAsRead();

        return view('admin.notifications', compact('notifications'));
    }
}
