<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no',
        'parent_id',
        'school_id',
        'vendor_id',
        'booklist_id',
        'academic_year',
        'grade_label',
        'fulfillment_method',
        'status',
        'subtotal',
        'shipping_fee',
        'total',
        'customer_name',
        'customer_phone',
        'customer_email',
        'remarks',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_fee' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * Get the parent that owns the order.
     */
    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }

    /**
     * Get the school that owns the order.
     */
    public function school()
    {
        return $this->belongsTo(Organization::class, 'school_id');
    }

    /**
     * Get the vendor that owns the order.
     */
    public function vendor()
    {
        return $this->belongsTo(Organization::class, 'vendor_id');
    }

    /**
     * Get the booklist that owns the order.
     */
    public function booklist()
    {
        return $this->belongsTo(Booklist::class);
    }

    /**
     * Get the items for the order.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the payments for the order.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the shipments for the order.
     */
    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }

    /**
     * Scope a query to only include paid orders.
     */
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    /**
     * Scope a query to only include completed orders.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope a query to filter by fulfillment method.
     */
    public function scopeByFulfillmentMethod($query, $method)
    {
        return $query->where('fulfillment_method', $method);
    }
}