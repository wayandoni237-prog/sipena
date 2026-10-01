<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-3">Data Izin</h1>
        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data Izin</li>
            </ol>
          </nav>
        </div>
      </div>
      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content Header-->
  <!--begin::App Content-->
  <div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
      <!-- tombol buat munculin modal tambah izin -->
      <button type="button" class="btn btn-outline-success mb-4 btn-lg" data-bs-toggle="modal"
        data-bs-target="#tambah_izin">
        + Tambah Izin
      </button>
      <!--begin::Row-->
      <div class="row">
        <div class="col-lg-12">
          <table id="usertabel" class="table table-hover">

            <thead>
              <tr class="table table-dark table-hover">
                <th scope="col">ID Izin</th>
                <th scope="col">NAMA SISWA</th>
                <th scope="col">JENIS IZIN</th>
                <th scope="col">TANGGAL</th>
                <th scope="col">FILE</th>
                <th scope="col">STATUS</th>
                <th scope="col">TGL DIBUAT</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // ambil data izin, terus dijoin ke tabel siswa (buat nama siswa&tbl jnis izin)
              // pake LEFT JOIN biar tetep muncul walaupun id_siswa/id_jenis-nya kosong/null
              $query_user = "SELECT i.*, s.nama_siswa, ji.nama_jenis FROM izin i 
              LEFT JOIN siswa s ON i .id_siswa = s.id_siswa
              LEFT JOIN jenis_izin ji ON i.id_jenis = ji.id_jenis";
              $results = mysqli_query($koneksi, $query_user);
              while ($row = mysqli_fetch_array($results)):

              ?>
                <tr>
                  <th scope="row"><?= $row['id_izin'] ?></th>
                  <td><?= $row['nama_siswa'] ?></td>
                  <td><?= $row['nama_jenis'] ?></td>
                  <td><?= $row['tanggal'] ?></td>
                  <td>
                    <!-- tombol buka file surat izin di tab baru -->
                    <a href="uploads/<?= $row['file_surat'] ?>"
                      class="btn btn-info btn-sm" target="_blank"><i class="bi bi-file-earmark"></i></a>
                  </td>
                  <td><?= $row['status'] ?></td>
                  <td><?= $row['tgl_dibuat'] ?></td>
                  <td>
                    <!-- tombol edit, buka modal edit sesuai id_izin baris ini -->
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                      data-bs-target="#edit_izin<?= $row['id_izin'] ?>">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <!-- tombol hapus, id-nya dibikin unik per baris pake id_izin -->
                    <button type="button" class="btn btn-danger btn-sn" id="hapus<?= $row['id_izin'] ?>">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                    <script>
                      <!-- pas tombol hapus diklik, munculin konfirmasi sweetalert dulu-->
                      document.getElementById("hapus<?= $row['id_izin'] ?>").addEventListener("click", function(event) {
                        event.preventDefault();
                        Swal.fire({
                          title: "Are you sure?",
                          text: "You won't be able to revert this!",
                          icon: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#3085d6",
                          cancelButtonColor: "#d33",
                          confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                          if (result.isConfirmed) {
                            window.location.href = 'aksi/aksi_izin.php?aksi=hapus&id_izin=<?= $row['id_izin'] ?>';
                          };
                        });
                      });
                    </script>

                  </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="edit_izin<?= $row['id_izin'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Izin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="aksi/aksi_izin.php" method="POST" enctype="multipart/form-data">
                          <input type="hidden" name="aksi" value="edit">
                          <input type="hidden" name="id_izin" value="<?= $row['id_izin'] ?>">

                          <div class="mb-3">
                            <label for="edit_siswa<?= $row['id_izin'] ?>" class="form-label">Nama Siswa</label>
                            <select name="id_siswa" id="edit_siswa<?= $row['id_izin'] ?>" class="form-select" required>
                              <?php
                              // query terpisah buat isi dropdown siswa
                              // yang valuenya sama kaya id_siswa punya baris ini langsung di-selected
                              $query_s  = "SELECT id_siswa, nama_siswa FROM siswa ORDER BY nama_siswa ASC";
                              $result_s = mysqli_query($koneksi, $query_s);
                              while ($row_s = mysqli_fetch_array($result_s)) :
                              ?>
                                <option value="<?= $row_s['id_siswa'] ?>" <?= ($row_s['id_siswa'] == $row['id_siswa']) ? 'selected' : '' ?>>
                                  <?= $row_s['nama_siswa'] ?>
                                </option>
                              <?php endwhile; ?>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label for="edit_jenis<?= $row['id_izin'] ?>" class="form-label">Jenis Izin</label>
                            <select name="id_jenis" id="edit_jenis<?= $row['id_izin'] ?>" class="form-select" required>
                              <?php
                              // sama kaya dropdown siswa di atas, cuma ini buat jenis izin
                              $query_j  = "SELECT id_jenis, nama_jenis FROM jenis_izin ORDER BY nama_jenis ASC";
                              $result_j = mysqli_query($koneksi, $query_j);
                              while ($row_j = mysqli_fetch_array($result_j)) :
                              ?>
                                <option value="<?= $row_j['id_jenis'] ?>" <?= ($row_j['id_jenis'] == $row['id_jenis']) ? 'selected' : '' ?>>
                                  <?= $row_j['nama_jenis'] ?>
                                </option>
                              <?php endwhile; ?>
                            </select>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" required value="<?= $row['tanggal'] ?>">
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Waktu Mulai</label>
                            <input type="time" class="form-control" name="waktu_mulai" required value="<?= $row['waktu_mulai'] ?>">
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Waktu Selesai</label>
                            <input type="time" class="form-control" name="waktu_selesai" required value="<?= $row['waktu_selesai'] ?>">
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Alasan</label>
                            <textarea class="form-control" rows="3" name="alasan" required><?= $row['alasan'] ?></textarea>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">File Surat</label>
                            <input type="file" class="form-control" name="file_surat">
                            <!-- file gak wajib diisi ulang, kalo dikosongin berarti pake file lama -->
                            <?php if (!empty($row['file_surat'])): ?>
                              <small class="text-muted d-block mt-1">File saat ini: <strong><?= $row['file_surat'] ?></strong> (Kosongkan jika tidak ingin mengubah file)</small>
                            <?php endif; ?>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                              <option value="menunggu" <?= ($row['status'] == 'menunggu') ? 'selected' : '' ?>>Menunggu</option>
                              <option value="disetujui" <?= ($row['status'] == 'disetujui') ? 'selected' : '' ?>>Disetujui</option>
                              <option value="ditolak" <?= ($row['status'] == 'ditolak') ? 'selected' : '' ?>>Ditolak</option>
                            </select>
                          </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              endwhile;
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <!--end::Row-->
      <!--begin::Row-->

      <!-- /.row (main row) -->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content-->
</main>

<!-- Modal Tambah -->
<div class="modal fade" id="tambah_izin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Izin</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/aksi_izin.php" method="POST" enctype="multipart/form-data">

          <input type="text" name="aksi" id="" value="tambah" hidden>

          <div class="mb-3">
            <label for="username" class="form-label">Nama Siswa</label>
            <select class="form-select" aria-label="Default select example" name="id_siswa" required>
              <option selected disabled value="">Pilih Siswa</option>
              <?php
              // isi dropdown siswa buat form tambah izin
              $query = "SELECT id_siswa, nama_siswa FROM siswa";
              $result_siswa = mysqli_query($koneksi, $query);
              while ($row = mysqli_fetch_array($result_siswa)):
              ?>
                <option value="<?= $row['id_siswa'] ?>"><?= $row['nama_siswa'] ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="jenis_izin" class="form-label">Jenis Izin</label>
            <select class="form-select" aria-label="Default select example" name="id_jenis" required>
              <option selected disabled value="">Pilih Jenis Izin</option>
              <?php
              // isi dropdown jenis izin buat form tambah izin
              $query = "SELECT id_jenis, nama_jenis FROM jenis_izin";
              $result_jenis = mysqli_query($koneksi, $query);
              while ($row = mysqli_fetch_array($result_jenis)):
              ?>
                <option value="<?= $row['id_jenis'] ?>"><?= $row['nama_jenis'] ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
              <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
              <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="alasan" class="form-label">Alasan</label>
            <textarea class="form-control" id="alasan" name="alasan" rows="3" required></textarea>
          </div>

          <div class="mb-3"> n
            <label for="file_surat" class="form-label">File Surat</label>
            <input type="file" class="form-control" id="file_surat" name="file_surat">
          </div>

          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" aria-label="Default select example" name="status" required>
              <option selected disabled value="">Pilih Status</option>
              <option value="Pending">Menunggu</option>
              <option value="Disetujui">Disetujui</option>
              <option value="Ditolak">Ditolak</option>
            </select>
          </div>

          <!-- tgl_dibuat otomatis diisi tanggal saat ini, tidak perlu diinput manual -->
          <input type="hidden" name="tgl_dibuat" value="<?= date('Y-m-d H:i:s') ?>">

          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>