<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Disbursement;
use App\Models\Donation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $campaigns = Campaign::active()
            ->search($request->query('q'))
            ->when($request->query('category'), fn ($q, $c) => $q->where('category', $c))
            ->latest()->paginate(9)->withQueryString();
        return view('home', [
            'campaigns' => $campaigns,
            'totalVerified' => Donation::where('status', 'terverifikasi')->sum('amount'),
            'totalDisbursed' => Disbursement::sum('amount'),
            'totalCampaigns' => Campaign::active()->count(),
        ]);
    }

    public function dashboard()
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard', [
            'myDonations' => $user->donations()->latest()->take(5)->get(),
            'myTotal' => $user->donations()->where('status', 'terverifikasi')->sum('amount'),
            'myCampaigns' => $user->donations()->distinct('campaign_id')->count('campaign_id'),
            'myVolunteers' => $user->volunteers()->with('campaign')->latest()->get(),
        ]);
    }
}
