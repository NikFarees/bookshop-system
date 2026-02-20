<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    public $timestamps = false; // We only have created_at

    protected $fillable = [
        'actor_user_id',
        'action',
        'entity_type',
        'entity_id',
        'before_json',
        'after_json',
        'created_at',
    ];

    protected $casts = [
        'before_json' => 'array',
        'after_json' => 'array',
        'created_at' => 'datetime',
    ];

    /**
     * Get the user that performed the action.
     */
    public function actorUser()
    {
        return $this->belongsTo(User::class, 'actor_user_id');
    }

    /**
     * Get the entity that was audited.
     */
    public function entity()
    {
        $entityClass = 'App\\Models\\' . $this->entity_type;
        if (class_exists($entityClass)) {
            return $entityClass::find($this->entity_id);
        }
        return null;
    }

    /**
     * Scope a query to filter by entity type.
     */
    public function scopeForEntity($query, $entityType)
    {
        return $query->where('entity_type', $entityType);
    }

    /**
     * Scope a query to filter by action.
     */
    public function scopeForAction($query, $action)
    {
        return $query->where('action', $action);
    }
}