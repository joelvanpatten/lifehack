<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\DeliverySubscription;
use App\Models\DeliveryDate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DeliverySubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user (or create one if none exists)
        $user = User::first();
        
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Create a delivery subscription
        $subscription = DeliverySubscription::create([
            'user_id' => $user->id,
            'delivery_day' => 'Wednesday',
            'delivery_start_time' => '09:00:00',
            'delivery_end_time' => '14:00:00',
            'status' => 'active',
            'start_date' => Carbon::now()->subMonths(1),
            'delivery_notes' => 'Leave at front door if no answer',
        ]);

        // Generate delivery dates for the next 3 months
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->addMonths(3)->endOfMonth();
        
        $currentDate = $startDate->copy();
        
        while ($currentDate <= $endDate) {
            // Check if this date is a Wednesday
            if ($currentDate->isWednesday()) {
                $status = 'scheduled';
                
                // Mark past deliveries as delivered
                if ($currentDate->isPast()) {
                    $status = 'delivered';
                }
                
                DeliveryDate::create([
                    'delivery_subscription_id' => $subscription->id,
                    'delivery_date' => $currentDate->format('Y-m-d'),
                    'status' => $status,
                    'notes' => $status === 'delivered' ? 'Delivered successfully' : null,
                    'delivered_at' => $status === 'delivered' ? $currentDate->addHours(10) : null,
                ]);
            }
            
            $currentDate->addDay();
        }
    }
}
