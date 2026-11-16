<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationAdminController extends Controller
{
    public function index(Request $request)
    {
        $donations = Donation::with(['campaign', 'user'])
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->when($request->campaign_id, fn ($q, $c) => $q->where('campaign_id', $c))
            ->latest()->paginate(15)->withQueryString();
        return view('admin.donations.index', compact('donations'));
    }

    public function show(Donation $donation)
    {
        $donation->load(['campaign', 'user', 'verifier']);
        return view('admin.donations.show', compact('donation'));
    }

    public function verify(Donation $donation)
    {
        // Transaksi: verifikasi + audit log harus konsisten.
        DB::transaction(function () use ($donation) {
            $donation->update(['status' => 'terverifikasi', 'verified_by' => auth()->id(), 'verified_at' => now(), 'reject_reason' => null]);
            AuditService::log('donation.verified', 'donations', $donation->id, 'Donasi Rp'.number_format($donation->amount, 0, ',', '.').' terverifikasi');
        });
        return back()->with('success', 'Donasi terverifikasi dan masuk ke progres kampanye.');
    }

    public function reject(Request $request, Donation $donation)
    {
        $request->validate(['reject_reason' => ['required', 'string', 'max:500']]);
        DB::transaction(function () use ($request, $donation) {
            $donation->update(['status' => 'ditolak', 'verified_by' => auth()->id(), 'verified_at' => now(), 'reject_reason' => $request->reject_reason]);
            AuditService::log('donation.rejected', 'donations', $donation->id, 'Donasi ditolak: '.$request->reject_reason);
        });
        return back()->with('success', 'Donasi ditolak.');
    }
}
