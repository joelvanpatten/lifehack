<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Pagination\LengthAwarePaginator;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 20);
        $page    = $request->query('page', 1);

        // Calculate zero-based start & end for ZREVRANGE
        $start = ($page - 1) * $perPage;
        $end   = $start + $perPage - 1;

        // Get total count for pagination metadata
        $total = Redis::zcard('notifications:log');

        // Fetch the payloads (newest first)
        $items = Redis::zrevrange('notifications:log', $start, $end);

        // Decode each JSON string into an array/object
        $data = array_map(fn($json) => json_decode($json, true), $items);

        // Build a LengthAwarePaginator so JSON:API–style metadata is included
        $paginator = new LengthAwarePaginator(
            $data,
            $total,
            $perPage,
            $page,
            [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]
        );

        return response()->json($paginator);
    }
}
