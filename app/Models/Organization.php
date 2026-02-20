<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'code',
        'status',
        'phone',
        'email',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postcode',
        'country',
    ];

    /**
     * Get the users associated with the organization.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'organization_users')
                    ->withPivot('org_role', 'status')
                    ->withTimestamps();
    }

    /**
     * Get the organization users pivot records.
     */
    public function organizationUsers()
    {
        return $this->hasMany(OrganizationUser::class);
    }

    /**
     * Get the children associated with this school.
     */
    public function children()
    {
        return $this->hasMany(Child::class, 'school_id');
    }

    /**
     * Get the vendor products if this is a vendor.
     */
    public function vendorProducts()
    {
        return $this->hasMany(VendorProduct::class, 'vendor_id');
    }

    /**
     * Get the schools this vendor is associated with.
     */
    public function schools()
    {
        return $this->belongsToMany(Organization::class, 'school_vendor', 'vendor_id', 'school_id')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    /**
     * Get the vendors this school is associated with.
     */
    public function vendors()
    {
        return $this->belongsToMany(Organization::class, 'school_vendor', 'school_id', 'vendor_id')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    /**
     * Get the booklists for this school.
     */
    public function schoolBooklists()
    {
        return $this->hasMany(Booklist::class, 'school_id');
    }

    /**
     * Get the booklists for this vendor.
     */
    public function vendorBooklists()
    {
        return $this->hasMany(Booklist::class, 'vendor_id');
    }

    /**
     * Get the orders for this school.
     */
    public function schoolOrders()
    {
        return $this->hasMany(Order::class, 'school_id');
    }

    /**
     * Get the orders for this vendor.
     */
    public function vendorOrders()
    {
        return $this->hasMany(Order::class, 'vendor_id');
    }

    /**
     * Get the imports for this organization.
     */
    public function imports()
    {
        return $this->hasMany(Import::class);
    }

    /**
     * Scope a query to only include schools.
     */
    public function scopeSchools($query)
    {
        return $query->where('type', 'school');
    }

    /**
     * Scope a query to only include vendors.
     */
    public function scopeVendors($query)
    {
        return $query->where('type', 'vendor');
    }

    /**
     * Scope a query to only include approved organizations.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}