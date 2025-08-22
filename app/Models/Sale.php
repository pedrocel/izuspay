<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str; // Importe a classe Str

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'association_id',
        'plan_id',
        'user_id',
        'total_price',
        'payment_method',
        'status',
        'transaction_hash', // Adicionado: Hash da transação da Goat Payments
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    // Indica que o Eloquent não deve usar auto-incremento
    public $incrementing = false;
    
    // Indica que a chave primária é uma string (UUID)
    protected $keyType = 'string';

    /**
     * O método 'boot' é executado na inicialização da model.
     * Usamos 'creating' para gerar um UUID antes de um novo registro ser salvo.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function association(): BelongsTo
    {
        return $this->belongsTo(Association::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function getStatusBadge(): string
    {
        return match($this->status) {
            'paid' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">Pago</span>',
            'awaiting_payment' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400">Pendente</span>',
            'cancelled' => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400">Cancelado</span>',
            default => '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-400">Indefinido</span>'
        };
    }
}