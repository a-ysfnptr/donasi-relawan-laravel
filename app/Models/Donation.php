<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_id','user_id','amount','method','proof_file','is_anonymous','message','status','verified_by','verified_at','reject_reason'];
    protected $casts = ['amount'=>'integer','is_anonymous'=>'boolean','verified_at'=>'datetime'];
    public const STATUSES = ['menunggu','terverifikasi','ditolak','dibatalkan'];
    public const METHODS = ['BCA','BRI','Mandiri','BNI','DANA','GoPay','OVO','Lainnya'];

    public function campaign() { return $this->belongsTo(Campaign::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function verifier() { return $this->belongsTo(User::class, 'verified_by'); }
    public function displayName(): string { return $this->is_anonymous ? 'Hamba Allah' : $this->user->name; }
}
