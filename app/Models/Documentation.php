<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Documentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document_type',
        'file_path',
        'document_type_id', // <-- CORRIGIDO AQUI
        'status',
        'rejection_reason',
    ];

    public function documentTypes(): HasMany
    {
        return $this->hasMany(DocumentType::class, 'association_id', 'association_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }
}