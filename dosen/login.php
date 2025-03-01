<?php
require_once 'helper/connection.php';
session_start();
if (isset($_POST['submit'])) {
  $nidn = $_POST['nidn'];
  $nik = $_POST['nik'];

  $sql = "SELECT * FROM dosen WHERE nidn='$nidn' and nik='$nik' LIMIT 1";
  $result = mysqli_query($connection, $sql);

  $row = mysqli_fetch_assoc($result);
  if ($row) {
    $_SESSION['login'] = $row;
    header('Location: index.php');
  } else {
    $_SESSION['info'] = [
      'status' => 'failed',
      'message' => "Harap masukan NIDN & NIK yang benar"
    ];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Portalnya Dosen</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../admin/assets/modules/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="../admin/assets/modules/izitoast/css/iziToast.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="../admin/assets/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <div class="judulku">
                  <img width="90" height="90" src="../assets/image/logos.png" alt="EDWISS">
                  <div class="text-content">
                      <div style="font-size: 14px; font-weight: 600;">INFORMATION EDWISS SCHOOL V1.0</div>
                      <div style="font-size: 10px; font-weight: 400; color: #7e8490;">Education Site With Smart Systems</div>
                  </div>
              </div>
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Login Dosen</h4>
              </div>

              <div class="card-body">
                <form method="POST" action="" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="nidn">NIDN</label>
                    <input id="nidn" type="text" class="form-control" name="nidn" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Mohon isi NIDN anda
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="nik" class="control-label">Password</label>
                    </div>
                    <input id="nik" type="password" class="form-control" name="nik" tabindex="2" required>
                    <div class="invalid-feedback">
                      Mohon isi kata sandi dengan NIK anda
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Ingat Saya</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="3">
                      Login
                    </button>
                  </div>
                </form>

              </div>
            </div>
            <div class="simple-footer">
              Copyright © 2024 Edwiss. All rights reserved.
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../admin/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="../admin/assets/modules/izitoast/js/iziToast.min.js"></script>

  <!-- Page Specific JS File -->
  <?php
  if (isset($_SESSION['info'])) :
    if ($_SESSION['info']['status'] == 'success') {
  ?>
      <script>
        iziToast.success({
          title: 'Sukses',
          message: `<?= $_SESSION['info']['message'] ?>`,
          position: 'topCenter',
          timeout: 5000
        });
      </script>
    <?php
    } else {
    ?>
      <script>
        iziToast.error({
          title: 'Gagal',
          message: `<?= $_SESSION['info']['message'] ?>`,
          timeout: 5000,
          position: 'topCenter'
        });
      </script>
  <?php
    }

    unset($_SESSION['info']);
    $_SESSION['info'] = null;
  endif;
  ?>
  
  <!-- Template JS File -->
  <script src="../admin/assets/js/scripts.js"></script>
  <script src="../admin/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
</body>

</html>