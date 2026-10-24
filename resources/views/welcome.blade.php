<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Planner - Praktikum</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #faf9f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #ffffff;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
        }
        .sidebar-logo {
            padding: 25px 20px;
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 15px;
        }
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }
        .sidebar-menu li {
            margin-bottom: 5px;
        }
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #555;
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        .sidebar-menu a i {
            margin-right: 15px;
            font-size: 1.1rem;
        }
        .sidebar-menu a:hover {
            background-color: #f8f9fa;
        }
        /* Active Menu State */
        .sidebar-menu a.active {
            color: #d32f2f;
            background-color: #fef0f0;
            border-right: 3px solid #d32f2f;
            font-weight: 600;
        }
        /* Main Content Styling */
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .page-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }
        /* Card Form Styling */
        .form-card {
            background-color: #fffdf9;
            border: 1px solid #e8e6e1;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
        }
        .form-label {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 5px;
        }
        .form-control, .form-select {
            background-color: #fcfcfc;
            border: 1px solid #ccc;
            font-size: 0.95rem;
        }
        .btn-unggah {
            background-color: #d32f2f;
            color: white;
            font-weight: 500;
            padding: 8px 24px;
            border: none;
            border-radius: 4px;
        }
        .btn-unggah:hover {
            background-color: #b71c1c;
            color: white;
        }
        .btn-batal {
            background-color: white;
            color: #333;
            border: 1px solid #ccc;
            font-weight: 500;
            padding: 8px 24px;
            border-radius: 4px;
            margin-left: 10px;
        }
        .btn-batal:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

    <!-- Sidebar (Disederhanakan & Tanpa Profil) -->
    <div class="sidebar shadow-sm">
        <div class="sidebar-logo">
            <i class="bi bi-lightning-charge-fill text-danger"></i> Content Planner
            <div class="text-muted" style="font-size: 0.8rem; font-weight: normal; margin-top: 4px;">Manajemen Jadwal ID</div>
        </div>
        
        <ul class="sidebar-menu">
            <li><a href="#" class="active"><i class="bi bi-bookmark"></i> Jadwal Konten</a></li>
            <li><a href="#"><i class="bi bi-camera-video"></i> Daftar Platform</a></li>
            <li><a href="#"><i class="bi bi-bar-chart"></i> Statistik</a></li>
            <li><a href="#"><i class="bi bi-gear"></i> Pengaturan</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-title">Jadwal Konten Saya</div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Form Card -->
        <div class="form-card shadow-sm">
            <h6 class="mb-4 fw-bold"><i class="bi bi-camera"></i> Tambah Rencana Konten Baru</h6>
            
            <form action="{{ route('store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul Konten</label>
                    <input type="text" name="judul_konten" class="form-control" placeholder="Masukkan judul draft atau konten..." required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Platform (SKU / Kategori)</label>
                    <select name="platform" class="form-select" required>
                        <option value="" disabled selected>— pilih platform —</option>
                        <option value="TikTok">TikTok</option>
                        <option value="Instagram">Instagram</option>
                        <option value="YouTube">YouTube</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Posting (Jadwal Tayang)</label>
                    <input type="date" name="tanggal_posting" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Status Draft</label>
                    <select name="status" class="form-select" required>
                        <option value="Draft" selected>Draft</option>
                        <option value="Review">Review</option>
                        <option value="Published">Published</option>
                    </select>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-unggah">Unggah</button>
                    <button type="reset" class="btn btn-batal">Batal</button>
                </div>
            </form>
        </div>

        <!-- Tabel Data -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Daftar Konten Saya</h6>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Judul Konten</th>
                                <th>Platform</th>
                                <th>Tanggal Posting</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($plans as $index => $plan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-medium">{{ $plan->judul_konten }}</td>
                                <td><span class="badge bg-secondary">{{ $plan->platform }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($plan->tanggal_posting)->format('d M Y') }}</td>
                                <td>
                                    @if($plan->status == 'Published')
                                        <span class="badge bg-success">Published</span>
                                    @elseif($plan->status == 'Review')
                                        <span class="badge bg-warning text-dark">Review</span>
                                    @else
                                        <span class="badge bg-light text-dark border">Draft</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada draft konten yang diunggah.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>