<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Raffle extends Model
{
    protected $fillable = [
        'association_id', 'title', 'description', 'image', 
        'price', 'total_tickets', 'created_tickets', 
        'status', 'draw_date'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'created_tickets' => 'boolean',
        'draw_date' => 'date',
    ];

    public function association(): BelongsTo
    {
        return $this->belongsTo(Association::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(RaffleTicket::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(RaffleSale::class);
    }

    public function availableTickets()
    {
        return $this->tickets()->where('status', 'available');
    }

    public function availableTicketsCount(): int
    {
        return $this->availableTickets()->count();
    }

    public function soldPercentage(): float
    {
        if ($this->total_tickets == 0) return 0;
        $sold = $this->total_tickets - $this->availableTicketsCount();
        return round(($sold / $this->total_tickets) * 100, 2);
    }
}