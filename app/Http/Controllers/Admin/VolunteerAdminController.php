<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use App\Services\AuditService;
use Illuminate\Http\Request;

class VolunteerAdminController extends Controller
{
    public function index(Request $request)
    {
        $volunteers = Volunteer::with(['campaign', 'user'])
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->when($request->campaign_id, fn ($q, $c) => $q->where('campaign_id', $c))
            ->latest()->paginate(15)->withQueryString();
        return view('admin.volunteers.index', compact('volunteers'));
    }

    public function setStatus(Request $request, Volunteer $volunteer)
    {
        $request->validate(['status' => ['required', 'in:diterima,ditolak']]);
        $volunteer->update(['status' => $request->status]);
        AuditService::log('volunteer.status_changed', 'volunteers', $volunteer->id, 'Status relawan diubah menjadi '.$request->status);
        return back()->with('success', 'Status relawan diubah menjadi '.$request->status.'.');
    }
}
