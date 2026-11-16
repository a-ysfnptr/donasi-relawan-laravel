<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><title>Laporan Donasi</title>
<style>body{font-family:sans-serif;font-size:12px}table{width:100%;border-collapse:collapse}th,td{border:1px solid #ccc;padding:6px;text-align:left}th{background:#eee}</style>
</head><body>
<h2>Laporan Donasi Terverifikasi</h2>
<p>Dibuat: {{ $generatedAt }} — Total: Rp{{ number_format($total, 0, ',', '.') }}</p>
<table><thead><tr><th>Tanggal</th><th>Kampanye</th><th>Donatur</th><th>Nominal (Rp)</th><th>Metode</th></tr></thead>
<tbody>
@foreach($donations as $d)
<tr><td>{{ $d->created_at->format('d-m-Y') }}</td><td>{{ $d->campaign->title }}</td><td>{{ $d->displayName() }}</td><td>{{ number_format($d->amount, 0, ',', '.') }}</td><td>{{ $d->method }}</td></tr>
@endforeach
</tbody></table>
</body></html>
