<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Campaign;
use App\Models\Disbursement;
use App\Models\Donation;
use App\Models\User;
use App\Models\Volunteer;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalVerified' => Donation::where('status', 'terverifikasi')->sum('amount'),
            'totalDisbursed' => Disbursement::sum('amount'),
            'activeCampaigns' => Campaign::where('status', 'aktif')->count(),
            'acceptedVolunteers' => Volunteer::where('status', 'diterima')->count(),
            'pendingDonations' => Donation::where('status', 'menunggu')->with(['campaign', 'user'])->latest()->take(8)->get(),
            'pendingVolunteers' => Volunteer::where('status', 'menunggu')->with(['campaign', 'user'])->latest()->take(8)->get(),
            'recentLogs' => AuditLog::with('user')->latest()->take(10)->get(),
            'totalUsers' => User::count(),
        ]);
    }
}
