<?php
session_start();

if (!isset($_SESSION["username"])) {
  echo "Anda harus login dulu <br><a href='../index.php'>Klik disini</a>";
  exit;
}

$level=$_SESSION["id_level"];

if ($level!=1) {
    echo "Anda tidak punya akses pada halaman ";
    exit;
}

$id_petugas=$_SESSION["id_petugas"];
$username=$_SESSION["username"];
$nama_petugas=$_SESSION["nama_petugas"];

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
    <link rel="stylesheet" type="text/css" href="../assets/font/css/all.min.css">

    <title></title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-info fixed-top">
  <a class="navbar-brand" href="#"><b><i>Admin</i></b></a>
  
    <form class="form-inline my-2 my-lg-0 ml-auto">
      <input class="form-control mr-sm-2" type="search" placeholder="Cari" aria-label="Search">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Cari</button>
    </form>

<div class="icon ml-2">
    <h5>
        <a href="../logout.php" class="fas fa-sign-out-alt" style="color: black;"s data-toggle="tooltip" title="Keluar"></a>
    </h5>
</div>
  </div>
</nav>

<div class="row no-gutters mt-5" style="height: 850px;">
    <div class="col-md-2 bg-dark mt-2 pr-3 pt-3">
        <ul class="nav flex-column ml-3 mb-5">
  <li class="nav-item">
    <a class="nav-link active text-white" href="dashboard.php"><i>Dashboard</i></a> <hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="anggota.php"><i>Daftar Anggota</i></a> <hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="peminjaman.php"><i>Peminjaman Pengembalian</i></a> <hr class="bg-secondary">
  </li>
  <li class="nav-item">
    <a class="nav-link text-white" href="inventaris.php"><i>Inventaris</i></a>
  </li>
</ul>
    </div>
    <div class="col-md-10 pt-5 p-5">
        <h2><i><b>Daftar Peminjaman & Pengembalian</b></i></h2><hr>

        <a href="tambah_peminjaman.php" class="btn btn-info mb-3"><i class="fas fa-hand-holding-usd mr-2"></i>Tambah Data Peminjam</a>
        <table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Tanggal Pinjam</th>
      <th scope="col">Status Peminjaman</th>
      <th scope="col">Jumlah</th>
      <th colspan="5" scope="col" class="text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
   <?php 
    include '../koneksi.php';
    $no = 1;
  $query = "SELECT * FROM peminjaman
            INNER JOIN pegawai ON peminjaman.id_pegawai = pegawai.id_pegawai
            INNER JOIN inventaris ON peminjaman.id_inventaris = inventaris.id_inventaris
            ";
  $sql = mysqli_query($kon, $query) or die (mysqli_error($kon));
  while ($data = mysqli_fetch_array($sql)){
      ?>
      <tr>
        
        <td scope="row"><?php echo $no++; ?></td>
        <td><?php echo $data['nama_pegawai']; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td><?php echo $data['tanggal_pinjam']; ?></td>
       <!-- <td><?php echo $data['tanggal_kembali']; ?></td>-->
        <td><?php echo $data['status_peminjaman']; ?></td>
        <td><?php echo $data['jumlah']; ?></td>
      <!--<td><a href="edit-pinjam.php?id=<?= $data['id_peminjaman']; ?>" class="far fa-edit bg-info p-2 text-white rounded" data-toggle="tooltip" title="Edit"></a></td> --> 
      <td class="text-center"><a href="hapus_peminjaman.php?id=<?= $data['id_peminjaman']; ?>" class="far fa-trash-alt bg-danger p-2 text-white rounded" data-toggle="tooltip" title="Hapus"></a></td>
        </td>
      </tr>
      <?php 
    }
    ?>
    
  </tbody>
</table>

    </div>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../assets/js/admin.js"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>