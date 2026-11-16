<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignRequest;
use App\Models\Campaign;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CampaignAdminController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::withCount(['donations', 'volunteers'])->latest()->paginate(10);
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create() { return view('admin.campaigns.create'); }

    public function store(StoreCampaignRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->storeAs('covers', Str::random(40).'.'.$request->file('cover_image')->extension(), 'public');
        }
        $data['created_by'] = auth()->id();
        $campaign = Campaign::create($data);
        AuditService::log('campaign.created', 'campaigns', $campaign->id, 'Kampanye dibuat: '.$campaign->title);
        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanye berhasil dibuat.');
    }

    public function edit(Campaign $campaign) { return view('admin.campaigns.edit', compact('campaign')); }

    public function update(StoreCampaignRequest $request, Campaign $campaign)
    {
        $data = $request->validated();
        if ($request->hasFile('cover_image')) {
            if ($campaign->cover_image) Storage::disk('public')->delete($campaign->cover_image);
            $data['cover_image'] = $request->file('cover_image')->storeAs('covers', Str::random(40).'.'.$request->file('cover_image')->extension(), 'public');
        }
        $campaign->update($data);
        AuditService::log('campaign.updated', 'campaigns', $campaign->id, 'Kampanye diubah: '.$campaign->title);
        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanye berhasil diubah.');
    }

    public function destroy(Campaign $campaign)
    {
        // BR-05: kampanye dengan donasi terverifikasi tidak boleh dihapus permanen.
        if ($campaign->donations()->where('status', 'terverifikasi')->exists()) {
            return back()->withErrors(['hapus' => 'Kampanye ini memiliki donasi terverifikasi dan tidak dapat dihapus. Tutup kampanye saja.']);
        }
        $campaign->delete();
        AuditService::log('campaign.deleted', 'campaigns', $campaign->id, 'Kampanye dihapus: '.$campaign->title);
        return redirect()->route('admin.campaigns.index')->with('success', 'Kampanye berhasil dihapus.');
    }
}
