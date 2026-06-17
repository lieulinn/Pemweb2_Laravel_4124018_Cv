{{ view('layouts.header') }}

<style>
/* Neo-brutalist Action buttons styling */
.neobrutal-actions-container {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    flex-wrap: wrap;
}

.neobrutal-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 12px;
    font-family: 'Fredoka', 'Comic Neue', sans-serif;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    color: #000000 !important;
    border: 3px solid #000000 !important;
    border-radius: 0px !important; /* Sharp corners / No radius */
    box-shadow: 4px 4px 0px #000000 !important;
    transition: all 0.1s ease-in-out;
    cursor: pointer;
    text-decoration: none !important;
    height: 38px;
    box-sizing: border-box;
    background: none;
    line-height: 1;
}

.neobrutal-action-btn:hover {
    transform: translate(-2px, -2px);
    box-shadow: 6px 6px 0px #000000 !important;
    color: #000000 !important;
    text-decoration: none !important;
}

.neobrutal-action-btn:active {
    transform: translate(2px, 2px);
    box-shadow: 2px 2px 0px #000000 !important;
}

/* Colors for each button type */
.neobrutal-action-btn.btn-view {
    background-color: #38BDF8 !important; /* Sky Blue */
}

.neobrutal-action-btn.btn-edit {
    background-color: #FFDE4D !important; /* Stark Yellow */
}

.neobrutal-action-btn.btn-delete {
    background-color: #FF5C5C !important; /* Stark Red */
}

.neobrutal-action-btn.btn-export {
    background-color: #A78BFA !important; /* Stark Purple */
    gap: 6px;
}

/* Dropdown Container */
.neobrutal-dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Menu styling */
.neobrutal-dropdown-menu {
    display: none;
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    z-index: 1050;
    min-width: 190px;
    background-color: #FFFFFF;
    border: 3px solid #000000;
    border-radius: 0px !important; /* Sharp corners / No radius */
    box-shadow: 5px 5px 0px #000000;
    padding: 0;
    margin: 0;
    overflow: hidden;
    opacity: 0;
    transform: translateY(-10px);
    transition: opacity 0.2s ease, transform 0.2s ease;
}

/* Shown state via class */
.neobrutal-dropdown-menu.show {
    display: block;
    opacity: 1;
    transform: translateY(0);
}

/* Dropdown Items styling */
.neobrutal-dropdown-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    color: #000000 !important;
    font-family: 'Fredoka', 'Comic Neue', sans-serif;
    font-weight: 700;
    font-size: 13px;
    text-decoration: none !important;
    border-bottom: 2px solid #000000;
    transition: background-color 0.1s ease;
    text-align: left;
}

.neobrutal-dropdown-item:last-child {
    border-bottom: none;
}

.neobrutal-dropdown-item:hover {
    background-color: #FFDE4D; /* Highlight yellow on hover */
    color: #000000 !important;
    text-decoration: none !important;
}

.neobrutal-dropdown-item i {
    font-size: 14px;
    width: 16px;
    text-align: center;
}
</style>

<div class="content-wrapper mt-4">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <h1 class="m-0">Kelola Profil Pengguna</h1>
                </div>
                <div class="col-4 text-right text-end">
                    <a href="{{ route('user.profile.create') }}" class="add-btn">
                        <i class="fa fa-user-plus"></i>
                        <br> Tambah Baru
                    </a>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ul class="page-breadcrumb breadcrumb">
                        <li class="breadcrumb-item"><i class="fas fa-angle-right"></i></li>
                        <li class="breadcrumb-item">Beranda</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Profil Pengguna</h3>
                    </div>
                    <div class="card-body">
                        <table id="user_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto Profil</th>
                                    <th>Pekerjaan / Gelar</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp
                                @foreach ($users_data as $user)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>
                                            <img class="profile box-image-preview img-fluid img-circle elevation-2" src="{{ isset($user['personal_info']['image_path']) && !empty($user['personal_info']['image_path']) ? asset('assets/images/'. $user['personal_info']['image_path'])  : asset('assets/images/user-thumb.jpg') }}"
                                            alt="" style="height:40px; width:40px;" />
                                        </td>
                                        <td>{{ $user['personal_info']['profile_title'] }}</td>
                                        <td>{{ $user['personal_info']['first_name'] }}</td>
                                        <td>{{ $user['personal_info']['last_name'] }}</td>
                                        <td>{{ $user['contact_info']['email'] }}</td>
                                        <td align="center">
                                            <div class="neobrutal-actions-container">
                                                <a class="neobrutal-action-btn btn-view"
                                                    href="{{ route('user.profile.view', $user['personal_info']['id']) }}"
                                                    title="Lihat Profil">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="neobrutal-action-btn btn-edit"
                                                    href="{{ route('edit', $user['personal_info']['id']) }}"
                                                    title="Ubah Profil">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('destroy', $user['personal_info']['id']) }}"
                                                    method="post" style="display: inline-block; margin: 0;">
                                                    @csrf
                                                    <button type="button" onclick="confirm_form_delete(this)"
                                                        class="neobrutal-action-btn btn-delete" title="Hapus Profil">
                                                        <i class="fas fa-user-minus"></i>
                                                    </button>
                                                </form>

                                                <!-- Dropdown Cetak / Export -->
                                                <div class="neobrutal-dropdown">
                                                    <button type="button" class="neobrutal-action-btn btn-export neobrutal-dropdown-toggle" title="Cetak / Export Profil">
                                                        <i class="fas fa-print"></i> Cetak
                                                    </button>
                                                     <div class="neobrutal-dropdown-menu">
                                                        {{-- ── PDF Desain ── --}}
                                                        <a class="neobrutal-dropdown-item" href="{{ route('export.pdf', $user['personal_info']['id']) }}">
                                                            <i class="fas fa-file-pdf" style="color: #FF5C5C;"></i> PDF Desain (Bergambar)
                                                        </a>
                                                        {{-- ── PDF ATS ── --}}
                                                        <a class="neobrutal-dropdown-item" href="{{ route('export.ats.pdf', $user['personal_info']['id']) }}">
                                                            <i class="fas fa-file-alt" style="color: #6366F1;"></i> PDF ATS-Friendly
                                                        </a>
                                                        <a class="neobrutal-dropdown-item" href="{{ url('/export/' . $user['personal_info']['id'] . '/docx') }}">
                                                            <i class="fas fa-file-word" style="color: #38BDF8;"></i> Unduh Word (DOCX)
                                                        </a>
                                                        <a class="neobrutal-dropdown-item" href="{{ url('/export/' . $user['personal_info']['id'] . '/png') }}">
                                                            <i class="fas fa-file-image" style="color: #4ADE80;"></i> Unduh Gambar (PNG)
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Foto Profil</th>
                                    <th>Pekerjaan / Gelar</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.neobrutal-dropdown');
    
    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.neobrutal-dropdown-toggle');
        const menu = dropdown.querySelector('.neobrutal-dropdown-menu');
        
        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            
            // Close all other dropdowns
            dropdowns.forEach(otherDropdown => {
                if (otherDropdown !== dropdown) {
                    const otherMenu = otherDropdown.querySelector('.neobrutal-dropdown-menu');
                    closeMenu(otherMenu);
                }
            });
            
            // Toggle the clicked dropdown
            if (menu.classList.contains('show')) {
                closeMenu(menu);
            } else {
                openMenu(menu);
            }
        });
    });
    
    // Close active dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        dropdowns.forEach(dropdown => {
            const menu = dropdown.querySelector('.neobrutal-dropdown-menu');
            if (menu.classList.contains('show') && !dropdown.contains(e.target)) {
                closeMenu(menu);
            }
        });
    });
    
    function openMenu(menu) {
        menu.style.display = 'block';
        // Force reflow to register the starting visual state
        menu.offsetHeight; 
        menu.classList.add('show');
    }
    
    function closeMenu(menu) {
        menu.classList.remove('show');
        // Wait for CSS transition (200ms) to complete before setting display to none
        setTimeout(() => {
            if (!menu.classList.contains('show')) {
                menu.style.display = 'none';
            }
        }, 200);
    }
});
</script>

{{ view('layouts.footer') }}
