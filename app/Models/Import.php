<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'user_id',
        'type',
        'file_name',
        'status',
        'notes',
    ];

    /**
     * Get the organization that owns the import.
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the user that owns the import.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the rows for the import.
     */
    public function rows()
    {
        return $this->hasMany(ImportRow::class);
    }

    /**
     * Scope a query to only include completed imports.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'imported');
    }

    /**
     * Scope a query to only include failed imports.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }
}