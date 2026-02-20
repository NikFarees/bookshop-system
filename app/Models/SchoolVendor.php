<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolVendor extends Model
{
    use HasFactory;

    protected $table = 'school_vendor';

    protected $fillable = [
        'school_id',
        'vendor_id',
        'status',
    ];

    /**
     * Get the school that owns the school vendor.
     */
    public function school()
    {
        return $this->belongsTo(Organization::class, 'school_id');
    }

    /**
     * Get the vendor that owns the school vendor.
     */
    public function vendor()
    {
        return $this->belongsTo(Organization::class, 'vendor_id');
    }

    /**
     * Scope a query to only include active school vendor relationships.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}