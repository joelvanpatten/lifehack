<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliverySubscription extends Model
{
    protected $fillable = [
        'user_id',
        'delivery_day',
        'delivery_start_time',
        'delivery_end_time',
        'status',
        'start_date',
        'end_date',
        'delivery_notes',
    ];

    protected $casts = [
        'delivery_start_time' => 'datetime',
        'delivery_end_time' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the user that owns the subscription.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the delivery dates for this subscription.
     */
    public function deliveryDates(): HasMany
    {
        return $this->hasMany(DeliveryDate::class);
    }
}
