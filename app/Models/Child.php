<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'full_name',
        'school_id',
        'grade_label',
        'status',
    ];

    /**
     * Get the parent that owns the child.
     */
    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }

    /**
     * Get the school that the child attends.
     */
    public function school()
    {
        return $this->belongsTo(Organization::class, 'school_id');
    }

    /**
     * Scope a query to only include active children.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}