<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Disbursement;
use App\Models\Donation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->query('month'); // format YYYY-MM
        $campaignId = $request->query('campaign_id');

        $donations = Donation::where('status', 'terverifikasi')
            ->when($campaignId, fn ($q) => $q->where('campaign_id', $campaignId))
            ->when($month, function ($q) use ($month) { [$y, $m] = explode('-', $month); $q->whereYear('created_at', $y)->whereMonth('created_at', $m); });

        $perCampaign = (clone $donations)->select('campaign_id', DB::raw('COUNT(*) as jumlah'), DB::raw('SUM(amount) as total'))
            ->groupBy('campaign_id')->with('campaign')->get();
        // Agregasi per bulan/kategori dihitung di PHP (bukan to_char SQL) agar
        // jalan di Neon PostgreSQL maupun SQLite lokal.
        $verified = Donation::where('status', 'terverifikasi')->with('campaign')->get();
        $perMonth = $verified->groupBy(fn ($d) => $d->created_at->format('Y-m'))
            ->map(fn ($g, $bulan) => (object) ['bulan' => $bulan, 'jumlah' => $g->count(), 'total' => $g->sum('amount')])
            ->sortKeys()->values();
        $perCategory = $verified->groupBy(fn ($d) => $d->campaign->category)
            ->map(fn ($g, $cat) => (object) ['category' => $cat, 'jumlah' => $g->count(), 'total' => $g->sum('amount')])
            ->values();

        return view('admin.reports.index', [
            'perCampaign' => $perCampaign,
            'perMonth' => $perMonth,
            'perCategory' => $perCategory,
            'totalVerified' => $donations->sum('amount'),
            'totalDisbursed' => Disbursement::when($campaignId, fn ($q) => $q->where('campaign_id', $campaignId))->sum('amount'),
            'campaigns' => Campaign::orderBy('title')->get(),
            'month' => $month, 'campaignId' => $campaignId,
        ]);
    }

    public function exportCsv(Request $request)
    {
        $rows = Donation::where('status', 'terverifikasi')
            ->with(['campaign', 'user'])
            ->when($request->query('campaign_id'), fn ($q, $c) => $q->where('campaign_id', $c))
            ->when($request->query('month'), function ($q, $m) { [$y, $mo] = explode('-', $m); $q->whereYear('created_at', $y)->whereMonth('created_at', $mo); })
            ->orderBy('created_at')->get();

        $filename = 'laporan-donasi-'.now()->format('Y-m-d').'.csv';
        $headers = ['Content-Type' => 'text/csv; charset=UTF-8', 'Content-Disposition' => "attachment; filename=\"$filename\""];
        return response()->stream(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // BOM agar Excel membaca UTF-8
            fputcsv($out, ['Tanggal', 'Kampanye', 'Donatur', 'Nominal (Rp)', 'Metode', 'Status']);
            foreach ($rows as $r) {
                fputcsv($out, [$r->created_at->format('Y-m-d H:i'), $r->campaign->title, $r->displayName(), $r->amount, $r->method, $r->status]);
            }
            fclose($out);
        }, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $donations = Donation::where('status', 'terverifikasi')->with(['campaign', 'user'])
            ->when($request->query('campaign_id'), fn ($q, $c) => $q->where('campaign_id', $c))
            ->orderBy('created_at')->get();
        $pdf = Pdf::loadView('admin.reports.pdf', [
            'donations' => $donations,
            'total' => $donations->sum('amount'),
            'generatedAt' => now()->format('d-m-Y H:i'),
        ]);
        return $pdf->download('laporan-donasi-'.now()->format('Y-m-d').'.pdf');
    }
}
