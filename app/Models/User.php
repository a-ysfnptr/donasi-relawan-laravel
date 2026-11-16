<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'phone', 'is_active'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed', 'is_active' => 'boolean'];

    public const ROLE_ADMIN = 'admin';
    public const ROLE_USER = 'user';

    public function isAdmin(): bool { return $this->role === self::ROLE_ADMIN; }
    public function donations() { return $this->hasMany(Donation::class); }
    public function volunteers() { return $this->hasMany(Volunteer::class); }
    public function campaigns() { return $this->hasMany(Campaign::class, 'created_by'); }
    public function auditLogs() { return $this->hasMany(AuditLog::class); }
}
