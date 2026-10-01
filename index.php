<?php
session_start();
if (!isset($_SESSION['nama_siswa'])) {
    header("Location: login.php?pesan=belum_login");
    exit();
}

include 'koneksi.php';

$id_siswa_login = $_SESSION['id_siswa'];

// Ambil semua data pengajuan izin milik siswa yang login saja
// dipakai untuk tabel dan untuk hitungan kartu info (Ajuan, Menunggu, Diterima, Ditolak).
$query_izin = "SELECT i.*, s.nama_siswa, ji.nama_jenis 
               FROM izin i 
               LEFT JOIN siswa s ON i.id_siswa = s.id_siswa 
               LEFT JOIN jenis_izin ji ON i.id_jenis = ji.id_jenis 
               WHERE i.id_siswa = ?
               ORDER BY i.id_izin ASC";

$stmt = mysqli_prepare($koneksi, $query_izin);
mysqli_stmt_bind_param($stmt, "i", $id_siswa_login);
mysqli_stmt_execute($stmt);
$results   = mysqli_stmt_get_result($stmt);
$data_izin = $results ? mysqli_fetch_all($results, MYSQLI_ASSOC) : [];

$total_ajuan   = count($data_izin);
$total_menunggu = 0;
$total_diterima = 0;
$total_ditolak  = 0;

foreach ($data_izin as $izin) {
    $status = strtolower(trim($izin['status']));
    if ($status === 'menunggu') {
        $total_menunggu++;
    } elseif ($status === 'disetujui' || $status === 'diterima') {
        $total_diterima++;
    } elseif ($status === 'ditolak') {
        $total_ditolak++;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPENA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-sipena" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
                <i class="bi bi-mortarboard-fill"></i> SIPENA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">
                    <li class="nav-item">
                        <a class="nav-link active d-flex align-items-center gap-1" aria-current="page" href="#">
                            <i class="bi bi-house-door-fill"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-1" href="logout.php">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="navbarUserDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center" style="width:28px;height:28px;">
                                <i class="bi bi-person-fill text-white"></i>
                            </span>
                            Sistem Perizinan Siswa
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUserDropdown">
                            <li><span class="dropdown-item-text text-muted"><?= $_SESSION['nama_siswa'] ?></span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <style>
        .navbar-sipena {
            background-color: #16233d;
        }
        .navbar-sipena .nav-link {
            color: #dfe4ea;
            border-radius: 50rem;
            padding: 0.4rem 1rem;
        }
        .navbar-sipena .nav-link:hover {
            color: #ffffff;
        }
        .navbar-sipena .nav-link.active {
            background-color: #2f6fed;
            color: #ffffff;
        }
    </style>

    <!-- Header Start -->
    <div class="container mt-5 mb-4">
        <header class="alert alert-dark p-5" role="alert">
            <h1 class="fw-bold">Selamat Datang, <?= $_SESSION['nama_siswa'] ?></h1>

            <h4>SMK PARIWISATA TRIATMAJAYA BADUNG</h4>
        </header>
    </div>
    <!-- Header End -->

    <!-- Info Start -->
    <div class="container mb-4">
        <div class="row g-3">
            <div class="col-md-3 col-sm-6">
                <div class="alert alert-info p-4 text-center mb-0 h-100">
                    <h1 class="fw-bold"><?= $total_ajuan ?></h1>
                    <h6 class="mb-0">Ajuan</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="alert alert-warning p-4 text-center mb-0 h-100">
                    <h1 class="fw-bold"><?= $total_menunggu ?></h1>
                    <h6 class="mb-0">Menunggu</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="alert alert-success p-4 text-center mb-0 h-100">
                    <h1 class="fw-bold"><?= $total_diterima ?></h1>
                    <h6 class="mb-0">Diterima</h6>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="alert alert-danger p-4 text-center mb-0 h-100">
                    <h1 class="fw-bold"><?= $total_ditolak ?></h1>
                    <h6 class="mb-0">Ditolak</h6>
                </div>
            </div>
        </div>
    </div>
    <!-- Info End -->

    <!-- Section Main Content -->
    <div class="container mb-5">
        <div class="row">
            <!-- Form Pengajuan Izin (Kolom Kiri) -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white fw-bold">
                        + Pengajuan Izin
                    </div>
                    <div class="card-body">
                        <form action="aksi_siswa/aksi_izin_siswa.php" method="POST" enctype="multipart/form-data">

                            <input type="text" name="aksi" id="" value="tambah" hidden>

                            <div class="mb-3">
                                <label for="id_jenis" class="form-label">Jenis Izin</label>
                                <select id="id_jenis" name="id_jenis" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Jenis Izin --</option>
                                    <?php
                                    $query_jenis  = "SELECT id_jenis, nama_jenis FROM jenis_izin ORDER BY nama_jenis ASC";
                                    $result_jenis = mysqli_query($koneksi, $query_jenis);
                                    while ($row_jenis = mysqli_fetch_array($result_jenis)):
                                    ?>
                                        <option value="<?= $row_jenis['id_jenis'] ?>"><?= $row_jenis['nama_jenis'] ?></option>
                                    <?php
                                    endwhile;
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal Mulai Izin</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="mb-3">
                                <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" required>
                            </div>
                            <div class="mb-3">
                                <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                                <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" required>
                            </div>
                            <div class="mb-3">
                                <label for="alasan" class="form-label">Alasan</label>
                                <textarea class="form-control" name="alasan" id="alasan" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="file" class="form-label">File Surat</label>
                                <input type="file" class="form-control" id="file" name="file_surat" required>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-success w-100" type="submit">Ajukan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabel Pengajuan (Kolom Kanan) -->
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-dark text-white fw-bold">
                        Tabel Pengajuan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Jenis Izin</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Alasan</th>
                                        <th scope="col">File</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tgl. Dibuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_izin as $row): ?>
                                        <?php
                                        $status_lower = strtolower(trim($row['status']));
                                        $badge_class  = 'text-bg-secondary';
                                        if ($status_lower === 'menunggu') {
                                            $badge_class = 'text-bg-warning';
                                        } elseif ($status_lower === 'disetujui' || $status_lower === 'diterima') {
                                            $badge_class = 'text-bg-success';
                                        } elseif ($status_lower === 'ditolak') {
                                            $badge_class = 'text-bg-danger';
                                        }
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $row['id_izin'] ?></th>
                                            <td><?= $row['nama_jenis'] ?></td>
                                            <td><?= $row['tanggal'] ?></td>
                                            <td><?= $row['alasan'] ?></td>
                                            <td>
                                                <?php if (!empty($row['file_surat'])): ?>
                                                    <a href="admin/uploads/<?= $row['file_surat'] ?>" target="_blank" class="badge text-bg-info text-decoration-none" title="<?= $row['file_surat'] ?>">
                                                        <i class="bi bi-file-earmark"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><span class="badge <?= $badge_class ?>"><?= $row['status'] ?></span></td>
                                            <td><?= $row['tgl_dibuat'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Section End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>