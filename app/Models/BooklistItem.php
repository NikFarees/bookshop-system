<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooklistItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'booklist_section_id',
        'product_id',
        'vendor_product_id',
        'display_name',
        'qty_required',
        'is_optional',
        'price_override',
        'sort_order',
    ];

    protected $casts = [
        'is_optional' => 'boolean',
        'price_override' => 'decimal:2',
    ];

    /**
     * Get the section that owns the item.
     */
    public function section()
    {
        return $this->belongsTo(BooklistSection::class, 'booklist_section_id');
    }

    /**
     * Get the product that owns the item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the vendor product that owns the item.
     */
    public function vendorProduct()
    {
        return $this->belongsTo(VendorProduct::class);
    }

    /**
     * Get the booklist through the section.
     */
    public function booklist()
    {
        return $this->section()->first()->booklist();
    }

    /**
     * Scope a query to only include required items.
     */
    public function scopeRequired($query)
    {
        return $query->where('is_optional', false);
    }

    /**
     * Scope a query to only include optional items.
     */
    public function scopeOptional($query)
    {
        return $query->where('is_optional', true);
    }

    /**
     * Get the effective price (override price or vendor product price).
     */
    public function getEffectivePriceAttribute()
    {
        return $this->price_override ?? $this->vendorProduct?->default_price;
    }
}