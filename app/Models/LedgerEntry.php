<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'association_id',
        'related_type',
        'related_id',
        'type',
        'description',
        'amount',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function association()
    {
        return $this->belongsTo(Association::class);
    }

    // Relacionamento polimórfico para buscar o objeto relacionado (Venda, Saque, etc.)
    public function related()
    {
        return $this->morphTo();
    }
}
