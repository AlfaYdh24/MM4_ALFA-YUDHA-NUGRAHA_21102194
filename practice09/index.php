<?php
include "koneksi.php";

// Query untuk mendapatkan data kelas
$qkelas = "SELECT * FROM kelas";
$data_kelas = $conn->query($qkelas);

// Query untuk mendapatkan data mahasiswa dengan join tabel kelas
$sql_join = "SELECT m.nama_lengkap, m.alamat, k.nama 
             FROM mahasiswa m 
             INNER JOIN kelas k ON m.kelas_id = k.id 
             GROUP BY m.nama_lengkap, m.alamat, k.nama";
$data_join = $conn->query($sql_join);

// Query untuk mendapatkan jumlah mahasiswa
$jumlah = "SELECT COUNT(*) AS jumlah_mahasiswa FROM mahasiswa";
$data_jumlah = $conn->query($jumlah);
$jumlah_mahasiswa = $data_jumlah->fetch_assoc()['jumlah_mahasiswa'];
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.6">
  <title>Form Mahasiswa</title>

  <!-- Bootstrap core CSS -->
  <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="form-validation.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container">
    <div class="py-5 text-center">
      <h2>Form Mahasiswa</h2>
    </div>

    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
 <span class="text-muted">Data Mahasiswa</span>
 <span class="badge badge-secondary badge-pill"><?php echo $jumlah_mahasiswa; ?></span>
 </h4>
        <div>
          
        

          <?php foreach ($data_join as $index => $value) { ?>
            <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                  <h6 class="my-0"><?php echo $value['nama_lengkap'] ?></h6>
                  <small class="text-muted"><?php echo $value['alamat'] ?></small>
                </div>
                <span class="text-muted"><?php echo $value['nama'] ?></span>
              </li>
            </ul>
          <?php } ?>
        </div>
      </div>

      <div class="col-md-8 order-md-1">
        <div>
        <h4 class="mb-3">Input Data</h4>
          <form action="simpan_mahasiswa.php" method="POST">
            <div class="mb-3">
              <label for="nama_lengkap">Nama Lengkap</label>
              <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
            </div>
            <div class="mb-3">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="mb-3">
              <label for="kelas">Kelas</label>
              <select class="custom-select d-block w-100" id="Kelas" name="kelas_id" required>
                <option value=""><p text-align: center;>---Pilih---</p></option>
                <?php foreach ($data_kelas as $index => $value) { ?>
                  <option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?></option>
                <?php } ?>
              </select>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Simpan Data</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2023-2024 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
<!-- Inside the <head> tag of your HTML in index.php -->
<script>
    // Check if the 'success' query parameter is present in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const successParam = urlParams.get('success');

    // Display an alert based on the 'success' parameter
    if (successParam === '1') {
        alert("Data berhasil disimpan!"); // Display success alert
    } else if (successParam === '0') {
        alert("Gagal menyimpan data. Silakan coba lagi."); // Display failure alert
    }
</script>

  <script src="../node_modules/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>
  <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
