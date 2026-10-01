<main class="app-main">
  <!--begin::App Content Header-->
  <div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6">
          <h1 class="mb-0 fs-3">Data Jenis Izin</h1>
        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data Jenis Izin</li>
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
        data-bs-target="#tambah_jenis_izin">
        + Tambah Jenis Izin
      </button>
      <!--begin::Row-->
      <div class="row">
        <div class="col-lg-12">
          <table id="usertabel" class="table table-hover">
            <thead>
              <tr class="table table-dark table-hover">
                <th scope="col">ID Jenis Izin</th>
                <th scope="col">Nama Jenis Izin</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Ambil semua data jenis izin untuk ditampilkan di tabel
              $query_user = "SELECT * FROM jenis_izin";
              $results = mysqli_query($koneksi, $query_user);
              while ($row = mysqli_fetch_array($results)):

              ?>
                <tr>
                  <th scope="row"><?= $row['id_jenis'] ?></th>
                  <td><?= $row['nama_jenis'] ?></td>
                  <td><?= $row['deskripsi'] ?></td>
                  <td>
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                      data-bs-target="#edit_jenis_izin<?= $row['id_jenis'] ?>">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sn" id="hapus<?= $row['id_jenis'] ?>">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                    <script>
                      // Konfirmasi dulu sebelum hapus data
                      document.getElementById("hapus<?= $row['id_jenis'] ?>").addEventListener("click", function(event) {
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
                            window.location.href = 'aksi/aksi_jenis_izin.php?aksi=hapus&id_jenis=<?= $row['id_jenis'] ?>';
                          };
                        });
                      });
                    </script>
                  </td>
                </tr>
                <!-- Modal Edit -->
                <div class="modal fade" id="edit_jenis_izin<?= $row['id_jenis'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Jenis Izin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="aksi/aksi_jenis_izin.php" method="POST">
                          <input type="text" name="aksi" id="edit_aksi" value="edit" hidden>
                          <div class="mb-3">
                            <label for="id_jenis_izin" class="form-label">ID Jenis Izin</label>
                            <input value="<?= $row['id_jenis'] ?>" type="text" class="form-control" id="jenis_izin" aria-describedby="emailHelp"
                              name="id_jenis_izin" readonly>
                          </div>
                          <div class="mb-3">
                            <label for="nama_jenis_izin" class="form-label">Nama Jenis Izin</label>
                            <input value="<?= $row['nama_jenis'] ?>" type="text" class="form-control" id="nama_jenis_izin" aria-describedby="emailHelp"
                              name="nama_jenis_izin" required>
                          </div>
                          <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input value="<?= $row['deskripsi'] ?>" type="text" class="form-control" id="deskripsi" aria-describedby="emailHelp"
                              name="deskripsi" required>
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
<div class="modal fade" id="tambah_jenis_izin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jenis Izin</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="aksi/aksi_jenis_izin.php" method="POST">
          <input type="text" name="aksi" id="" value="tambah" hidden>
          <div class="mb-3">
            <label for="nama_jenis_izin" class="form-label">Nama Jenis Izin</label>
            <input type="text" class="form-control" id="nama_jenis_izin" aria-describedby="emailHelp"
              name="nama_jenis_izin" required>
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" aria-describedby="emailHelp"
              name="deskripsi" required>
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