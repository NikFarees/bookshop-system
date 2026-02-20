<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'user_id',
        'org_role',
        'status',
    ];

    /**
     * Get the organization that owns the organization user.
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the user that owns the organization user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include active organization users.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}