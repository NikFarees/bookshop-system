<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'vendor_id',
        'academic_year',
        'grade_label',
        'version',
        'status',
        'published_at',
        'notes',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Get the school that owns the booklist.
     */
    public function school()
    {
        return $this->belongsTo(Organization::class, 'school_id');
    }

    /**
     * Get the vendor that owns the booklist.
     */
    public function vendor()
    {
        return $this->belongsTo(Organization::class, 'vendor_id');
    }

    /**
     * Get the sections for the booklist.
     */
    public function sections()
    {
        return $this->hasMany(BooklistSection::class)->orderBy('sort_order');
    }

    /**
     * Get all items through sections.
     */
    public function items()
    {
        return $this->hasManyThrough(BooklistItem::class, BooklistSection::class);
    }

    /**
     * Get the orders for the booklist.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Scope a query to only include published booklists.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope a query to only include draft booklists.
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope a query to filter by academic year.
     */
    public function scopeForAcademicYear($query, $year)
    {
        return $query->where('academic_year', $year);
    }
}