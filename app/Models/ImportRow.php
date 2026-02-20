<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_id',
        'row_no',
        'row_json',
        'matched_product_id',
        'matched_vendor_product_id',
        'status',
    ];

    protected $casts = [
        'row_json' => 'array',
    ];

    /**
     * Get the import that owns the row.
     */
    public function import()
    {
        return $this->belongsTo(Import::class);
    }

    /**
     * Get the matched product.
     */
    public function matchedProduct()
    {
        return $this->belongsTo(Product::class, 'matched_product_id');
    }

    /**
     * Get the matched vendor product.
     */
    public function matchedVendorProduct()
    {
        return $this->belongsTo(VendorProduct::class, 'matched_vendor_product_id');
    }

    /**
     * Scope a query to only include confirmed rows.
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Scope a query to only include pending rows.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}