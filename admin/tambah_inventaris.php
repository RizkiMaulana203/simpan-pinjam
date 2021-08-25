<?php 
session_start();

require '../functions.php';

$jenis = query("SELECT * FROM jenis");
$ruang = query("SELECT * FROM ruang");
$ptgs = query("SELECT * FROM petugas");


if(isset($_POST['submit'])) {

 if( inven($_POST) > 0 ) {
        echo "<script>
        alert('data berhasil disimpan');
       document.location.href = 'inventaris.php'
        </script>";
        echo "cek";

    } else {
        echo "<div class='alert alert-warning'>data gagal ditambah</div>";
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
    <title>Tambah Data Inventaris!</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">

    <div class="card mt-5">
  <div class="card-header bg-dark text-white">
    <i><b>Form Input Data</b></i>
  </div>
<div class="card-body">
  <form action="" method="post">
    <div>
      <label class="ml-2"><i><b>Nama Barang</b></i></label>
      <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Barang" required>
        </div>
        <div>
          <label class="ml-2"><i><b>Kondisi</b></i></label>
        <select name="kondisi" class="form-control" id="kondisi">
          <option value="">Pilih Kondisi</option>
          <option value="baru">Baru</option>
          <option value="bekas">Bekas</option>
        </select>
        </div>
          <div>
            <label class="ml-2"><i><b>Keterangan</b></i></label>
           <textarea name="keterangan" class="form-control" id="keterangan" placeholder="Tulis keterangan disini...." cols="30" rows="10" required></textarea>
          </div>
           <div>
            <label class="ml-2"><i><b>Jumlah</b></i></label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Masukan Jumlah Barang" required>
           </div>
              <div>
                <label class="ml-2"><i><b>Jenis</b></i></label>
                <select name="id_jenis" class="form-control" id="id_jenis">
                  <option value="">Pilih Jenis</option>
                    <?php
                    foreach($jenis as $jns) :
                    ?>
                  <option value="<?php print $jns['id_jenis'];?>" ><?php print $jns['nama_jenis']; ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
              <div>
                <label class="ml-2"><i><b>Tanggal Register</b></i></label>
               <input type="date" name="tanggal_register" id="tanggal_register" class="form-control" placeholder="Tanggal Register" required>
              </div>
                <div>
                  <label class="ml-2"><i><b>Ruangan</b></i></label>
                 <select name="id_ruang" class="form-control" id="id_ruang">
                  <option value="">Pilih Ruangan</option>
                  <?php 
                  foreach($ruang as $rng) :
                  ?>
                  <option value="<?php print $rng['id_ruang'];?>" ><?php print $rng['nama_ruang']; ?></option>
                  <?php endforeach; ?>
                 </select>
                </div>
                  <div>
                    <label class="ml-2"><i><b>Kode Inventaris</b></i></label>
                    <input type="text" name="kode_inventaris" id="kode_inventaris" class="form-control" placeholder="Kode Inventaris" required>
                  </div>
                <div>
                  <input type="hidden" name="id_petugas" id="nama" class="form-control" placeholder="Jumlah Barang" required>
                </div>
                <div class="mt-5">
                  <button type="submit" name="submit" class=" btn btn-info"> Tambah</button>
                  <button type="reset" name="submit" class=" btn btn-danger"> Reset</button>
                  <a href="inventaris.php" class="btn btn-success"><span class="fa fa-arrow-circle-left"></span> Kembali</a>
                </div>

        </form>
      </div>
    </div>


  </div>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>