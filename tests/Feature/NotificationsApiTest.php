<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Redis;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class NotificationsApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        if (app()->environment('production')) {
            throw new \Exception("Do not run tests in production!");
        }
        if (app()->environment('testing')) {
            Redis::flushAll(); // Clears out Redis so you have a clean slate
        }
    }

    #[Test]
    public function authenticated_user_sees_notifications_seeded_to_redis()
    {
        // Create a user
        $user = User::factory()->create();

        // Seed 3 notifications via your artisan command
        $this->artisan('redis:seed-notifications 3')->assertExitCode(0);

        // Act: authenticate and fetch
        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/notifications');

        // Assert: HTTP 200, exactly 3 items, correct structure
        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'current_page',
                'data' => [
                    '*' => [ // each item in data should have this structure
                        'id',
                        'short_id',
                        'subject',
                        'sent_at',
                    ],
                ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links' => [
                    '*' => [
                        'url',
                        'label',
                        'active',
                    ],
                ],
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total',
            ]);

    }
}
