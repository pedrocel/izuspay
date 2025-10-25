<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Raffle extends Model
{
    protected $fillable = [
        'association_id', 'hash_id', 'title', 'description', 'image', 
        'price', 'total_tickets', 'created_tickets', 
        'status', 'draw_date', 'winner_sale_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'created_tickets' => 'boolean',
        'draw_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($raffle) {
            if (empty($raffle->hash_id)) {
                $raffle->hash_id = Str::random(10);
            }
        });
    }

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

    public function winnerSale(): BelongsTo
    {
        return $this->belongsTo(RaffleSale::class, 'winner_sale_id');
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
