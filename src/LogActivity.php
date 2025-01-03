<?php

namespace L0MAX\ActivityLog;

use Illuminate\Support\Facades\Auth;

class LogActivity
{
    public static function log($description, $subject = null, array $properties = [])
    {
        $activity = new ActivityLog([
            'user_id' => Auth::id(),
            'description' => $description,
            'subject_id' => $subject ? $subject->id : null,
            'subject_type' => $subject ? get_class($subject) : null,
            'properties' => config('activitylog.store_properties') ? json_encode($properties) : null,
        ]);

        $activity->save();
    }
}
