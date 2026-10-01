<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-SiPena</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card">
            <div class="card-header alert alert-info text-center">
                LOGIN SISWA
            </div>
 
            <div class="card-body">
                <?php if (isset($_GET['pesan'])): ?>
                    <?php if ($_GET['pesan'] == 'gagal'): ?>
                        <div class="alert alert-danger text-center">
                            NIS atau Password salah!
                        </div>
                    <?php elseif ($_GET['pesan'] == 'belum_login'): ?>
                        <div class="alert alert-warning text-center">
                            Silakan login terlebih dahulu.
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <form action="cek_login.php" method="POST">
                    <div class="mb-3">
                        <label for="nama">NIS</label>
                        <input type="text" name="nis" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Login" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>