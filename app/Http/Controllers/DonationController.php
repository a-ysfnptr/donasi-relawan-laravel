<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonationRequest;
use App\Models\Campaign;
use App\Models\Donation;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function index()
    {
        $donations = auth()->user()->donations()->with('campaign')->latest()->paginate(10);
        return view('donations.index', compact('donations'));
    }

    public function create(Campaign $campaign)
    {
        if (!$campaign->isOpen()) {
            return redirect()->route('campaigns.show', $campaign)->withErrors(['donasi' => 'Kampanye ini sudah ditutup / melewati tenggat.']);
        }
        return view('donations.create', compact('campaign'));
    }

    public function store(StoreDonationRequest $request)
    {
        $campaign = Campaign::findOrFail($request->campaign_id);
        if (!$campaign->isOpen()) {
            return back()->withErrors(['donasi' => 'Kampanye ini sudah ditutup / melewati tenggat.']);
        }
        $donation = Donation::create([
            'campaign_id' => $campaign->id,
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'method' => $request->method,
            'message' => $request->message,
            'is_anonymous' => $request->boolean('is_anonymous'),
            'status' => 'menunggu',
        ]);
        AuditService::log('donation.created', 'donations', $donation->id, 'Donasi Rp'.number_format($donation->amount, 0, ',', '.').' ke kampanye #'.$campaign->id);
        return redirect()->route('donations.show', $donation)->with('success', 'Donasi dibuat. Silakan unggah bukti transfer agar admin dapat memverifikasi.');
    }

    public function show(Donation $donation)
    {
        $this->authorize('view', $donation); // IDOR: pemilik / admin saja
        return view('donations.show', compact('donation'));
    }

    public function uploadProof(Request $request, Donation $donation)
    {
        $this->authorize('update', $donation);
        $request->validate(['proof_file' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:2048']]);
        // Nama berkas acak — nama asli pengguna tidak pernah dipakai (FR-DON-02).
        $path = $request->file('proof_file')->storeAs('proofs', Str::random(40).'.'.$request->file('proof_file')->extension(), 'public');
        $donation->update(['proof_file' => $path]);
        AuditService::log('donation.proof_uploaded', 'donations', $donation->id, 'Bukti transfer diunggah');
        return back()->with('success', 'Bukti transfer berhasil diunggah.');
    }

    public function cancel(Donation $donation)
    {
        $this->authorize('cancel', $donation);
        $donation->update(['status' => 'dibatalkan']);
        AuditService::log('donation.cancelled', 'donations', $donation->id, 'Donasi dibatalkan oleh donatur');
        return redirect()->route('donations.index')->with('success', 'Donasi dibatalkan.');
    }
}
