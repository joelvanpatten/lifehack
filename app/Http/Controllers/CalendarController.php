<?php

namespace App\Http\Controllers;

use App\Models\DeliverySubscription;
use App\Models\DeliveryDate;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CalendarController extends Controller
{
    /**
     * Get the user's delivery subscription and calendar data.
     */
    public function index(): JsonResponse
    {
        $user = Auth::user();
        $subscription = $user->deliverySubscription;

        if (!$subscription) {
            return response()->json([
                'subscription' => null,
                'delivery_dates' => [],
                'message' => 'No active subscription found'
            ]);
        }

        // Get delivery dates for the next 3 months
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->addMonths(3)->endOfMonth();

        $deliveryDates = $subscription->deliveryDates()
            ->whereBetween('delivery_date', [$startDate, $endDate])
            ->orderBy('delivery_date')
            ->get();

        return response()->json([
            'subscription' => $subscription,
            'delivery_dates' => $deliveryDates,
        ]);
    }

    /**
     * Skip a specific delivery date.
     */
    public function skipDelivery(Request $request): JsonResponse
    {
        $request->validate([
            'delivery_date' => 'required|date',
        ]);

        $user = Auth::user();
        $subscription = $user->deliverySubscription;

        if (!$subscription) {
            return response()->json(['message' => 'No active subscription found'], 404);
        }

        $deliveryDate = $subscription->deliveryDates()
            ->where('delivery_date', $request->delivery_date)
            ->first();

        if (!$deliveryDate) {
            // Create a new delivery date record for this skipped date
            $deliveryDate = $subscription->deliveryDates()->create([
                'delivery_date' => $request->delivery_date,
                'status' => 'skipped',
                'notes' => 'Skipped by customer',
            ]);
        } else {
            $deliveryDate->update([
                'status' => 'skipped',
                'notes' => 'Skipped by customer',
            ]);
        }

        return response()->json([
            'message' => 'Delivery skipped successfully',
            'delivery_date' => $deliveryDate,
        ]);
    }

    /**
     * Cancel the delivery service.
     */
    public function cancelService(Request $request): JsonResponse
    {
        $user = Auth::user();
        $subscription = $user->deliverySubscription;

        if (!$subscription) {
            return response()->json(['message' => 'No active subscription found'], 404);
        }

        $subscription->update([
            'status' => 'cancelled',
            'end_date' => Carbon::now(),
        ]);

        return response()->json([
            'message' => 'Service cancelled successfully',
            'subscription' => $subscription,
        ]);
    }

    /**
     * Get delivery dates for a specific month.
     */
    public function getMonthData(Request $request): JsonResponse
    {
        $request->validate([
            'year' => 'required|integer|min:2020|max:2030',
            'month' => 'required|integer|min:1|max:12',
        ]);

        $user = Auth::user();
        $subscription = $user->deliverySubscription;

        if (!$subscription) {
            return response()->json(['message' => 'No active subscription found'], 404);
        }

        $startDate = Carbon::create($request->year, $request->month, 1)->startOfMonth();
        $endDate = Carbon::create($request->year, $request->month, 1)->endOfMonth();

        $deliveryDates = $subscription->deliveryDates()
            ->whereBetween('delivery_date', [$startDate, $endDate])
            ->orderBy('delivery_date')
            ->get();

        return response()->json([
            'delivery_dates' => $deliveryDates,
        ]);
    }
}
