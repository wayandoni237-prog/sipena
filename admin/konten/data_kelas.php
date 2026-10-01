<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-3">Data Kelas</h1>
        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
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
        data-bs-target="#tambah_kelas">
        + Tambah Kelas
      </button>
      <!--begin::Row-->
      <div class="row">
        <div class="col-lg-12">
          <table id="usertabel" class="table table-hover">
            <thead>
              <tr class="table table-dark table-hover">
                <th scope="col">ID_KELAS</th>
                <th scope="col">NAMA_KELAS</th>
                <th scope="col">JURUSAN</th>
                <th scope="col">TINGKAT</th>
                <th scope="col">WALI_KELAS</th>
                <th scope="col">AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Ambil semua data kelas
              $query_user = "SELECT * FROM kelas";
              $result = mysqli_query($koneksi, $query_user);
              while ($row = mysqli_fetch_array($result)) :
              ?>
                <tr>
                  <th scope="row"><?= $row['id_kelas']; ?></th>
                  <td><?= $row['nama_kelas']; ?></td>
                  <td><?= $row['jurusan']; ?></td>
                  <td><?= $row['tingkat']; ?></td>
                  <td><?= $row['wali_kelas']; ?></td>
                  <td>
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                      data-bs-target="#edit_kelas<?= $row['id_kelas'] ?>">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sn" id="hapus<?= $row['id_kelas'] ?>">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                    <script>
                      // Konfirmasi dulu sebelum hapus data
                      document.getElementById("hapus<?= $row['id_kelas'] ?>").addEventListener("click", function(event) {
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
                            window.location.href = 'aksi/aksi_kelas.php?aksi=hapus&id_kelas=<?= $row['id_kelas'] ?>';
                          };
                        });
                      });
                    </script>

                  </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="edit_kelas<?= $row['id_kelas'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kelas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="aksi/aksi_kelas.php" method="POST">
                          <input type="text" name="aksi" id="edit_aksi" value="edit" hidden>
                          <div class="mb-3">
                            <label for="username" class="form-label">ID Kelas</label>
                            <input type="text" class="form-control" id="id_kelas" value="<?= $row['id_kelas'] ?>" aria-describedby="emailHelp"
                              name="id_kelas" required>
                          </div>
                          <div class="mb-3">
                            <label for="password" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="nama_kelas" value="<?= $row['nama_kelas'] ?>" aria-describedby="emailHelp"
                              name="nama_kelas" required>
                          </div>
                          <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" value="<?= $row['jurusan'] ?>" aria-describedby="emailHelp"
                              name="jurusan" required>
                          </div>
                          <div class="mb-3">
                            <label for="email" class="form-label">Tingkat</label>
                            <input type="text" class="form-control" id="tingkat" value="<?= $row['tingkat'] ?>" aria-describedby="emailHelp" name="tingkat"
                              required>
                          </div>
                          <div class="mb-3">
                            <label for="wali_kelas" class="form-label">Wali Kelas</label>
                            <select class="form-select" id="wali_kelas" name="wali_kelas" required>
                              <option value="">Pilih Wali Kelas</option>
                              <?php
                              // Ambil daftar guru buat pilihan wali kelas
                              $query_guru = "SELECT * FROM users WHERE role = 'guru'";
                              $result_guru = mysqli_query($koneksi, $query_guru);
                              while ($guru = mysqli_fetch_array($result_guru)) :
                              ?>
                                <option value="<?= $guru['nama_lengkap']; ?>"><?= $guru['nama_lengkap']; ?></option>
                              <?php endwhile; ?>
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
<div class="modal fade" id="tambah_kelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/aksi_kelas.php" method="POST">
          <input type="text" name="aksi" id="tambah_aksi" value="tambah" hidden>
          <div class="mb-3">
            <label for="username" class="form-label">ID Kelas</label>
            <input type="text" class="form-control" id="id_kelas" aria-describedby="emailHelp"
              name="id_kelas" required>
          </div>
          <div class="mb-3">
            <label for="text" class="form-label">Nama Kelas</label>
            <input type="text" class="form-control" id="nama_kelas" aria-describedby="emailHelp"
              name="nama_kelas" required>
          </div>
          <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Jurusan</label>
            <input type="text" class="form-control" id="jurusan" aria-describedby="emailHelp"
              name="jurusan" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Tingkat</label>
            <input type="text" class="form-control" id="tingkat" aria-describedby="emailHelp" name="tingkat"
              required>
          </div>
          <div class="mb-3">
            <label for="wali_kelas" class="form-label">Wali Kelas</label>
            <select class="form-select" id="wali_kelas" name="wali_kelas" required>
              <option value="">Pilih Wali Kelas</option>
              <?php
              // Ambil daftar guru buat pilihan wali kelas
              $query_guru = "SELECT * FROM users WHERE role = 'guru'";
              $result_guru = mysqli_query($koneksi, $query_guru);
              while ($guru = mysqli_fetch_array($result_guru)) :
              ?>
                <option value="<?= $guru['nama_lengkap']; ?>"><?= $guru['nama_lengkap']; ?></option>
              <?php endwhile; ?>
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