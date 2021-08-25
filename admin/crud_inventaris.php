<?php

$server = "localhost";
$user = "root";
$pass = "";
$database = "dbkoperasi";

$kon = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($kon));

if(isset($_POST['bsimpan']))
{
if($_GET['hal'] == "edit")
{
        $edit = mysqli_query($kon, "UPDATE inventaris set
            nama = '$_POST[tnama]',
            kondisi = '$_POST[tkondisi]',
            Keterangan = '$_POST[tKeterangan]',
            jumlah = '$_POST[tjumlah]',
            id_jenis = '$_POST[tid_jenis]',
            tanggal_register = '$_POST[ttanggal_register]',
            id_ruang = '$_POST[tid_ruang]',
            kode_inventaris = '$_POST[tkode_inventaris]',
            WHERE id_inventaris = '$_GET[id]'
            ");
          if($edit)
          {
            echo "<script>
            alert('Edit data sukses');
            document.location='inventarisir.php'
            </script>";
          }
          else
          {
            echo "<script>
            alert('Edit data gagal');
            document.location='inventarisir.php'
            </script>";
          }
}
else
{
  $simpan = mysqli_query($kon, "INSERT INTO inventaris (nama, kondisi, Keterangan, jumlah, id_jenis, tanggal_register, id_ruang, kode_inventaris)
  

    VALUES ('$_POST[tnama]',
             '$_POST[tkondisi]',
              '$_POST[tKeterangan]',
              '$_POST[tjumlah]',
              '$_POST[tid_jenis]',
              '$_POST[ttanggal_register]',
              '$_POST[tid_ruang]',
              '$_POST[tkode_inventaris]')
    ");
  if($simpan)
  {
    echo "<script>
    alert('Simpan data sukses');
    document.location='inventarisir.php'
    </script>";
  }
  else
  {
    echo "<script>
    alert('Simpan data gagal');
    document.location='inventarisir.php'
    </script>";
  }
}


  
}

if(isset($_GET['hal']))
{
  if($_GET['hal'] == "edit")
  {
    $tampil = mysqli_query($kon, "SELECT * FROM inventaris WHERE id_inventaris = '$_GET[id]' ");
    $data = mysqli_fetch_array($tampil);
    if($data)
    {
      $vnama = $data['nama'];
      $vkondisi = $data['kondisi'];
      $vKeterangan = $data['Keterangan'];
      $vjumlah = $data['jumlah'];
      $vid_jenis = $data['id_jenis'];
      $vtanggal_register = $data['tanggal_register'];
      $vid_ruang = $data['id_ruang'];
      $vkode_inventaris = $data['kode_inventaris'];
    }
  }
  else if ($_GET['hal'] == "hapus")
  {
    $hapus = mysqli_query($kon, "DELETE FROM inventaris WHERE id_inventaris = '$_GET[id]' ");
    if($hapus){
      echo "<script>
      alert('Hapus data sukses');
      document.location='inventaris.php'
      </script>";
    }
  }
}



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
    <i><b>Form Input Data</b></i>
  </div>
  <div class="card-body">
<form method="post" action="">
  <div class="form-group">
    <label><i><b>Nama Barang</b></i></label>
    <input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" required></input>
  </div>
  <div class="form-group">
        <label><i><b>Kondisi</b></i></label>
        <select class="form-control" name="tkondisi">
          <option value="<?=@$vkondisi?>"><?=@$vkondisi?></option>
          <option value="">Baru</option>
          <option value="">Bekas</option>
          <option value="">Bekas Rasa Baru</option>
        </select>
      </div>
  <div class="form-group">
    <label><i><b>Keterangan</b></i></label>
    <input type="text" name="tKeterangan" value="<?=@$vKeterangan?>" class="form-control" required></input>
  </div>
  <div class="form-group">
    <label><i><b>jumlah</b></i></label>
    <input type="text" name="tjumlah" value="<?=@$vjumlah?>" class="form-control" required></input>
  </div>
  <div class="form-group">
        <label><i><b>Jenis</b></i></label>
          <select name="tid_jenis" class="form-control">
            <option value="tid_jenis"><?=@$vid_jenis?></option>
            <?php
            $query = mysqli_query($kon, "SELECT * from jenis");
            while($row = mysqli_fetch_array($query)) { ?>
              <option value="<?php print $row['id_jenis']?>"><?php print $row['nama_jenis']?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
    <label><i><b>Tanggal Register</b></i></label>
    <input type="text" name="ttanggal_register" value="<?=@$vtanggal_register?>" class="form-control" required></input>
  </div>
  <div class="form-group">
        <label><i><b>Ruang</b></i></label>
          <select name="tid_ruang" class="form-control">
            <option value="tid_ruang"><?=@$vid_ruang?></option>
            <?php
            $query = mysqli_query($kon, "SELECT * from ruang");
            while($row = mysqli_fetch_array($query)) { ?>
              <option value="<?php print $row['id_ruang']?>"><?php print $row['nama_ruang']?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
    <label><i><b>Kode Inventaris</b></i></label>
    <input type="text" name="tkode_inventaris" value="<?=@$vkode_inventaris?>" class="form-control" required></input>
  </div>
  <button type="submit" class="btn btn-success" name="bsimpan"><b>Simpan</b></button>
      <button type="reset" class="btn btn-danger" name="breset"><b>Kosongkan</b></button>
</form>
  </div>
</div>

<div class="card mt-5">
  <div class="card-header bg-dark text-white">
    <i><b>Daftar inventaris</b></i>
  </div>
  <div class="card-body">

    <table class="table table-bordered table-striped">
      <tr>
        <th><i><b>No</b></i></th>
        <th><i><b>Nama</b></i></th>
        <th><i><b>Kondisi</b></i></th>
        <th><i><b>Keterangan</b></i></th>
        <th><i><b>Jumlah</b></i></th>
        <th><i><b>Jenis</b></i></th>
        <th><i><b>Tanggal Register</b></i></th>
        <th><i><b>Ruang</b></i></th>
        <th><i><b>Kode Inventaris</b></i></th>
        <th><i><b>Aksi</b></i></th>
      </tr>
      <?php 
      $no = 1;
      $tampil = mysqli_query($kon, "SELECT * from inventaris order by id_inventaris desc");
      while($data = mysqli_fetch_array($tampil)) :
       ?>
      <tr>
        <th><?=$no++;?></th>
        <th><?=$data['nama']?></th>
        <th><?=$data['kondisi']?></th>
        <th><?=$data['Keterangan']?></th>
        <th><?=$data['jumlah']?></th>
        <th><?=$data['id_jenis']?></th>
        <th><?=$data['tanggal_register']?></th>
        <th><?=$data['id_ruang']?></th>
        <th><?=$data['kode_inventaris']?></th>
        <td>
          <a href="crud_inventaris.php?hal=edit&id=<?=$data['id_inventaris']?>" class="btn btn-info"><b>Edit</b></a>
          <a href="crud_inventaris.php?hal=hapus&id=<?=$data['id_inventaris']?>" onclick="return confirm('Yakin menghapus ?')" class="btn btn-danger"><b>Hapus</b></a>
        </td>
      </tr>
    <?php endwhile; ?>
    </table>

  </div>
</div>

</div>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>