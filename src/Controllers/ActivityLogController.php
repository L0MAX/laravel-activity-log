<?php

namespace L0MAX\ActivityLog\Controllers;

use L0MAX\ActivityLog\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController
{
    public function index(Request $request)
    {
        $logs = ActivityLog::query();

        if ($request->filled('user_id')) {
            $logs->where('user_id', $request->input('user_id'));
        }

        if ($request->filled('date')) {
            $logs->whereDate('created_at', $request->input('date'));
        }

        $logs = $logs->latest()->paginate(20);
        return view('activity-log::index', compact('logs'));
    }
}
