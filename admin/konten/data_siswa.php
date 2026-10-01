<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-3">Data Siswa</h1>
        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
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
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-outline-success mb-4 btn-lg" data-bs-toggle="modal"
        data-bs-target="#tambah_siswa">
        + Tambah Siswa
      </button>
      <!--begin::Row-->
      <div class="row">
        <div class="col-lg-12">
          <table id="usertabel" class="table table-hover">
            <thead>
              <tr class="table table-dark table-hover">
                <th scope="col">ID_SISWA</th>
                <th scope="col">ID_USER</th>
                <th scope="col">NIS</th>
                <th scope="col">NAMA_SISWA</th>
                <th scope="col">Nama KELAS</th>
                <th scope="col">TGL_LAHIR</th>
                <th scope="col">JENIS_KELAMIN</th>
                <th scope="col">ALAMAT</th>
                <th scope="col">NO_HP</th>
                <th scope="col">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Ambil data siswa, join ke kelas biar nama_kelas ikut tampil (bukan cuma id_kelas)
              $query_user = "SELECT s.*,k.nama_kelas FROM siswa s LEFT JOIN kelas k ON s.id_kelas = k.id_kelas";
              $result = mysqli_query($koneksi, $query_user);
              while ($row = mysqli_fetch_array($result)) :
              ?>
                <tr>
                  <th scope="row"><?= $row['id_siswa']; ?></th>
                  <td><?= $row['id_user']; ?></td>
                  <td><?= $row['nis']; ?></td>
                  <td><?= $row['nama_siswa']; ?></td>
                  <td><?= $row['nama_kelas']; ?></td>
                  <td><?= $row['tgl_lahir']; ?></td>
                  <td><?= $row['jenis_kelamin']; ?></td>
                  <td><?= $row['alamat']; ?></td>
                  <td><?= $row['no_hp']; ?></td>
                  <td>
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                      data-bs-target="#edit_user<?= $row['id_user'] ?>">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sn" id="hapus<?= $row['id_siswa'] ?>">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                    <script>
                      // Konfirmasi dulu sebelum hapus data siswa
                      document.getElementById("hapus<?= $row['id_siswa'] ?>").addEventListener("click", function(event) {
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
                            window.location.href = 'aksi/aksi_siswa.php?aksi=hapus&id_siswa=<?= $row['id_siswa'] ?>';
                          };
                        });
                      });
                    </script>

                  </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="edit_user<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Siswa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="aksi/aksi_siswa.php" method="POST">
                          <input type="text" name="aksi" id="" value="edit" hidden>
                          <div class="mb-3">
                            <label for="id_siswa" class="form-label">ID Siswa</label>
                            <input type="text" class="form-control" id="id_siswa" value="<?= $row['id_siswa'] ?>" aria-describedby="emailHelp"
                              name="id_siswa" required>
                          </div>
                          <div class="mb-3">
                            <label for="id_user" class="form-label">ID user</label>
                            <input type="text" class="form-control" id="id_user" value="<?= $row['id_user'] ?>" aria-describedby="emailHelp"
                              name="id_user" required>
                          </div>
                          <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" value="<?= $row['nis'] ?>" aria-describedby="emailHelp"
                              name="nis" required>
                          </div>
                          <div class="mb-3">
                            <label for="nama_siswa" class="form-label">Nama_siswa</label>
                            <input type="text" class="form-control" id="nama_siswa" value="<?= $row['nama_siswa'] ?>" aria-describedby="emailHelp" name="nama_siswa"
                              required>
                          </div>
                          <div class="mb-3">
                            <label for="id_kelas" class="form-label">Kelas</label>
                            <select name="id_kelas" class="form-select" required>
                              <option value="" disabled>Pilih Kelas</option>

                              <?php
                              // List kelas buat dropdown, kelas siswa yg sekarang otomatis ke-select
                              $query_kelas = "SELECT * FROM kelas";
                              $result_kelas = mysqli_query($koneksi, $query_kelas);

                              while ($row_kelas = mysqli_fetch_array($result_kelas)):
                              ?>

                                <option value="<?= $row_kelas['id_kelas'] ?>"
                                  <?= ($row_kelas['id_kelas'] == $row['id_kelas']) ? 'selected' : '' ?>>
                                  <?= $row_kelas['nama_kelas'] ?>
                                </option>

                              <?php endwhile; ?>
                            </select>
                            <div class="mb-3">
                              <label for="tgl_lahir" class="form-label">Tgl Lahir</label>
                              <input type="date" class="form-control" id="tgl_lahir" value="<?= $row['tgl_lahir'] ?>" aria-describedby="emailHelp"
                                name="tgl_lahir" required>
                            </div>
                            <div class="mb-3">
                              <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                              <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L" <?= ($row['jenis_kelamin'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= ($row['jenis_kelamin'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label for="alamat" class="form-label">Alamat</label>
                              <input type="text" class="form-control" id="alamat" value="<?= $row['alamat'] ?>" aria-describedby="emailHelp"
                                name="alamat" required>
                            </div>
                            <div class="mb-3">
                              <label for="no_hp" class="form-label">No. Hp</label>
                              <input type="number" class="form-control" id="no_hp" value="<?= $row['no_hp'] ?>" aria-describedby="emailHelp"
                                name="no_hp" required>
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
<div class="modal fade" id="tambah_siswa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/aksi_siswa.php" method="POST">
          <input type="text" name="aksi" id="" value="tambah" hidden>

          <div class="mb-3">
            <label for="id_user" class="form-label">ID user</label>
            <select name="id_user" class="form-select">
              <option disabled>ID user</option>
              <?php
              // Cuma tampilin akun yang rolenya siswa & belum ada data siswanya (dipilih pas tambah)
              $query_user  = "SELECT * FROM users WHERE role='siswa'";
              $result_user = mysqli_query($koneksi, $query_user);
              while ($row_user = mysqli_fetch_array($result_user)):
              ?>
                <option value="<?= $row_user['id_user'] ?>"><?= $row_user['username'] ?></option>
              <?php
              endwhile;
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" class="form-control" id="nis" aria-describedby="emailHelp"
              name="nis" required>
          </div>
          <div class="mb-3">
            <label for="nama_siswa" class="form-label">Nama_siswa</label>
            <input type="text" class="form-control" id="nama_siswa" aria-describedby="emailHelp" name="nama_siswa"
              required>
          </div>
          <div class="mb-3">
            <label for="id_kelas" class="form-label">Kelas</label>
            <select name="id_kelas" class="form-select">
              <option selected disabled>Pilih Kelas</option>
              <?php
              // List kelas buat dropdown
              $query_kelas  = "SELECT * FROM kelas";
              $result_kelas = mysqli_query($koneksi, $query_kelas);
              while ($row_kelas = mysqli_fetch_array($result_kelas)):
              ?>
                <option value="<?= $row_kelas['id_kelas'] ?>"><?= $row_kelas['nama_kelas'] ?></option>
              <?php
              endwhile;
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="tgl_lahir" class="form-label">Tgl Lahir</label>
            <input type="date" class="form-control" id="tgl_lahir" aria-describedby="emailHelp"
              name="tgl_lahir" required>
          </div>
          <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
              <option value="">-- Pilih Jenis Kelamin --</option>
              <option value="L">Laki-laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" aria-describedby="emailHelp"
              name="alamat" required>
          </div>
          <div class="mb-3">
            <label for="no_hp" class="form-label">No. Hp</label>
            <input type="number" class="form-control" id="no_hp" aria-describedby="emailHelp"
              name="no_hp" required>
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