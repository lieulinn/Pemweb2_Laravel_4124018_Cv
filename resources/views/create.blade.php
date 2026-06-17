{{ view('layouts.header') }}

<div class="content-wrapper mt-4">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <h1 class="m-0">Kelola Profil Pengguna</h1>
                </div>
                <div class="col-4 text-right text-end">
                    <a href="{{ route('index') }}" class="add-btn">
                        <i class="fa fa-home"></i>
                        <br> Beranda
                    </a>
                    <button onclick="saverecord()" class="save-btn">
                        <i class="fa fa-save"></i>
                        <br> Simpan
                    </button>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ul class="page-breadcrumb breadcrumb">
                        <li class="breadcrumb-item"><i class="fas fa-angle-right"></i></li>
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><i class="fas fa-angle-right"></i></li>
                        <li class="breadcrumb-item">Buat Profil Pengguna</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title">Buat Profil Pengguna</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 p-md-5 p-sm-4 p-3">
                                <form action="{{ route('store') }}" id="createform" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{-- Personal Information --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="fw-bold text-secondary">Informasi Pribadi</h2>
                                            <div class="form-outline mb-4">
                                                <input type="hidden" id="user_id" name="user_id"
                                                    class="form-control" />
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-sm-6 col-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label fw-bold text-secondary">Nama Depan</label>
                                                                <input type="text" id="first_name" name="first_name"
                                                                    placeholder="Nama Depan" class="form-control"
                                                                    required />
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-outline">
                                                                <label class="form-label fw-bold text-secondary">Nama Belakang</label>
                                                                <input type="text" id="last_name" name="last_name"
                                                                    placeholder="Nama Belakang" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-12">
                                                    <div class="profile_picture text-center">
                                                        <input type="file" name="image_path"
                                                            accept="image/png, image/jpeg, image/jpg"
                                                            onchange="display_image(this);"
                                                            class="d-none upload-box-image">
                                                        <img class="box-image-preview img-fluid img-circle elevation-2"
                                                            src="{{ asset('assets/images/user-thumb.jpg') }}"
                                                            alt="Foto Profil"
                                                            onclick="$(this).closest('.profile_picture').find('input').click();"
                                                            style="height:150px; width:150px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label fw-bold text-secondary">Jabatan / Gelar Profil</label>
                                                <input type="text" id="profile_title" name="profile_title"
                                                    class="form-control" placeholder="Contoh: Software Engineer" required />
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label fw-bold text-secondary">Tentang Saya</label>
                                                <textarea class="form-control" placeholder="Tuliskan deskripsi singkat mengenai diri Anda..." id="about_me" name="about_me" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Contact Information --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="fw-bold text-secondary">Informasi Kontak</h2>
                                            <div class="row mb-4">
                                                <div class="col-md-4 col-sm-6 col-12 mb-4">
                                                    <div class="form-outline">
                                                        <label class="form-label fw-bold text-secondary">Email</label>
                                                        <input type="email" id="email" name="email"
                                                            placeholder="Email" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-12 mb-4">
                                                    <div class="form-outline">
                                                        <label class="form-label fw-bold text-secondary">Nomor Telepon</label>
                                                        <input type="number" id="phone_number" name="phone_number"
                                                            placeholder="Nomor Telepon" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-12 mb-4">
                                                    <div class="form-outline">
                                                        <label
                                                            class="form-label fw-bold text-secondary">Situs Web</label>
                                                        <input type="url" id="website" name="website"
                                                            class="form-control" placeholder="Situs Web" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-12 mb-4">
                                                    <div class="form-outline">
                                                        <label
                                                            class="form-label fw-bold text-secondary">LinkedIn</label>
                                                        <input type="url" id="linkedin_link" name="linkedin_link"
                                                            class="form-control" placeholder="LinkedIn" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-12 mb-4">
                                                    <div class="form-outline">
                                                        <label class="form-label fw-bold text-secondary">Github</label>
                                                        <input type="url" id="github_link" name="github_link"
                                                            class="form-control" placeholder="Github" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-12 mb-4">
                                                    <div class="form-outline">
                                                        <label
                                                            class="form-label fw-bold text-secondary">Twitter</label>
                                                        <input type="text" id="twitter" name="twitter"
                                                            class="form-control" placeholder="Twitter" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Education --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h2 class="fw-bold text-secondary">Pendidikan</h2>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <button class="btn btn-primary" id="add_education">Tambah Pendidikan</button>
                                                </div>
                                            </div>
                                            <section class="education_section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <div class="form-outline mb-4">
                                                            <label
                                                                class="form-label fw-bold text-secondary">Gelar / Program Studi</label>
                                                            <input type="text" id="degree_title"
                                                                name="degree_title[]" class="form-control"
                                                                placeholder="Contoh: Sarjana Komputer" />
                                                        </div>
                                                        <div class="form-outline mb-4">
                                                            <label
                                                                class="form-label fw-bold text-secondary">Institusi / Sekolah</label>
                                                            <input type="text" id="institute" name="institute[]"
                                                                class="form-control" placeholder="Contoh: Universitas Indonesia" />
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-sm-6 col-12">
                                                                <div class="form-outline">
                                                                    <label
                                                                        class="form-label fw-bold text-secondary">Tanggal Mulai</label>
                                                                    <input type="date" id="edu_start_date"
                                                                        name="edu_start_date[]"
                                                                        class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-12">
                                                                <div class="form-outline">
                                                                    <label
                                                                        class="form-label fw-bold text-secondary">Tanggal Selesai</label>
                                                                    <input type="date" id="edu_end_date"
                                                                        name="edu_end_date[]" class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-outline mb-4">
                                                            <label class="form-label fw-bold text-secondary">Deskripsi Pendidikan</label>
                                                            <textarea class="form-control" placeholder="Deskripsi mengenai pendidikan Anda" id="education_description" name="education_description[]"
                                                                rows="4"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>

                                    {{-- Experience --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h2 class="fw-bold text-secondary">Pengalaman Kerja</h2>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <button class="btn btn-primary" id="add_experience">Tambah Pengalaman</button>
                                                </div>
                                            </div>
                                            <section class="experience_section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <div class="form-outline mb-4">
                                                            <label class="form-label fw-bold text-secondary">Jabatan</label>
                                                            <input type="text" id="job_title" name="job_title[]"
                                                                class="form-control" placeholder="Contoh: Software Engineer" />
                                                        </div>
                                                        <div class="form-outline mb-4">
                                                            <label
                                                                class="form-label fw-bold text-secondary">Organisasi / Perusahaan</label>
                                                            <input type="text" id="organization"
                                                                name="organization[]" class="form-control"
                                                                placeholder="Contoh: PT. Maju Bersama" />
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-sm-6 col-12">
                                                                <div class="form-outline">
                                                                    <label
                                                                        class="form-label fw-bold text-secondary">Tanggal Mulai</label>
                                                                    <input type="date" id="job_start_date"
                                                                        name="job_start_date[]"
                                                                        class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-12">
                                                                <div class="form-outline">
                                                                    <label
                                                                        class="form-label fw-bold text-secondary">Tanggal Selesai</label>
                                                                    <input type="date" id="job_end_date"
                                                                        name="job_end_date[]" class="form-control" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-outline mb-4">
                                                            <label class="form-label fw-bold text-secondary">Deskripsi Pekerjaan</label>
                                                            <textarea class="form-control" placeholder="Deskripsi tugas dan pencapaian Anda" id="job_description" name="job_description[]"
                                                                rows="4"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>

                                    {{-- Projects --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h2 class="fw-bold text-secondary">Proyek</h2>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <button class="btn btn-primary" id="add_project">Tambah Proyek</button>
                                                </div>
                                            </div>
                                            <section class="project_section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <div class="form-outline mb-4">
                                                            <label class="form-label fw-bold text-secondary">Judul Proyek</label>
                                                            <input type="text" id="project_title"
                                                                name="project_title[]" class="form-control"
                                                                placeholder="Contoh: Sistem Informasi Kasir" />
                                                        </div>
                                                        <div class="form-outline mb-4">
                                                            <label class="form-label fw-bold text-secondary">Deskripsi Proyek</label>
                                                            <textarea class="form-control" placeholder="Deskripsi singkat mengenai proyek yang Anda kerjakan" id="project_description"
                                                                name="project_description[]" rows="4"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>

                                    {{-- SKILLS & PROFICIENCY --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h2 class="fw-bold text-secondary">Keahlian & Kemahiran</h2>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <button class="btn btn-primary" id="add_skill">Tambah Keahlian</button>
                                                </div>
                                            </div>
                                            <section class="skill_section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <div class="form-outline">
                                                                    <label
                                                                        class="form-label fw-bold text-secondary">Tambah Keahlian</label>
                                                                    <input type="text" id="skill_name"
                                                                        name="skill_name[]" class="form-control"
                                                                        placeholder="Contoh: PHP, Laravel" value="" />
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="form-outline">
                                                                    <label
                                                                        class="form-label fw-bold text-secondary">Persentase</label>
                                                                    <div class="input-group">
                                                                        <input type="number" step="5"
                                                                            id="skill_percentage"
                                                                            name="skill_percentage[]" placeholder="%"
                                                                            class="form-control"
                                                                            aria-describedby="percentage">
                                                                        <span class="input-group-text"
                                                                            id="percentage">%</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>

                                    {{-- Languages --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h2 class="fw-bold text-secondary">Bahasa</h2>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <button class="btn btn-primary" id="add_language">Tambah Bahasa</button>
                                                </div>
                                            </div>
                                            <section class="language_section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <div class="form-outline">
                                                                    <label
                                                                        class="form-label fw-bold text-secondary">Tambah Bahasa</label>
                                                                    <select class="form-control" id="language"
                                                                        name="language[]">
                                                                        <option value="">Pilih Bahasa</option>
                                                                        <option value="af">Afrikaans</option>
                                                                        <option value="sq">Albanian - shqip</option>
                                                                        <option value="am">Amharic - አማርኛ</option>
                                                                        <option value="ar">Arabic - العربية</option>
                                                                        <option value="an">Aragonese - aragonés</option>
                                                                        <option value="hy">Armenian - հայերեն</option>
                                                                        <option value="ast">Asturian - asturianu</option>
                                                                        <option value="az">Azerbaijani - azərbaycan dili</option>
                                                                        <option value="eu">Basque - euskara</option>
                                                                        <option value="be">Belarusian - беларуская</option>
                                                                        <option value="bn">Bengali - বাংলা</option>
                                                                        <option value="bs">Bosnian - bosanski</option>
                                                                        <option value="br">Breton - brezhoneg</option>
                                                                        <option value="bg">Bulgarian - български</option>
                                                                        <option value="ca">Catalan - català</option>
                                                                        <option value="ckb">Central Kurdish - کوردی (دەستنوسی عەرەبی)</option>
                                                                        <option value="zh">Chinese - 中文</option>
                                                                        <option value="zh-HK">Chinese (Hong Kong) - 中文（香港）</option>
                                                                        <option value="zh-CN">Chinese (Simplified) - 中文（简体）</option>
                                                                        <option value="zh-TW">Chinese (Traditional) - 中文（繁體）</option>
                                                                        <option value="co">Corsican</option>
                                                                        <option value="hr">Croatian - hrvatski</option>
                                                                        <option value="cs">Czech - čeština</option>
                                                                        <option value="da">Danish - dansk</option>
                                                                        <option value="nl">Dutch - Nederlands</option>
                                                                        <option value="en">English</option>
                                                                        <option value="eo">Esperanto - esperanto</option>
                                                                        <option value="et">Estonian - eesti</option>
                                                                        <option value="fo">Faroese - føroyskt</option>
                                                                        <option value="fil">Filipino</option>
                                                                        <option value="fi">Finnish - suomi</option>
                                                                        <option value="fr">French - français</option>
                                                                        <option value="gl">Galician - galego</option>
                                                                        <option value="ka">Georgian - ქართული</option>
                                                                        <option value="de">German - Deutsch</option>
                                                                        <option value="el">Greek - Ελληνικά</option>
                                                                        <option value="gn">Guarani</option>
                                                                        <option value="gu">Gujarati - ગુજરાતી</option>
                                                                        <option value="ha">Hausa</option>
                                                                        <option value="haw">Hawaiian - ʻŌlelo Hawaiʻi</option>
                                                                        <option value="he">Hebrew - עברית</option>
                                                                        <option value="hi">Hindi - हिन्दी</option>
                                                                        <option value="hu">Hungarian - magyar</option>
                                                                        <option value="is">Icelandic - íslenska</option>
                                                                        <option value="id">Indonesian - Indonesia</option>
                                                                        <option value="ia">Interlingua</option>
                                                                        <option value="ga">Irish - Gaeilge</option>
                                                                        <option value="it">Italian - italiano</option>
                                                                        <option value="ja">Japanese - 日本語</option>
                                                                        <option value="kn">Kannada - Kannada</option>
                                                                        <option value="kk">Kazakh - қазаq тілі</option>
                                                                        <option value="km">Khmer - ខ្មែរ</option>
                                                                        <option value="ko">Korean - 한국어</option>
                                                                        <option value="ku">Kurdish - Kurdî</option>
                                                                        <option value="ky">Kyrgyz - кыргызча</option>
                                                                        <option value="lo">Lao - ລາວ</option>
                                                                        <option value="la">Latin</option>
                                                                        <option value="lv">Latvian - latviešu</option>
                                                                        <option value="ln">Lingala - lingála</option>
                                                                        <option value="lt">Lithuanian - lietuvių</option>
                                                                        <option value="mk">Macedonian - македонски</option>
                                                                        <option value="ms">Malay - Bahasa Melayu</option>
                                                                        <option value="ml">Malayalam - Malayalam</option>
                                                                        <option value="mt">Maltese - Malti</option>
                                                                        <option value="mr">Marathi - मराठी</option>
                                                                        <option value="mn">Mongolian - монгол</option>
                                                                        <option value="ne">Nepali - नेपाली</option>
                                                                        <option value="no">Norwegian - norsk</option>
                                                                        <option value="oc">Occitan</option>
                                                                        <option value="or">Oriya - ଓଡ଼ිଆ</option>
                                                                        <option value="om">Oromo - Oromoo</option>
                                                                        <option value="ps">Pashto - پښتو</option>
                                                                        <option value="fa">Persian - فارسی</option>
                                                                        <option value="pl">Polish - polski</option>
                                                                        <option value="pt">Portuguese - português</option>
                                                                        <option value="pa">Punjabi - ਪੰਜਾਬੀ</option>
                                                                        <option value="qu">Quechua</option>
                                                                        <option value="ro">Romanian - română</option>
                                                                        <option value="ru">Russian - русский</option>
                                                                        <option value="gd">Scottish Gaelic</option>
                                                                        <option value="sr">Serbian - српски</option>
                                                                        <option value="sh">Serbo-Croatian - Srpskohrvatski</option>
                                                                        <option value="sn">Shona - chiShona</option>
                                                                        <option value="sd">Sindhi</option>
                                                                        <option value="si">Sinhala - සිංහල</option>
                                                                        <option value="sk">Slovak - slovenčina</option>
                                                                        <option value="sl">Slovenian - slovenščina</option>
                                                                        <option value="so">Somali - Soomaali</option>
                                                                        <option value="st">Southern Sotho</option>
                                                                        <option value="es">Spanish - español</option>
                                                                        <option value="su">Sundanese</option>
                                                                        <option value="sw">Swahili - Kiswahili</option>
                                                                        <option value="sv">Swedish - svenska</option>
                                                                        <option value="tg">Tajik - тоҷикӣ</option>
                                                                        <option value="ta">Tamil - தமிழ்</option>
                                                                        <option value="tt">Tatar</option>
                                                                        <option value="te">Telugu - Telugu</option>
                                                                        <option value="th">Thai - ไทย</option>
                                                                        <option value="ti">Tigrinya - ትግርኛ</option>
                                                                        <option value="to">Tongan - lea fakatonga</option>
                                                                        <option value="tr">Turkish - Türkçe</option>
                                                                        <option value="tk">Turkmen</option>
                                                                        <option value="tw">Twi</option>
                                                                        <option value="uk">Ukrainian - українська</option>
                                                                        <option value="ur">Urdu - اردو</option>
                                                                        <option value="ug">Uyghur</option>
                                                                        <option value="uz">Uzbek - o‘zbek</option>
                                                                        <option value="vi">Vietnamese - Tiếng Việt</option>
                                                                        <option value="wa">Walloon - wa</option>
                                                                        <option value="cy">Welsh - Cymraeg</option>
                                                                        <option value="fy">Western Frisian</option>
                                                                        <option value="xh">Xhosa</option>
                                                                        <option value="yi">Yiddish</option>
                                                                        <option value="yo">Yoruba - Èdè Yorùbá</option>
                                                                        <option value="zu">Zulu - isiZulu</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="form-outline">
                                                                    <label
                                                                        class="form-label fw-bold text-secondary">Tingkat</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"
                                                                            id="percentage">Tingkat</span>
                                                                        <select id="language_level"
                                                                            name="language_level[]"
                                                                            placeholder="Tingkat" class="form-control"
                                                                            aria-describedby="percentage">
                                                                            <option value="">Pilih Tingkat</option>
                                                                            <option value="Native">Bahasa Ibu (Native)</option>
                                                                            <option value="Fluent">Lancar (Fluent)</option>
                                                                            <option value="Basic">Dasar (Basic)</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>

                                    {{-- Interests --}}
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-8">
                                                    <h2 class="fw-bold text-secondary">Minat</h2>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <button class="btn btn-primary" id="add_interest">Tambah Minat</button>
                                                </div>
                                            </div>
                                            <section class="interest_section">
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <div class="form-outline">
                                                            <label class="form-label fw-bold text-secondary">Tambah Minat</label>
                                                            <input type="text" id="interest" name="interest[]"
                                                                class="form-control" placeholder="Contoh: Membaca, Bersepeda, Berenang" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>


                                    <!-- Checkbox -->
                                    <div class="form-check d-flex justify-content-center mb-4">
                                        <input class="form-check-input me-2" type="checkbox" value="1"
                                            id="verify" name="verify" required />
                                        <label for="verify" class="form-check-label text-dark font-weight-bold fw-bold ms-2">
                                            Apakah Anda yakin ingin membuat profil baru ini?
                                        </label>
                                    </div>

                                    <!-- Submit button -->
                                    <button type="submit" id="submitbtn" class="btn btn-lg btn-primary w-100">Buat Profil</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>

{{ view('layouts.footer') }}
