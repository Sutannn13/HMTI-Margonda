<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 60px 50px; }
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; line-height: 1.5; }
        .header { text-align: center; border-bottom: 3px double #1a3a6b; padding-bottom: 15px; margin-bottom: 25px; }
        .header h1 { font-size: 18px; color: #1a3a6b; margin: 0; }
        .header h2 { font-size: 14px; color: #333; margin: 5px 0 0; font-weight: normal; }
        .header .period { font-size: 12px; color: #666; margin-top: 3px; }
        .badge { background: #1a3a6b; color: #f5c518; padding: 2px 10px; font-size: 10px; border-radius: 3px; letter-spacing: 1px; display: inline-block; margin-bottom: 8px; }
        .section { margin-bottom: 20px; }
        .section-title { font-size: 14px; font-weight: bold; color: #1a3a6b; border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-bottom: 10px; }
        .stat-grid { width: 100%; }
        .stat-grid td { padding: 8px 12px; text-align: center; }
        .stat-box { background: #f7f9fc; border: 1px solid #e5e7eb; border-radius: 4px; padding: 10px; }
        .stat-number { font-size: 24px; font-weight: bold; color: #1a3a6b; }
        .stat-label { font-size: 10px; color: #666; text-transform: uppercase; }
        table.data { width: 100%; border-collapse: collapse; font-size: 11px; }
        table.data th { background: #1a3a6b; color: #fff; padding: 6px 8px; text-align: left; font-size: 10px; text-transform: uppercase; }
        table.data td { padding: 5px 8px; border-bottom: 1px solid #eee; }
        table.data tr:nth-child(even) { background: #f9fafb; }
        .footer { margin-top: 40px; text-align: center; font-size: 10px; color: #888; border-top: 1px solid #ddd; padding-top: 10px; }
        .signature-area { margin-top: 50px; }
        .signature-area table { width: 70%; margin: 0 auto; }
        .signature-area td { text-align: center; vertical-align: bottom; width: 50%; }
        .sign-line { border-top: 1px solid #333; margin-top: 60px; padding-top: 4px; font-size: 11px; font-weight: bold; }
        .sign-sub { font-size: 9px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <div class="badge">HMTI UBSI MARGONDA</div>
        <h1>Laporan Bulanan</h1>
        <h2>Himpunan Mahasiswa Teknologi Informasi</h2>
        <p class="period">Periode: {{ $period }}</p>
    </div>

    {{-- Stats Overview --}}
    <div class="section">
        <div class="section-title">Ringkasan</div>
        <table class="stat-grid">
            <tr>
                <td width="25%">
                    <div class="stat-box">
                        <div class="stat-number">{{ $stats['total_members'] }}</div>
                        <div class="stat-label">Total Anggota</div>
                    </div>
                </td>
                <td width="25%">
                    <div class="stat-box">
                        <div class="stat-number">{{ $stats['new_members'] }}</div>
                        <div class="stat-label">Anggota Baru</div>
                    </div>
                </td>
                <td width="25%">
                    <div class="stat-box">
                        <div class="stat-number">{{ $stats['events_held'] }}</div>
                        <div class="stat-label">Kegiatan</div>
                    </div>
                </td>
                <td width="25%">
                    <div class="stat-box">
                        <div class="stat-number">{{ $stats['announcements'] }}</div>
                        <div class="stat-label">Pengumuman</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    {{-- Events --}}
    @if($events->count() > 0)
    <div class="section">
        <div class="section-title">Kegiatan Bulan Ini</div>
        <table class="data">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kegiatan</th>
                    <th>Tipe</th>
                    <th>Tanggal</th>
                    <th>Peserta</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $idx => $event)
                <tr>
                    <td>{{ $idx + 1 }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ ucfirst($event->type) }}</td>
                    <td>{{ $event->start_date->format('d/m/Y') }}</td>
                    <td>{{ $event->registrations_count ?? 0 }}</td>
                    <td>{{ ucfirst($event->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    {{-- New Members --}}
    @if($newMembers->count() > 0)
    <div class="section">
        <div class="section-title">Anggota Baru Bulan Ini</div>
        <table class="data">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Divisi</th>
                    <th>Tanggal Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @foreach($newMembers as $idx => $member)
                <tr>
                    <td>{{ $idx + 1 }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->nim }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $member->division)) }}</td>
                    <td>{{ $member->joined_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    {{-- Signature --}}
    <div class="signature-area">
        <table>
            <tr>
                <td>
                    <p style="font-size: 10px; color: #666;">Margonda, {{ now()->translatedFormat('d F Y') }}</p>
                    <div class="sign-line">Ketua HMTI</div>
                    <div class="sign-sub">UBSI Margonda</div>
                </td>
                <td>
                    <p style="font-size: 10px; color: #666;">&nbsp;</p>
                    <div class="sign-line">Sekretaris HMTI</div>
                    <div class="sign-sub">UBSI Margonda</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Laporan ini digenerate otomatis oleh Sistem Manajemen HMTI &mdash; {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
