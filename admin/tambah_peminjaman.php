<?php 
session_start();

require '../functions.php';
$id_pegawai = query("SELECT * FROM pegawai");
$id_inventaris = query("SELECT * FROM inventaris");

if( isset($_POST['submit'])) {

 if( pinjam($_POST) > 0 ) {
        echo "<script>
        alert('data berhasil disimpan');
       document.location.href = 'peminjaman.php'
        </script>";
        echo "cek";

    } else {
        echo "<script>
        alert('data gagal disimpan');
       document.location.href = 'peminjaman.php'
        </script>";
    }
}

if (!isset($_SESSION["username"])) {
    header('Location:../index.php');;
  exit;
}

$level=$_SESSION["id_level"];

if ($level!=1) {
    echo "Anda tidak punya akses pada halaman admin";
    exit;
}

$id_petugas=$_SESSION["id_petugas"];
$nama_petugas=$_SESSION["nama_petugas"];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Peminjaman!</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">

    <div class="card mt-5">
  <div class="card-header bg-dark text-white">
    <i><b>Form Input Data Peminjaman</b></i>
  </div>
<div class="card-body">
  <form action="" method="POST">
    <div>
      <label class="ml-2" for="tanggal_pinjam"><i><b>Tanggal Pinjam</b></i></label>
      <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" placeholder="Masukan Tanggal Pinjam" required>
        </div>
       <div>
      <input type="hidden" name="tanggal_kembali" id="tanggal_kembali" class="form-control" placeholder="Masukan Tanggal Kembali">
        </div>
          <div>
          <label class="ml-2" for="status_peminjaman"><i><b>Status Peminjaman</b></i></label>
        <select name="status_peminjaman" class="form-control" id="status_peminjaman">
          <option value="">Pilih Status Peminjaman</option>
          <option value="">Sudah dikembalikan</option>
          <option value="">Belum Dikembalikan</option>
        </select>
        </div>
        <div>
          <label class="ml-2" for="id_pegawai"><i><b>Nama Pegawai</b></i></label>
            <select name="id_pegawai" class="form-control" id="id_pegawai">
              <option value="">Pilih Pegawai</option>
                <?php
                foreach($id_pegawai as $pgw) :
                  ?>
                 <option value="<?php print $pgw['id_pegawai'];?>" ><?php print $pgw['nama_pegawai']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div>
                <label class="ml-2" for="id_inventaris"><i><b>Nama Barang</b></i></label>
                  <select name="id_inventaris" class="form-control" id="id_inventaris">
                    <option value="">Pilih Barang</option>
                      <?php
                      foreach($id_inventaris as $inv) :
                        ?>
                       <option value="<?php print $pgw['id_inventaris'];?>" ><?php print $inv['nama']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
               <div>
                <label class="ml-2" for="jumlah"><i><b>Jumlah</b></i></label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Masukan Jumlah Barang" required>
               </div>
                <div class="mt-5">
                  <button type="submit" name="submit" class=" btn btn-info">Tambah</button>
                  <button type="reset" name="reset" class=" btn btn-danger">Reset</button>
                  <a href="peminjaman.php" class="btn btn-success"><span class="fa fa-arrow-circle-left"></span>Kembali</a>
                </div>

        </form>
      </div>
    </div>


  </div>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>