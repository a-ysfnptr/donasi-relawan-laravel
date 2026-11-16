<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['title','category','description','target_amount','deadline','status','cover_image','created_by'];
    protected $casts = ['deadline' => 'date', 'target_amount' => 'integer'];

    public const CATEGORIES = ['bencana','pendidikan','kesehatan','sosial','lingkungan','lainnya'];
    public const STATUSES = ['draft','aktif','ditutup','selesai'];

    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
    public function donations() { return $this->hasMany(Donation::class); }
    public function volunteers() { return $this->hasMany(Volunteer::class); }
    public function disbursements() { return $this->hasMany(Disbursement::class); }

    public function verifiedTotal(): int { return (int) $this->donations()->where('status','terverifikasi')->sum('amount'); }
    public function disbursedTotal(): int { return (int) $this->disbursements()->sum('amount'); }
    public function remainingFunds(): int { return max(0, $this->verifiedTotal() - $this->disbursedTotal()); }
    public function progressPercent(): float {
        return $this->target_amount > 0 ? min(100, round($this->verifiedTotal() / $this->target_amount * 100, 1)) : 0;
    }
    public function isOpen(): bool {
        return $this->status === 'aktif' && (!$this->deadline || $this->deadline->endOfDay()->isFuture());
    }
    public function scopeActive($q) { return $q->where('status','aktif'); }
    public function scopeSearch($q, ?string $term) {
        // Parameterized LIKE — input diperlakukan sebagai data, bukan SQL (anti-SQLi).
        return $term ? $q->where(function ($w) use ($term) {
            $w->where('title','ilike','%'.$term.'%')->orWhere('description','ilike','%'.$term.'%');
        }) : $q;
    }
}
