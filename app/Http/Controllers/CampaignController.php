<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $campaigns = Campaign::active()
            ->search($request->query('q'))
            ->when($request->query('category'), fn ($q, $c) => $q->where('category', $c))
            ->latest()->paginate(12)->withQueryString();
        return view('campaigns.index', compact('campaigns'));
    }

    public function show(Campaign $campaign)
    {
        if ($campaign->status !== 'aktif' && !auth()->user()?->isAdmin()) {
            abort(404);
        }
        $campaign->load(['donations' => fn ($q) => $q->where('status', 'terverifikasi')->latest()->take(10), 'disbursements' => fn ($q) => $q->latest()->take(10)]);
        return view('campaigns.show', compact('campaign'));
    }

    // Halaman transparansi publik (FR-SAL-03): tanpa data pribadi donatur.
    public function transparency(Campaign $campaign)
    {
        return view('campaigns.transparency', [
            'campaign' => $campaign,
            'donations' => $campaign->donations()->where('status', 'terverifikasi')->with('user')->latest()->paginate(15),
            'disbursements' => $campaign->disbursements()->latest()->paginate(15),
        ]);
    }
}
