<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class RaffleSale extends Model
{
    protected $fillable = [
        'raffle_id', 'user_id', 'buyer_name', 'buyer_email', 
        'buyer_phone', 'quantity', 'total_price', 'payment_status',
        'payment_method', 'transaction_hash', 'fee_total', 'net_amount'
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'fee_total' => 'decimal:2',
        'net_amount' => 'decimal:2',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function raffle(): BelongsTo
    {
        return $this->belongsTo(Raffle::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tickets(): BelongsToMany
    {
        return $this->belongsToMany(RaffleTicket::class, 'raffle_sale_tickets');
    }

    public function getStatusBadge(): string
    {
        return match($this->payment_status) {
            'paid' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Pago</span>',
            'pending' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pendente</span>',
            'failed' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Falhou</span>',
            'refunded' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Reembolsado</span>',
            default => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Indefinido</span>'
        };
    }
}