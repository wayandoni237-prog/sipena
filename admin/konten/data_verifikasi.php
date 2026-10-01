<?php
// notifikasi untuk halaman verifikasi
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == 'verif_ok') {
        echo "<script>Swal.fire({icon:'success', title:'Berhasil', text:'Izin berhasil diverifikasi!'});</script>";
    } elseif ($_GET['pesan'] == 'sudah') {
        echo "<script>Swal.fire({icon:'info', title:'Sudah Diverifikasi', text:'Izin ini sudah pernah diverifikasi sebelumnya.'});</script>";
    } elseif ($_GET['pesan'] == 'gagal') {
        echo "<script>Swal.fire({icon:'error', title:'Gagal', text:'Terjadi kesalahan, coba lagi.'});</script>";
    }
}
?>

<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-3">Data Verifikasi</h1>
        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="index.php?menu=beranda">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data Verifikasi</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-lg-12">
            <div class="card-body">
              <div class="table-responsive">
                <table id="usertabel" class="table table-hover">
                  <thead>
                    <tr class="table table-dark table-hover">
                      <th scope="col">ID Izin</th>
                      <th scope="col">NAMA SISWA</th>
                      <th scope="col">KELAS</th>
                      <th scope="col">JENIS IZIN</th>
                      <th scope="col">TANGGAL</th>
                      <th scope="col">WAKTU</th>
                      <th scope="col">ALASAN</th>
                      <th scope="col">FILE</th>
                      <th scope="col">STATUS</th>
                      <th scope="col">AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Menampilkan SEMUA izin (menunggu, disetujui, ditolak) dalam satu tabel
                    $query = "SELECT i.*, s.nama_siswa, k.nama_kelas, ji.nama_jenis 
                              FROM izin i 
                              LEFT JOIN siswa s ON i.id_siswa = s.id_siswa
                              LEFT JOIN kelas k ON s.id_kelas = k.id_kelas
                              LEFT JOIN jenis_izin ji ON i.id_jenis = ji.id_jenis
                              ORDER BY i.tgl_dibuat DESC";
                    $results = mysqli_query($koneksi, $query);
                    if (mysqli_num_rows($results) == 0):
                    ?>
                      <tr>
                        <td colspan="10" class="text-center text-muted py-4">Belum ada pengajuan izin.</td>
                      </tr>
                    <?php else:
                      while ($row = mysqli_fetch_array($results)):
                    ?>
                        <tr>
                          <th scope="row"><?= $row['id_izin'] ?></th>
                          <td><?= $row['nama_siswa'] ?: '-' ?></td>
                          <td><?= $row['nama_kelas'] ?: '-' ?></td>
                          <td><?= $row['nama_jenis'] ?: '-' ?></td>
                          <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                          <td><?= date('H:i', strtotime($row['waktu_mulai'])) ?> - <?= date('H:i', strtotime($row['waktu_selesai'])) ?></td>
                          <td title="<?= htmlspecialchars($row['alasan']) ?>"><?= (strlen($row['alasan']) > 30 ? substr($row['alasan'], 0, 30) . '...' : $row['alasan']) ?></td>
                          <td>
                            <?php if (!empty($row['file_surat'])): ?>
                              <a href="uploads/<?= $row['file_surat'] ?>" class="btn btn-info btn-sm" target="_blank"><i class="bi bi-file-earmark"></i></a>
                            <?php else: ?>
                              <span class="text-muted">-</span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if ($row['status'] == 'disetujui'): ?>
                              <span class="badge bg-success">Disetujui</span>
                            <?php elseif ($row['status'] == 'ditolak'): ?>
                              <span class="badge bg-danger">Ditolak</span>
                            <?php else: ?>
                              <span class="badge bg-warning text-dark">Menunggu</span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if ($row['status'] == 'menunggu'): ?>
                              <!-- Tombol setuju: langsung kirim keputusan=disetujui, gak lewat modal lagi -->
                              <a href="aksi/aksi_verifikasi.php?id_izin=<?= $row['id_izin'] ?>&keputusan=disetujui"
                                 class="btn btn-success btn-sm"
                                 title="Setujui"
                                 onclick="return confirm('Setujui izin #<?= $row['id_izin'] ?> ini?');">
                                <i class="bi bi-check-lg"></i>
                              </a>
                              <!-- Tombol tolak: langsung kirim keputusan=ditolak -->
                              <a href="aksi/aksi_verifikasi.php?id_izin=<?= $row['id_izin'] ?>&keputusan=ditolak"
                                 class="btn btn-danger btn-sm"
                                 title="Tolak"
                                 onclick="return confirm('Tolak izin #<?= $row['id_izin'] ?> ini?');">
                                <i class="bi bi-x-lg"></i>
                              </a>
                            <?php else: ?>
                              <span class="text-muted">-</span>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endwhile;
                    endif;
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</main>