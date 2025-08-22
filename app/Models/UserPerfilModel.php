<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserPerfilModel extends Pivot
{
    use HasFactory;

    protected $table = 'user_perfis';

    protected $fillable = ['user_id', 'perfil_id', 'is_atual', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function perfil()
    {
        return $this->belongsTo(PerfilModel::class);
    }
}
