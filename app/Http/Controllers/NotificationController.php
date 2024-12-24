<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markNotificationAsRead(Request $request)
    {
        $notification = auth()->user()->notifications()->findOrFail($request->notification_id);
        $notification->markAsRead();
        return response()->json(['status' => 'success']);
    }
}
