<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class UserRegistration extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'institution',
        'department',
        'reason_for_registration',
        'status',
        'verification_token',
        'email_verified_at',
        'approved_at',
        'approved_by',
        'admin_notes',
        'generated_username',
        'generated_password',
        'credentials_sent',
        'credentials_sent_at',
        'operator_verified_at',
        'operator_verified_by',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'approved_at' => 'datetime',
        'credentials_sent' => 'boolean',
        'credentials_sent_at' => 'datetime',
        'operator_verified_at' => 'datetime',
    ];

    protected $hidden = [
        'generated_password',
        'verification_token'
    ];

    /**
     * Get the admin who approved this registration.
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get operator who verified this registration.
     */
    public function operatorVerifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operator_verified_by');
    }

    /**
     * Generate verification token.
     */
    public static function generateVerificationToken(): string
    {
        return Str::random(64);
    }

    /**
     * Generate username based on email.
     */
    public function generateUsername(): string
    {
        $baseUsername = Str::before($this->email, '@');
        $baseUsername = Str::slug($baseUsername, '');
        
        $counter = 1;
        $username = $baseUsername;
        
        while (User::where('username', $username)->exists() || 
               UserRegistration::where('generated_username', $username)->where('id', '!=', $this->id)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }
        
        return $username;
    }

    /**
     * Generate random password.
     */
    public static function generatePassword(): string
    {
        return Str::random(12);
    }

    /**
     * Check if email is verified.
     */
    public function isEmailVerified(): bool
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Check if registration is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if registration is operator verified.
     */
    public function isOperatorVerified(): bool
    {
        return !is_null($this->operator_verified_at);
    }

    /**
     * Check if registration is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Check if registration is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Scope for pending registrations.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for operator verified registrations.
     */
    public function scopeOperatorVerified($query)
    {
        return $query->whereNotNull('operator_verified_at');
    }

    /**
     * Scope for approved registrations.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for email verified registrations.
     */
    public function scopeEmailVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }
}
