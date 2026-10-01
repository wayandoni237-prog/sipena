<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-3">Data User</h1>
        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data User</li>
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
        data-bs-target="#tambah_user">
        + Tambah User
      </button>
      <!--begin::Row-->
      <div class="row">
        <div class="col-lg-12">
          <table id="usertabel" class="table table-hover">
            
            <thead>
              <tr class="table table-dark table-hover">
                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Email</th>
                <th scope="col">No. Hp</th>
                <th scope="col">Role</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Ambil semua data user
              $query_user = "SELECT * FROM users";
              $results = mysqli_query($koneksi, $query_user);
              while ($row = mysqli_fetch_array($results)):

              ?>
                <tr>
                  <th scope="row"><?= $row['id_user'] ?></th>
                  <td><?= $row['username'] ?></td>
                  <td><?= $row['password'] ?></td>
                  <td><?= $row['nama_lengkap'] ?></td>
                  <td><?= $row['email'] ?></td>
                  <td><?= $row['no_hp'] ?></td>
                  <td><?= $row['role'] ?></td>
                  <td>
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                      data-bs-target="#edit_user<?= $row['id_user'] ?>">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sn" id="hapus<?= $row['id_user'] ?>">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                    <script>
                      // Konfirmasi dulu sebelum hapus data user
                      document.getElementById("hapus<?= $row['id_user'] ?>").addEventListener("click", function(event) {
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
                            window.location.href = 'aksi/aksi_user.php?aksi=hapus&id_user=<?= $row['id_user'] ?>';
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="aksi/aksi_user.php" method="POST">
                          <input type="text" name="aksi" id="edit_aksi" value="edit" hidden>
                          <div class="mb-3">
                            <label for="id" class="form-label">ID User</label>
                            <input type="text" class="form-control" id="id" value="<?= $row['id_user']; ?>" aria-describedby="emailHelp"
                              name="id" readonly>
                          </div>
                          <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" value="<?= $row['username']; ?>" aria-describedby="emailHelp"
                              name="username" required>
                          </div>
                          <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" value="<?= $row['password']; ?>" aria-describedby="emailHelp"
                              name="password" required>
                          </div>
                          <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" value="<?= $row['nama_lengkap']; ?>" aria-describedby="emailHelp"
                              name="nama_lengkap" required>
                          </div>
                          <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="<?= $row['email']; ?>" aria-describedby="emailHelp" name="email"
                              required>
                          </div>
                          <div class="mb-3">
                            <label for="number" class="form-label">No. Hp</label>
                            <input type="number" class="form-control" id="no_hp" value="<?= $row['no_hp']; ?>" aria-describedby="emailHelp"
                              name="no_hp" required>
                          </div>

                          <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" aria-label="Default select example" name="role" required>
                              <!-- Role saat ini ditaruh sebagai opsi pertama (disabled), biar keliatan tapi harus pilih ulang kalau mau ganti -->
                              <option value="<?= $row['role']; ?>" <?= $row['role']; ?> disabled>Pilih Role</option>
                              <option value="Admin">Admin</option>
                              <option value="Guru">Guru</option>
                              <option value="Siswa">Siswa</option>
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
<div class="modal fade" id="tambah_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/aksi_user.php" method="POST">
          <input type="text" name="aksi" id="" value="tambah" hidden>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" aria-describedby="emailHelp" name="password"
              required>
          </div>
          <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" aria-describedby="emailHelp" name="nama_lengkap"
              required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required>
          </div>
          <div class="mb-3">
            <label for="no_hp" class="form-label">No. Hp</label>
            <input type="number" class="form-control" id="no_hp" aria-describedby="emailHelp" name="no_hp" required>
          </div>

          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" aria-label="Default select example" name="role" required>
              <option selected disabled>Pilih Role </option>
              <option value="Admin">Admin</option>
              <option value="Guru">Guru</option>
              <option value="Siswa">Siswa</option>
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