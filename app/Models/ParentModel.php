<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;

    protected $table = 'parents';

    protected $fillable = [
        'user_id',
        'phone',
        'default_address_line1',
        'default_address_line2',
        'default_city',
        'default_state',
        'default_postcode',
        'default_country',
    ];

    /**
     * Get the user that owns the parent.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the children for the parent.
     */
    public function children()
    {
        return $this->hasMany(Child::class, 'parent_id');
    }

    /**
     * Get the orders for the parent.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'parent_id');
    }
}