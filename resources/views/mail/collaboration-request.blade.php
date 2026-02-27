<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Kolaborasi – HMTI Margonda</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f4f8; margin: 0; padding: 20px; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,.08); }
        .header { background: linear-gradient(135deg, #1a3a6b 0%, #2563eb 100%); padding: 32px 32px 24px; text-align: center; }
        .header h1 { color: #f5c518; font-size: 22px; margin: 0 0 4px; font-weight: 800; letter-spacing: .5px; }
        .header p { color: #c3d4ea; font-size: 13px; margin: 0; }
        .badge { display: inline-block; background: #f5c518; color: #1a3a6b; font-size: 11px; font-weight: 800; padding: 4px 12px; border-radius: 20px; margin-top: 12px; letter-spacing: .5px; }
        .body { padding: 32px; }
        .intro { color: #374151; font-size: 14px; line-height: 1.7; margin-bottom: 28px; }
        .detail-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px 24px; margin-bottom: 24px; }
        .detail-row { display: flex; gap: 12px; padding: 8px 0; border-bottom: 1px dashed #e5e7eb; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { color: #6b7280; font-size: 12px; font-weight: 600; min-width: 140px; text-transform: uppercase; letter-spacing: .4px; }
        .detail-value { color: #1f2937; font-size: 13px; flex: 1; }
        .message-box { background: #eff6ff; border-left: 4px solid #1a3a6b; border-radius: 0 8px 8px 0; padding: 16px 20px; margin: 16px 0; color: #1e40af; font-size: 13px; line-height: 1.7; }
        .reply-btn { display: block; text-align: center; background: #1a3a6b; color: #fff !important; padding: 13px 28px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px; margin: 24px 0; }
        .footer { background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 20px 32px; text-align: center; color: #9ca3af; font-size: 11px; line-height: 1.6; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>🤝 Pengajuan Kolaborasi Baru</h1>
            <p>Himpunan Mahasiswa Teknologi Informasi · UBSI Margonda</p>
            <span class="badge">NOTIFIKASI KOLABORASI</span>
        </div>
        <div class="body">
            <p class="intro">
                Halo Tim HMTI Margonda! 👋<br>
                Ada pengajuan kolaborasi baru yang masuk melalui website HMTI Margonda pada
                <strong>{{ now()->translatedFormat('l, d F Y \p\u\k\u\l H:i') }} WIB</strong>.
                Berikut detail pengajuannya:
            </p>

            <div class="detail-box">
                <div class="detail-row">
                    <span class="detail-label">Nama / Organisasi</span>
                    <span class="detail-value">{{ $senderName }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email</span>
                    <span class="detail-value"><a href="mailto:{{ $senderEmail }}" style="color:#1a3a6b;">{{ $senderEmail }}</a></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">No. WhatsApp / HP</span>
                    <span class="detail-value">{{ $senderPhone ?: '—' }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Jenis Kolaborasi</span>
                    <span class="detail-value"><strong>{{ $collabType }}</strong></span>
                </div>
            </div>

            <p style="color:#374151; font-size:13px; font-weight:600; margin-bottom:8px;">Deskripsi Kolaborasi:</p>
            <div class="message-box">{{ $collabMessage }}</div>

            <a href="mailto:{{ $senderEmail }}?subject=Re: Pengajuan Kolaborasi dari {{ $senderName }}" class="reply-btn">
                Balas Email Pengaju
            </a>

            <p style="color:#6b7280; font-size:12px; text-align:center;">
                Segera tindak lanjuti pengajuan ini agar kolaborasi dapat berjalan dengan baik. 🚀
            </p>
        </div>
        <div class="footer">
            Email ini dikirim otomatis dari website <strong>HMTI UBSI Margonda</strong>.<br>
            Jl. Margonda Raya No.353, Depok, Jawa Barat &nbsp;|&nbsp; hmti.ubsi.margonda@gmail.com
        </div>
    </div>
</body>
</html>
