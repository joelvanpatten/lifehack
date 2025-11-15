<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryDate extends Model
{
    protected $fillable = [
        'delivery_subscription_id',
        'delivery_date',
        'status',
        'notes',
        'delivered_at',
    ];

    protected $casts = [
        'delivery_date' => 'date',
        'delivered_at' => 'datetime',
    ];

    /**
     * Get the subscription that owns the delivery date.
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(DeliverySubscription::class, 'delivery_subscription_id');
    }
}
