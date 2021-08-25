<?php 
include '../koneksi.php';

if (isset($_POST['simpan'])) {

  $tanggal_pinjam=$_POST['tanggal_pinjam'];
  $tanggal_kembali=$_POST['tanggal_kembali'];
  $status_peminjaman=$_POST['status_peminjaman'];
  $jumlah=$_POST['jumlah'];

  $s = mysql_query("INSERT into peminjaman (tanggal_pinjam, tanggal_kembali, status_peminjaman) values ('$tanggal_pinjam', '$tanggal_kembali', '$status_peminjaman') ");
  $s .= mysql_query("insert into detail_peminjam (jumlah values ('$jumlah') ");

  if ($s) {
    echo "<script>
    alert('Simpan data sukses');
    document.location='crud.php'
    </script>";
  }
  else
  {
    echo "<script>
    alert('Simpan data gagal');
    document.location='crud.php'
    </script>";
  }


}
 ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Tambah Pegawai</title>
  </head>

  <body>

    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
              Uang Menguang
            </div>
            <div class="card-body">
              <form action="peminjam_simpan.php" method="POST">
                
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" placeholder="Masukkan Nama" class="form-control">
                </div>

                  <div class="form-group">
          <select name="id_pegawai" class="form-control">
            <option value=""> Pilih Peminjam </option>
            <?php
            $query = mysqli_query($kon, "SELECT * from pegawai");
            while($row = mysqli_fetch_array($query)) { ?>
              <option value="<?php print $row['id_pegawai']?>"><?php print $row['nama_pegawai']?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <select name="id_inventaris" class="form-control">
            <option value=""> Pilih Barang </option>
            <?php
            $query = mysqli_query($kon, "SELECT * from inventaris");
            while($row = mysqli_fetch_array($query)) { ?>
              <option value="<?php print $row['id_inventaris']?>"><?php print $row['nama']?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <input type="number" name="jumlah" class="form-control" placeholder="jumlah barang" required>
        </div>
                
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="reset" class="btn btn-warning">Kosongkan</button>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
  </body>
</html>