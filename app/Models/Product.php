<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'is_active',
        'association_id',
        'tipo_produto',
        'entrega_produto',
        'categoria_produto',
        'url_venda',
        'nome_sac',
        'email_sac',
        'image'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'tipo_produto' => 'integer',
        'entrega_produto' => 'integer',
        'categoria_produto' => 'integer',
    ];

    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class, 'plan_product');
    }

     // Relacionamento com a associação
    public function association(): BelongsTo
    {
        return $this->belongsTo(Association::class);
    }
}