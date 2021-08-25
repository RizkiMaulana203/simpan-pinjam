<?php 
session_start();
require '../functions.php';

$id = $_GET['id'];

$change = query("SELECT a.*, b.*,c.* FROM inventaris a INNER JOIN jenis b ON a.id_jenis=b.id_jenis INNER JOIN ruang c ON a.id_ruang=c.id_ruang WHERE id_inventaris = $id")[0];

$jenis = query("SELECT * FROM jenis");
$ruang = query("SELECT * FROM ruang");
//$ptgs = query("SELECT * FROM petugas");


if(isset($_POST['submit'])) {
 

 if( change($_POST) > 0 ) {
        echo "<script>
        alert('data berhasil diubah');
        document.location.href = 'inventaris.php'
        </script>";
    } else {
        echo "<script>alert('data gagal ditambahkan')</script>";
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
    <title>Hello World!</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">

    <div class="card mt-5">
  <div class="card-header bg-dark text-white">
    <i><b>Form Edit Data</b></i>
  </div>
  <div class="card-body">
<form action="" method="post">
                             <div class="form-group">
                             <input type="hidden" name="id_inventaris" value="<?= $change['id_inventaris'];?>">
                                 <input type="text" name="nama" id="nama" class="form-control" value="<?= $change['nama']; ?>" placeholder="Nama barang..." required>
                             </div>
                            <div class="form-group">
                               <select name="kondisi" class="form-control" id="kondisi" required>
                                <option value=""><?= $change['kondisi']; ?></option>
                                <option value="Baru">Baru</option>
                                <option value="Bekas">Bekas</option>
                                <option value="Bekas">Bekas Rasa Baru</option>
                               </select>
                            </div>
                            <div class="form-group">
                                <textarea name="Keterangan" class="form-control" id="keterangan" placeholder="Tulis keterangan disini...." cols="30" rows="10" required><?= $change['Keterangan'];?></textarea>
                            </div>
                            <div class="form-group">
                                 <input type="number" value="<?= $change['jumlah']; ?>" name="jumlah" id="nama" class="form-control" placeholder="Jumlah Barang" required>
                             </div>
                            <div class="form-group">
                                 <input type="text-area" value="<?= $change['kode_inventaris']; ?>" name="kode_inventaris" id="kode_inventaris" class="form-control" placeholder="Kode Inventaris" required>
                             </div>
                             <button type="submit" class="btn btn-primary" onclick="return confirm('Data akan diubah,yakin?');" name="submit"><span class="fa fa-floppy-o"></span> Simpan</button>
                            <a href="inventaris.php" class="btn btn-danger"><span class="fa fa-arrow-circle-left"></span> Kembali</a>
                           <br>
                         <p class="text-center"><?php ('Y') ?></p>
                         <br>
                         </form>
  </div>
</div>


</div>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>