<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooklistSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'booklist_id',
        'name',
        'sort_order',
    ];

    /**
     * Get the booklist that owns the section.
     */
    public function booklist()
    {
        return $this->belongsTo(Booklist::class);
    }

    /**
     * Get the items for the section.
     */
    public function items()
    {
        return $this->hasMany(BooklistItem::class)->orderBy('sort_order');
    }
}