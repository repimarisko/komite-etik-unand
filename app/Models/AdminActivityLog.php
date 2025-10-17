<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AdminActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
        'description'
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array'
    ];

    /**
     * Get the user who performed the action.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the model that was affected.
     */
    public function model(): MorphTo
    {
        return $this->morphTo('model', 'model_type', 'model_id');
    }

    /**
     * Log an admin activity.
     */
    public static function logActivity(
        int $userId,
        string $action,
        string $modelType,
        ?int $modelId = null,
        ?array $oldValues = null,
        ?array $newValues = null,
        ?string $description = null,
        ?string $ipAddress = null,
        ?string $userAgent = null
    ): self {
        return self::create([
            'user_id' => $userId,
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'description' => $description,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent
        ]);
    }

    /**
     * Get formatted action description.
     */
    public function getFormattedActionAttribute(): string
    {
        $actions = [
            'create' => 'Membuat',
            'update' => 'Mengupdate',
            'delete' => 'Menghapus',
            'approve' => 'Menyetujui',
            'reject' => 'Menolak',
            'activate' => 'Mengaktifkan',
            'deactivate' => 'Menonaktifkan',
            'assign_role' => 'Memberikan Role',
            'remove_role' => 'Menghapus Role',
            'login' => 'Login',
            'logout' => 'Logout'
        ];

        return $actions[$this->action] ?? ucfirst($this->action);
    }

    /**
     * Get formatted model name.
     */
    public function getFormattedModelTypeAttribute(): string
    {
        $models = [
            'App\\Models\\User' => 'User',
            'App\\Models\\Role' => 'Role',
            'App\\Models\\Permission' => 'Permission',
            'App\\Models\\UserRegistration' => 'Registrasi User'
        ];

        return $models[$this->model_type] ?? class_basename($this->model_type);
    }

    /**
     * Scope for specific user activities.
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for specific action.
     */
    public function scopeForAction($query, string $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope for specific model type.
     */
    public function scopeForModelType($query, string $modelType)
    {
        return $query->where('model_type', $modelType);
    }

    /**
     * Scope for recent activities.
     */
    public function scopeRecent($query, int $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
}