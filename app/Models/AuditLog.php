<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['user_id','action','entity','entity_id','detail','ip_address','created_at'];
    protected $casts = ['created_at'=>'datetime'];

    public function user() { return $this->belongsTo(User::class); }

    public static function record(?User $user, string $action, string $entity, $entityId, string $detail = '', ?string $ip = null): void
    {
        static::create([
            'user_id' => $user?->id, 'action' => $action, 'entity' => $entity,
            'entity_id' => (string) $entityId, 'detail' => $detail,
            'ip_address' => $ip ?? request()->ip(), 'created_at' => now(),
        ]);
    }
}
