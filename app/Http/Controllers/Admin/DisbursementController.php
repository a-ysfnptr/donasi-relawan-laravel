<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDisbursementRequest;
use App\Models\Campaign;
use App\Models\Disbursement;
use App\Services\AuditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DisbursementController extends Controller
{
    public function index(Request $request)
    {
        $disbursements = Disbursement::with(['campaign', 'creator'])
            ->when($request->campaign_id, fn ($q, $c) => $q->where('campaign_id', $c))
            ->latest()->paginate(15)->withQueryString();
        $campaigns = Campaign::orderBy('title')->get();
        return view('admin.disbursements.index', compact('disbursements', 'campaigns'));
    }

    public function create()
    {
        $campaigns = Campaign::orderBy('title')->get();
        return view('admin.disbursements.create', compact('campaigns'));
    }

    public function store(StoreDisbursementRequest $request)
    {
        $campaign = Campaign::findOrFail($request->campaign_id);
        // BR-02: penyaluran tidak boleh melebihi sisa dana terverifikasi.
        if ($request->amount > $campaign->remainingFunds()) {
            return back()->withErrors(['amount' => 'Jumlah melebihi sisa dana kampanye (Rp'.number_format($campaign->remainingFunds(), 0, ',', '.').').'])->withInput();
        }
        $data = $request->validated();
        if ($request->hasFile('proof_file')) {
            $data['proof_file'] = $request->file('proof_file')->storeAs('proofs', Str::random(40).'.'.$request->file('proof_file')->extension(), 'public');
        }
        $data['created_by'] = auth()->id();
        $disbursement = DB::transaction(function () use ($data) {
            $d = Disbursement::create($data);
            AuditService::log('disbursement.created', 'disbursements', $d->id, 'Penyaluran Rp'.number_format($d->amount, 0, ',', '.').' untuk '.$d->recipient);
            return $d;
        });
        return redirect()->route('admin.disbursements.index')->with('success', 'Penyaluran dana berhasil dicatat.');
    }

    public function destroy(Disbursement $disbursement)
    {
        $disbursement->delete();
        AuditService::log('disbursement.deleted', 'disbursements', $disbursement->id, 'Catatan penyaluran dihapus: '.$disbursement->recipient);
        return back()->with('success', 'Catatan penyaluran dihapus.');
    }
}
