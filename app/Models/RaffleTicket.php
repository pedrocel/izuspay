<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RaffleTicket extends Model
{
    protected $fillable = ['raffle_id', 'number', 'status', 'raffle_sale_id'];

    public function raffle(): BelongsTo
    {
        return $this->belongsTo(Raffle::class);
    }

    public function raffleSale(): BelongsTo
    {
        return $this->belongsTo(RaffleSale::class);
    }

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(RaffleSale::class, 'raffle_sale_tickets');
    }
}