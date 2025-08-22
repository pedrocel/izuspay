<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'association_id',
        'name',
        'is_required',
        'is_active',
    ];
    
    protected $casts = [
        'is_required' => 'boolean',
        'is_active' => 'boolean',
    ];
    
    public function association()
    {
        return $this->belongsTo(Association::class);
    }

    public function documentations()
    {
        return $this->hasMany(Documentation::class);
    }
}