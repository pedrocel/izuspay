<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserOrganizationModel extends Pivot
{
    use HasFactory;

    protected $table = 'user_organizations';

    protected $fillable = ['user_id', 'organization_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(OrganizationModel::class);
    }
}
