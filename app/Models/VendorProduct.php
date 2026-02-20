<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'product_id',
        'sku',
        'default_price',
        'stock_qty',
        'min_stock_qty',
        'status',
    ];

    protected $casts = [
        'default_price' => 'decimal:2',
    ];

    /**
     * Get the vendor that owns the vendor product.
     */
    public function vendor()
    {
        return $this->belongsTo(Organization::class, 'vendor_id');
    }

    /**
     * Get the product that owns the vendor product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the booklist items for the vendor product.
     */
    public function booklistItems()
    {
        return $this->hasMany(BooklistItem::class);
    }

    /**
     * Get the order items for the vendor product.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the import rows that match this vendor product.
     */
    public function matchedImportRows()
    {
        return $this->hasMany(ImportRow::class, 'matched_vendor_product_id');
    }

    /**
     * Scope a query to only include active vendor products.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include low stock items.
     */
    public function scopeLowStock($query)
    {
        return $query->whereColumn('stock_qty', '<=', 'min_stock_qty')
            ->whereNotNull('min_stock_qty');
    }
}