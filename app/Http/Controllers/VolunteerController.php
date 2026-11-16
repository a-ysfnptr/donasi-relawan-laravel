<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVolunteerRequest;
use App\Models\Campaign;
use App\Models\Volunteer;
use App\Services\AuditService;

class VolunteerController extends Controller
{
    public function index()
    {
        $volunteers = auth()->user()->volunteers()->with('campaign')->latest()->paginate(10);
        return view('volunteers.index', compact('volunteers'));
    }

    public function create(Campaign $campaign)
    {
        if (!$campaign->isOpen()) {
            return redirect()->route('campaigns.show', $campaign)->withErrors(['relawan' => 'Kampanye ini sudah ditutup / melewati tenggat.']);
        }
        return view('volunteers.create', compact('campaign'));
    }

    public function store(StoreVolunteerRequest $request)
    {
        $campaign = Campaign::findOrFail($request->campaign_id);
        if (!$campaign->isOpen()) {
            return back()->withErrors(['relawan' => 'Kampanye ini sudah ditutup / melewati tenggat.']);
        }
        // BR-04: satu pendaftaran per kampanye (juga ditegakkan UNIQUE di DB).
        $exists = Volunteer::where('campaign_id', $campaign->id)->where('user_id', auth()->id())
            ->whereIn('status', ['menunggu', 'diterima'])->exists();
        if ($exists) {
            return back()->withErrors(['relawan' => 'Anda sudah mendaftar sebagai relawan pada kampanye ini.']);
        }
        $volunteer = Volunteer::create([
            'campaign_id' => $campaign->id, 'user_id' => auth()->id(),
            'skill' => $request->skill, 'availability' => $request->availability,
            'motivation' => $request->motivation, 'status' => 'menunggu',
        ]);
        AuditService::log('volunteer.registered', 'volunteers', $volunteer->id, 'Pendaftaran relawan ke kampanye #'.$campaign->id);
        return redirect()->route('volunteers.index')->with('success', 'Pendaftaran relawan berhasil. Menunggu persetujuan admin.');
    }

    public function cancel(Volunteer $volunteer)
    {
        $this->authorize('cancel', $volunteer);
        $volunteer->update(['status' => 'dibatalkan']);
        AuditService::log('volunteer.cancelled', 'volunteers', $volunteer->id, 'Pendaftaran relawan dibatalkan');
        return redirect()->route('volunteers.index')->with('success', 'Pendaftaran relawan dibatalkan.');
    }
}
