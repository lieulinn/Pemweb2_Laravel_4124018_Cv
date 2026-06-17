<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - {{ $info['personal_info']['first_name'] }} {{ $info['personal_info']['last_name'] }}</title>
    <style>
        /* =========================================================
           RESET & BASE — dompdf tidak mendukung Flexbox/Grid penuh,
           gunakan table-based layout & inline-block
        ========================================================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            color: #1a1a1a;
            background: #ffffff;
            line-height: 1.5;
        }

        /* =========================================================
           LAYOUT UTAMA: 2 Kolom via <table>
        ========================================================= */
        .cv-wrapper {
            width: 100%;
            border: 3px solid #1a1a1a;
        }

        .cv-table {
            width: 100%;
            border-collapse: collapse;
        }

        .sidebar-cell {
            width: 33%;
            background-color: #FFF9E6;
            border-right: 3px solid #1a1a1a;
            vertical-align: top;
            padding: 0;
        }

        .main-cell {
            width: 67%;
            background-color: #ffffff;
            vertical-align: top;
            padding: 0;
        }

        /* =========================================================
           SIDEBAR — Header Profil
        ========================================================= */
        .profile-header {
            background-color: #FFEAA7;
            border-bottom: 3px solid #1a1a1a;
            padding: 24px 16px;
            text-align: center;
        }

        .profile-photo {
            width: 100px;
            height: 100px;
            border-radius: 0px; /* Neo-brutalist: sharp corners */
            border: 3px solid #1a1a1a;
            object-fit: cover;
            display: block;
            margin: 0 auto 12px auto;
        }

        .profile-name {
            font-size: 16px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 6px;
        }

        .profile-tagline {
            font-size: 11px;
            font-weight: bold;
            color: #1a1a1a;
            background: #A78BFA;
            border: 2px solid #1a1a1a;
            display: inline-block;
            padding: 3px 10px;
        }

        /* =========================================================
           SIDEBAR — Blok Konten
        ========================================================= */
        .sidebar-block {
            padding: 16px;
            border-bottom: 2px dashed #1a1a1a;
        }

        .sidebar-block:last-child {
            border-bottom: none;
        }

        .sidebar-block-title {
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #1a1a1a;
            background: #C084FC;
            border: 2px solid #1a1a1a;
            display: inline-block;
            padding: 3px 8px;
            margin-bottom: 10px;
        }

        .contact-row {
            margin-bottom: 7px;
            font-size: 11px;
        }

        .contact-icon {
            display: inline-block;
            width: 18px;
            font-weight: bold;
            color: #FF4E88;
        }

        /* Tags untuk skill, language, interest */
        .tag {
            display: inline-block;
            background: #fff;
            border: 2px solid #1a1a1a;
            font-size: 10px;
            font-weight: bold;
            padding: 2px 7px;
            margin: 2px 2px 2px 0;
        }

        .skill-bar-wrap {
            background: #f0f0f0;
            border: 1.5px solid #1a1a1a;
            height: 10px;
            margin-top: 4px;
            margin-bottom: 8px;
        }

        .skill-bar-fill {
            background: #4ADE80;
            height: 100%;
            border-right: 1.5px solid #1a1a1a;
        }

        .skill-label {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 1px;
        }

        /* =========================================================
           MAIN — Header Halaman
        ========================================================= */
        .main-header {
            background: #FFDE4D;
            border-bottom: 3px solid #1a1a1a;
            padding: 16px 20px;
        }

        .main-header h1 {
            font-size: 22px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 2px;
        }

        .main-header .subtitle {
            font-size: 12px;
            color: #555;
        }

        /* =========================================================
           MAIN — Blok Konten
        ========================================================= */
        .main-block {
            padding: 16px 20px;
            border-bottom: 2px solid #e0e0e0;
        }

        .main-block:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #1a1a1a;
            border-bottom: 3px solid #1a1a1a;
            padding-bottom: 5px;
            margin-bottom: 12px;
        }

        .section-title .icon {
            display: inline-block;
            background: #FFDE4D;
            border: 2px solid #1a1a1a;
            width: 22px;
            height: 22px;
            text-align: center;
            line-height: 20px;
            margin-right: 6px;
            font-size: 12px;
        }

        /* ABOUT */
        .about-text {
            font-size: 11.5px;
            color: #333;
            line-height: 1.7;
        }

        /* EXPERIENCE & EDUCATION ITEMS */
        .exp-item {
            margin-bottom: 14px;
            background: #FDFBFF;
            border: 2px solid #1a1a1a;
            padding: 10px 12px;
        }

        .exp-item .job-title {
            font-size: 13px;
            font-weight: bold;
            color: #1a1a1a;
        }

        .exp-item .company {
            font-size: 11px;
            font-weight: bold;
            color: #FF4E88;
            margin: 2px 0 4px 0;
        }

        .exp-item .time-badge {
            display: inline-block;
            font-size: 10px;
            font-weight: bold;
            background: #FFF2CC;
            border: 1.5px solid #1a1a1a;
            padding: 1px 7px;
            margin-bottom: 5px;
        }

        .exp-item .desc {
            font-size: 11px;
            color: #444;
            line-height: 1.6;
        }

        /* PROJECTS */
        .project-item {
            margin-bottom: 10px;
            border: 2px solid #1a1a1a;
            padding: 8px 12px;
            background: #FFF9F6;
        }

        .project-item .project-title {
            font-size: 12px;
            font-weight: bold;
            color: #1a1a1a;
        }

        .project-item .project-desc {
            font-size: 11px;
            color: #555;
            margin-top: 3px;
        }

        /* =========================================================
           FOOTER
        ========================================================= */
        .cv-footer {
            text-align: center;
            font-size: 10px;
            color: #888;
            padding: 10px;
            border-top: 2px solid #1a1a1a;
            background: #FFEAA7;
        }
    </style>
</head>
<body>

<div class="cv-wrapper">

    {{-- ===================== LAYOUT 2 KOLOM ===================== --}}
    <table class="cv-table">
        <tr>

            {{-- =================== SIDEBAR =================== --}}
            <td class="sidebar-cell">

                {{-- Foto & Nama --}}
                <div class="profile-header">
                    <img
                        class="profile-photo"
                        src="{{ isset($info['personal_info']['image_path']) && !empty($info['personal_info']['image_path'])
                            ? public_path('assets/images/' . $info['personal_info']['image_path'])
                            : public_path('assets/images/user-thumb.jpg') }}"
                        alt="Foto Profil"
                    >
                    <div class="profile-name">
                        {{ $info['personal_info']['first_name'] }} {{ $info['personal_info']['last_name'] }}
                    </div>
                    <span class="profile-tagline">{{ $info['personal_info']['profile_title'] }}</span>
                </div>

                {{-- Kontak --}}
                @if(!empty($info['contact_info']))
                <div class="sidebar-block">
                    <div class="sidebar-block-title">&#128222; Kontak</div>

                    @if(!empty($info['contact_info']['email']))
                    <div class="contact-row">
                        <span class="contact-icon">@</span>
                        {{ $info['contact_info']['email'] }}
                    </div>
                    @endif

                    @if(!empty($info['contact_info']['phone_number']))
                    <div class="contact-row">
                        <span class="contact-icon">&#9742;</span>
                        {{ $info['contact_info']['phone_number'] }}
                    </div>
                    @endif

                    @if(!empty($info['contact_info']['website']))
                    <div class="contact-row">
                        <span class="contact-icon">&#127760;</span>
                        {{ $info['contact_info']['website'] }}
                    </div>
                    @endif

                    @if(!empty($info['contact_info']['linkedin_link']))
                    <div class="contact-row">
                        <span class="contact-icon">in</span>
                        {{ $info['contact_info']['linkedin_link'] }}
                    </div>
                    @endif

                    @if(!empty($info['contact_info']['github_link']))
                    <div class="contact-row">
                        <span class="contact-icon">GH</span>
                        {{ $info['contact_info']['github_link'] }}
                    </div>
                    @endif
                </div>
                @endif

                {{-- Keahlian --}}
                @if(!empty($info['skill_info']))
                <div class="sidebar-block">
                    <div class="sidebar-block-title">&#9733; Keahlian</div>
                    @foreach($info['skill_info'] as $skill)
                    <div class="skill-label">{{ $skill['skill_name'] }}</div>
                    <div class="skill-bar-wrap">
                        <div class="skill-bar-fill" style="width: {{ $skill['skill_percentage'] ?? 50 }}%;"></div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Bahasa --}}
                @if(!empty($info['language_info']))
                <div class="sidebar-block">
                    <div class="sidebar-block-title">&#127760; Bahasa</div>
                    @foreach($info['language_info'] as $lang)
                    <span class="tag">{{ $lang['language'] }} <small style="color:#FF4E88;">{{ $lang['language_level'] }}</small></span>
                    @endforeach
                </div>
                @endif

                {{-- Minat --}}
                @if(!empty($info['interest_info']))
                <div class="sidebar-block">
                    <div class="sidebar-block-title">&#9829; Minat</div>
                    @foreach($info['interest_info'] as $interest)
                    <span class="tag">{{ $interest['interest'] }}</span>
                    @endforeach
                </div>
                @endif

            </td>{{-- end sidebar-cell --}}

            {{-- =================== MAIN CONTENT =================== --}}
            <td class="main-cell">

                {{-- Header Nama --}}
                <div class="main-header">
                    <h1>{{ $info['personal_info']['first_name'] }} {{ $info['personal_info']['last_name'] }}</h1>
                    <div class="subtitle">{{ $info['personal_info']['profile_title'] }}</div>
                </div>

                {{-- Tentang Saya --}}
                @if(!empty($info['personal_info']['about_me']))
                <div class="main-block">
                    <div class="section-title"><span class="icon">&#128100;</span>Tentang Saya</div>
                    <div class="about-text">{{ $info['personal_info']['about_me'] }}</div>
                </div>
                @endif

                {{-- Pengalaman Kerja --}}
                @if(!empty($info['experience_info']))
                <div class="main-block">
                    <div class="section-title"><span class="icon">&#128188;</span>Pengalaman Kerja</div>
                    @foreach($info['experience_info'] as $exp)
                    <div class="exp-item">
                        <div class="job-title">{{ $exp['job_title'] }}</div>
                        <div class="company">{{ $exp['organization'] }}</div>
                        <div class="time-badge">
                            {{ \Carbon\Carbon::parse($exp['job_start_date'])->format('M Y') }}
                            —
                            {{ !empty($exp['job_end_date']) ? \Carbon\Carbon::parse($exp['job_end_date'])->format('M Y') : 'Sekarang' }}
                        </div>
                        @if(!empty($exp['job_description']))
                        <div class="desc">{{ $exp['job_description'] }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Pendidikan --}}
                @if(!empty($info['education_info']))
                <div class="main-block">
                    <div class="section-title"><span class="icon">&#127979;</span>Pendidikan</div>
                    @foreach($info['education_info'] as $edu)
                    <div class="exp-item">
                        <div class="job-title">{{ $edu['degree_title'] }}</div>
                        <div class="company">{{ $edu['institute'] }}</div>
                        <div class="time-badge">
                            {{ \Carbon\Carbon::parse($edu['edu_start_date'])->format('M Y') }}
                            —
                            {{ !empty($edu['edu_end_date']) ? \Carbon\Carbon::parse($edu['edu_end_date'])->format('M Y') : 'Sekarang' }}
                        </div>
                        @if(!empty($edu['education_description']))
                        <div class="desc">{{ $edu['education_description'] }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Proyek --}}
                @if(!empty($info['project_info']))
                <div class="main-block">
                    <div class="section-title"><span class="icon">&#128295;</span>Proyek</div>
                    @foreach($info['project_info'] as $project)
                    <div class="project-item">
                        <div class="project-title">{{ $project['project_title'] }}</div>
                        @if(!empty($project['project_description']))
                        <div class="project-desc">{{ $project['project_description'] }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

            </td>{{-- end main-cell --}}

        </tr>
    </table>

    {{-- Footer --}}
    <div class="cv-footer">
        Dicetak pada {{ now()->format('d F Y, H:i') }} &bull; CV Digital &bull; Dibuat dengan &#9829;
    </div>

</div>

</body>
</html>
