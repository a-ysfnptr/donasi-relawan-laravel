<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    use HasFactory;

    protected $fillable = ['campaign_id','amount','recipient','disbursed_at','description','proof_file','created_by'];
    protected $casts = ['amount'=>'integer','disbursed_at'=>'date'];

    public function campaign() { return $this->belongsTo(Campaign::class); }
    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
}
