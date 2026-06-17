<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>CV ATS — {{ $info['personal_info']['first_name'] }} {{ $info['personal_info']['last_name'] }}</title>
    <style>
        /*
         * ================================================================
         *  DOMPDF-SAFE CSS — PANDUAN KOMPATIBILITAS
         * ================================================================
         *  DIDUKUNG    : font, font-size, font-weight, font-style,
         *                color, background-color, border, padding,
         *                margin, width, text-align, line-height,
         *                display:block/table, <table> layout
         *
         *  TIDAK AMAN  : universal selector (*), display:inline pada <div>,
         *                flexbox, grid, letter-spacing (parsial),
         *                white-space:nowrap (parsial), text-transform (parsial)
         *
         *  SOLUSI      : Reset dilakukan per-elemen (body, p, div, table, ul, li)
         *                Layout 2-kolom → <table> dengan width="100%"
         * ================================================================
         */

        /* --- RESET PER-ELEMEN (bukan * {}) --- */
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            color: #111111;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }

        p, div, h1, h2, h3, h4, h5, h6, ul, li, table, td, th {
            margin: 0;
            padding: 0;
        }

        /* --- WRAPPER HALAMAN --- */
        .page {
            margin: 30pt;
        }

        /* ================================================================
         *  HEADER — NAMA & JABATAN (tengah)
         * ================================================================ */
        .cv-name {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20pt;
            font-weight: bold;
            color: #000000;
            text-align: center;
            margin-bottom: 4pt;
        }

        .cv-title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            font-weight: normal;
            color: #333333;
            text-align: center;
            margin-bottom: 6pt;
        }

        .cv-contact {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9pt;
            color: #444444;
            text-align: center;
            margin-bottom: 0;
        }

        .header-divider {
            border: none;
            border-top: 2pt solid #000000;
            margin-top: 8pt;
            margin-bottom: 0;
        }

        /* ================================================================
         *  SECTION TITLE — garis bawah tunggal
         * ================================================================ */
        .section-wrap {
            margin-top: 12pt;
            margin-bottom: 0;
        }

        .section-heading {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9.5pt;
            font-weight: bold;
            color: #000000;
            background-color: #ffffff;
            padding-bottom: 2pt;
            border-bottom: 1.5pt solid #000000;
            margin-bottom: 7pt;
            display: block;
        }

        /* ================================================================
         *  PROFIL KARIR
         * ================================================================ */
        .summary-p {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10.5pt;
            color: #222222;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* ================================================================
         *  ENTRY (Pengalaman / Pendidikan / Proyek)
         *  Layout: tabel 2 kolom — kiri:judul, kanan:periode
         * ================================================================ */
        .entry-wrap {
            margin-bottom: 9pt;
        }

        .entry-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1pt;
        }

        .entry-table td {
            font-family: Arial, Helvetica, sans-serif;
            padding: 0;
            border: none;
            vertical-align: top;
        }

        .td-title {
            font-size: 11pt;
            font-weight: bold;
            color: #000000;
            width: 72%;
        }

        .td-period {
            font-size: 9.5pt;
            font-weight: normal;
            color: #555555;
            width: 28%;
            text-align: right;
        }

        .entry-company {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            font-style: italic;
            color: #333333;
            display: block;
            margin-top: 2pt;
            margin-bottom: 3pt;
        }

        /* ================================================================
         *  BULLET LIST — manual indent agar dompdf kompatibel
         * ================================================================ */
        .blist {
            margin-top: 2pt;
            margin-bottom: 0;
            padding-left: 0;
            list-style: none;
        }

        .blist li {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10.5pt;
            color: #222222;
            line-height: 1.6;
            padding-left: 14pt;
            margin-bottom: 2pt;
        }

        /* Bullet manual via :before — dompdf v3 mendukung :before dengan content */
        .blist li:before {
            content: "- ";
            color: #000000;
            font-weight: bold;
        }

        /* ================================================================
         *  ENTRY DIVIDER (tipis, antara item)
         * ================================================================ */
        .entry-hr {
            border: none;
            border-top: 0.5pt solid #cccccc;
            margin-top: 6pt;
            margin-bottom: 6pt;
        }

        /* ================================================================
         *  KEAHLIAN — tabel 2 kolom: label | daftar skill
         * ================================================================ */
        .skill-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3pt;
        }

        .skill-table td {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10.5pt;
            color: #222222;
            padding: 0;
            vertical-align: top;
            border: none;
        }

        .td-skill-label {
            font-weight: bold;
            width: 80pt;
            padding-right: 6pt;
        }

        .td-skill-val {
            font-weight: normal;
        }

        /* ================================================================
         *  BAHASA & MINAT — teks biasa
         * ================================================================ */
        .plain-text {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10.5pt;
            color: #222222;
            line-height: 1.6;
            display: block;
        }

        /* ================================================================
         *  FOOTER
         * ================================================================ */
        .cv-footer {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8pt;
            color: #999999;
            text-align: center;
            margin-top: 18pt;
            border-top: 0.5pt solid #cccccc;
            padding-top: 5pt;
        }
    </style>
</head>
<body>
<div class="page">

    {{-- ================================================================
         BAGIAN 1 — HEADER: NAMA, JABATAN, KONTAK
    ================================================================ --}}
    <div class="cv-name">
        {{ strtoupper($info['personal_info']['first_name'] . ' ' . $info['personal_info']['last_name']) }}
    </div>

    @if(!empty($info['personal_info']['profile_title']))
    <div class="cv-title">{{ $info['personal_info']['profile_title'] }}</div>
    @endif

    @php
        /* Susun kontak sebagai array, gabungkan dengan pemisah " | " */
        $contactParts = [];
        if (!empty($info['contact_info']['email']))         $contactParts[] = $info['contact_info']['email'];
        if (!empty($info['contact_info']['phone_number']))  $contactParts[] = $info['contact_info']['phone_number'];
        if (!empty($info['contact_info']['website']))       $contactParts[] = $info['contact_info']['website'];
        if (!empty($info['contact_info']['linkedin_link'])) $contactParts[] = $info['contact_info']['linkedin_link'];
        if (!empty($info['contact_info']['github_link']))   $contactParts[] = $info['contact_info']['github_link'];
        if (!empty($info['contact_info']['twitter']))       $contactParts[] = $info['contact_info']['twitter'];
    @endphp

    @if(!empty($contactParts))
    <div class="cv-contact">{{ implode('   |   ', $contactParts) }}</div>
    @endif

    <hr class="header-divider">

    {{-- ================================================================
         BAGIAN 2 — PROFIL KARIR / RINGKASAN
    ================================================================ --}}
    @if(!empty($info['personal_info']['about_me']))
    <div class="section-wrap">
        <span class="section-heading">PROFIL KARIR</span>
        <p class="summary-p">{{ $info['personal_info']['about_me'] }}</p>
    </div>
    @endif

    {{-- ================================================================
         BAGIAN 3 — PENGALAMAN KERJA
    ================================================================ --}}
    @if(!empty($info['experience_info']))
    <div class="section-wrap">
        <span class="section-heading">PENGALAMAN KERJA</span>

        @foreach($info['experience_info'] as $exp)
        <div class="entry-wrap">
            {{-- Baris: Jabatan (kiri) + Periode (kanan) via <table> --}}
            <table class="entry-table">
                <tr>
                    <td class="td-title">{{ $exp['job_title'] }}</td>
                    <td class="td-period">
                        @php
                            $jStart = !empty($exp['job_start_date'])
                                ? \Carbon\Carbon::parse($exp['job_start_date'])->format('M Y')
                                : '';
                            $jEnd = !empty($exp['job_end_date'])
                                ? \Carbon\Carbon::parse($exp['job_end_date'])->format('M Y')
                                : 'Sekarang';
                        @endphp
                        {{ $jStart }} - {{ $jEnd }}
                    </td>
                </tr>
            </table>

            @if(!empty($exp['organization']))
            <span class="entry-company">{{ $exp['organization'] }}</span>
            @endif

            @if(!empty($exp['job_description']))
            <ul class="blist">
                @foreach(array_filter(array_map('trim', explode("\n", $exp['job_description']))) as $baris)
                <li>{{ $baris }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        @if(!$loop->last)<hr class="entry-hr">@endif
        @endforeach
    </div>
    @endif

    {{-- ================================================================
         BAGIAN 4 — PENDIDIKAN
    ================================================================ --}}
    @if(!empty($info['education_info']))
    <div class="section-wrap">
        <span class="section-heading">PENDIDIKAN</span>

        @foreach($info['education_info'] as $edu)
        <div class="entry-wrap">
            <table class="entry-table">
                <tr>
                    <td class="td-title">{{ $edu['degree_title'] }}</td>
                    <td class="td-period">
                        @php
                            $eStart = !empty($edu['edu_start_date'])
                                ? \Carbon\Carbon::parse($edu['edu_start_date'])->format('M Y')
                                : '';
                            $eEnd = !empty($edu['edu_end_date'])
                                ? \Carbon\Carbon::parse($edu['edu_end_date'])->format('M Y')
                                : 'Sekarang';
                        @endphp
                        {{ $eStart }} - {{ $eEnd }}
                    </td>
                </tr>
            </table>

            @if(!empty($edu['institute']))
            <span class="entry-company">{{ $edu['institute'] }}</span>
            @endif

            @if(!empty($edu['education_description']))
            <ul class="blist">
                @foreach(array_filter(array_map('trim', explode("\n", $edu['education_description']))) as $baris)
                <li>{{ $baris }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        @if(!$loop->last)<hr class="entry-hr">@endif
        @endforeach
    </div>
    @endif

    {{-- ================================================================
         BAGIAN 5 — PROYEK
    ================================================================ --}}
    @if(!empty($info['project_info']))
    <div class="section-wrap">
        <span class="section-heading">PROYEK</span>

        @foreach($info['project_info'] as $proj)
        <div class="entry-wrap">
            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 11pt; font-weight: bold; color: #000000; display: block;">
                {{ $proj['project_title'] }}
            </span>

            @if(!empty($proj['project_description']))
            <ul class="blist">
                @foreach(array_filter(array_map('trim', explode("\n", $proj['project_description']))) as $baris)
                <li>{{ $baris }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        @if(!$loop->last)<hr class="entry-hr">@endif
        @endforeach
    </div>
    @endif

    {{-- ================================================================
         BAGIAN 6 — KEAHLIAN (teks, bukan progress bar)
         Dikelompokkan: Mahir / Menengah / Dasar berdasarkan persentase
    ================================================================ --}}
    @if(!empty($info['skill_info']))
    <div class="section-wrap">
        <span class="section-heading">KEAHLIAN</span>

        @php
            $grMahir    = array_values(array_filter($info['skill_info'],
                            fn($s) => (int)($s['skill_percentage'] ?? 0) >= 80));
            $grMenengah = array_values(array_filter($info['skill_info'],
                            fn($s) => (int)($s['skill_percentage'] ?? 0) >= 50
                                   && (int)($s['skill_percentage'] ?? 0) < 80));
            $grDasar    = array_values(array_filter($info['skill_info'],
                            fn($s) => (int)($s['skill_percentage'] ?? 0) < 50));
        @endphp

        @if(!empty($grMahir))
        <table class="skill-table">
            <tr>
                <td class="td-skill-label">Mahir:</td>
                <td class="td-skill-val">{{ implode(', ', array_column($grMahir, 'skill_name')) }}</td>
            </tr>
        </table>
        @endif

        @if(!empty($grMenengah))
        <table class="skill-table">
            <tr>
                <td class="td-skill-label">Menengah:</td>
                <td class="td-skill-val">{{ implode(', ', array_column($grMenengah, 'skill_name')) }}</td>
            </tr>
        </table>
        @endif

        @if(!empty($grDasar))
        <table class="skill-table">
            <tr>
                <td class="td-skill-label">Dasar:</td>
                <td class="td-skill-val">{{ implode(', ', array_column($grDasar, 'skill_name')) }}</td>
            </tr>
        </table>
        @endif

    </div>
    @endif

    {{-- ================================================================
         BAGIAN 7 — BAHASA
    ================================================================ --}}
    @if(!empty($info['language_info']))
    <div class="section-wrap">
        <span class="section-heading">BAHASA</span>
        <span class="plain-text">
            @foreach($info['language_info'] as $lang)
                {{ $lang['language'] }}@if(!empty($lang['language_level'])) ({{ $lang['language_level'] }})@endif@if(!$loop->last),  @endif
            @endforeach
        </span>
    </div>
    @endif

    {{-- ================================================================
         BAGIAN 8 — MINAT
    ================================================================ --}}
    @if(!empty($info['interest_info']))
    <div class="section-wrap">
        <span class="section-heading">MINAT</span>
        <span class="plain-text">
            {{ implode(',  ', array_column($info['interest_info'], 'interest')) }}
        </span>
    </div>
    @endif

    {{-- ================================================================
         FOOTER
    ================================================================ --}}
    <div class="cv-footer">
        {{ $info['personal_info']['first_name'] }} {{ $info['personal_info']['last_name'] }}
        &bull; Dicetak {{ now()->format('d F Y') }}
        &bull; CV ATS-Friendly
    </div>

</div>{{-- /.page --}}
</body>
</html>
