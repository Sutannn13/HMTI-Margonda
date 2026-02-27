<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { size: landscape; margin: 0; }
        body { margin: 0; padding: 0; font-family: 'Helvetica', 'Arial', sans-serif; }
        .certificate { width: 100%; min-height: 530px; position: relative; overflow: hidden; background: #fff; page-break-after: always; }
        .certificate:last-child { page-break-after: auto; }
        .border-outer { border: 3px solid #1a3a6b; margin: 12px; padding: 8px; min-height: 500px; }
        .border-inner { border: 1px solid #f5c518; padding: 30px 50px; min-height: 480px; text-align: center; position: relative; }
        .corner { position: absolute; width: 60px; height: 60px; }
        .corner-tl { top: 5px; left: 5px; border-top: 3px solid #f5c518; border-left: 3px solid #f5c518; }
        .corner-tr { top: 5px; right: 5px; border-top: 3px solid #f5c518; border-right: 3px solid #f5c518; }
        .corner-bl { bottom: 5px; left: 5px; border-bottom: 3px solid #f5c518; border-left: 3px solid #f5c518; }
        .corner-br { bottom: 5px; right: 5px; border-bottom: 3px solid #f5c518; border-right: 3px solid #f5c518; }
        .org-name { font-size: 11px; color: #666; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 5px; }
        .title { font-size: 36px; color: #1a3a6b; font-weight: bold; margin: 10px 0; letter-spacing: 2px; }
        .subtitle { font-size: 13px; color: #666; margin-bottom: 20px; }
        .presented { font-size: 12px; color: #888; }
        .name { font-size: 28px; color: #1a3a6b; font-weight: bold; margin: 8px 0; padding-bottom: 5px; border-bottom: 2px solid #f5c518; display: inline-block; }
        .event-name { font-size: 16px; color: #333; margin: 15px 0 5px; }
        .event-detail { font-size: 11px; color: #666; margin: 3px 0; }
        .footer { margin-top: 30px; }
        .footer table { width: 80%; margin: 0 auto; }
        .footer td { text-align: center; vertical-align: bottom; padding: 0 20px; }
        .sign-line { border-top: 1px solid #333; margin-top: 50px; padding-top: 5px; font-size: 11px; color: #333; }
        .sign-title { font-size: 9px; color: #888; }
        .hmti-badge { background: #1a3a6b; color: #f5c518; display: inline-block; padding: 4px 15px; border-radius: 3px; font-size: 10px; letter-spacing: 1px; margin-top: 10px; }
    </style>
</head>
<body>
    @foreach($attendees as $registration)
    <div class="certificate">
        <div class="border-outer">
            <div class="border-inner">
                <div class="corner corner-tl"></div>
                <div class="corner corner-tr"></div>
                <div class="corner corner-bl"></div>
                <div class="corner corner-br"></div>

                <p class="org-name">Himpunan Mahasiswa Teknologi Informasi</p>
                <p class="title">SERTIFIKAT</p>
                <p class="subtitle">Certificate of Participation</p>

                <p class="presented">Diberikan kepada:</p>
                <p class="name">{{ $registration->user->name }}</p>
                <p style="font-size: 11px; color: #888;">NIM: {{ $registration->user->nim }}</p>

                <p class="event-name">Atas partisipasinya dalam kegiatan</p>
                <p style="font-size: 20px; font-weight: bold; color: #1a3a6b;">"{{ $event->title }}"</p>
                <p class="event-detail">{{ $event->location ?? 'UBSI Margonda' }}</p>
                <p class="event-detail">{{ $event->start_date->translatedFormat('d F Y') }}</p>

                <div class="footer">
                    <table>
                        <tr>
                            <td>
                                <div class="sign-line">Ketua HMTI</div>
                                <div class="sign-title">Himpunan Mahasiswa TI – UBSI</div>
                            </td>
                            <td>
                                <div class="sign-line">Ketua Panitia</div>
                                <div class="sign-title">{{ $event->title }}</div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="hmti-badge">HMTI UBSI MARGONDA</div>
            </div>
        </div>
    </div>
    @endforeach
</body>
</html>
