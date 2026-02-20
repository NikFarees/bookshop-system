<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'type',
        'brand',
        'uom',
        'status',
    ];

    /**
     * Get the vendor products for the product.
     */
    public function vendorProducts()
    {
        return $this->hasMany(VendorProduct::class);
    }

    /**
     * Get the booklist items for the product.
     */
    public function booklistItems()
    {
        return $this->hasMany(BooklistItem::class);
    }

    /**
     * Get the order items for the product.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the import rows that match this product.
     */
    public function matchedImportRows()
    {
        return $this->hasMany(ImportRow::class, 'matched_product_id');
    }

    /**
     * Scope a query to only include active products.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include books.
     */
    public function scopeBooks($query)
    {
        return $query->where('type', 'book');
    }

    /**
     * Scope a query to only include stationery.
     */
    public function scopeStationery($query)
    {
        return $query->where('type', 'stationery');
    }
}