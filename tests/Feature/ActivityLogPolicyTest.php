<?php

namespace L0MAX\ActivityLog\Tests\Feature;

use L0MAX\ActivityLog\ActivityLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityLogPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_view_any_activity_log()
    {
        // Create an admin user
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        // Create a regular user
        $user = User::factory()->create();

        // Create an activity log for the regular user
        $log = ActivityLog::factory()->create(['user_id' => $user->id]);

        // Assert that the admin can view the log
        $this->assertTrue($admin->can('view', $log));
    }

    /** @test */
    public function non_admin_can_only_view_their_own_logs()
    {
        // Create a non-admin user
        $user = User::factory()->create();

        // Create an activity log for the user
        $log = ActivityLog::factory()->create(['user_id' => $user->id]);

        // Assert that the user can view their own log
        $this->assertTrue($user->can('view', $log));

        // Create another activity log for a different user
        $otherUser = User::factory()->create();
        $otherLog = ActivityLog::factory()->create(['user_id' => $otherUser->id]);

        // Assert that the user cannot view another user's log
        $this->assertFalse($user->can('view', $otherLog));
    }
}
