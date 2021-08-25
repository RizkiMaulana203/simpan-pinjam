<?php

$server = "localhost";
$user = "root";
$pass = "";
$database = "dbkoperasi";

$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

if(isset($_POST['bsimpan']))
{
if($_GET['hal'] == "edit")
{
				$edit = mysqli_query($koneksi, "UPDATE pegawai set
						nama_pegawai = '$_POST[tnama]',
						nip = '$_POST[tnip]',
						alamat = '$_POST[talamat]'
						WHERE id_pegawai = '$_GET[id]'
						");
					if($edit)
					{
						echo "<script>
						alert('Edit data sukses');
						document.location='anggota.php'
						</script>";
					}
					else
					{
						echo "<script>
						alert('Edit data gagal');
						document.location='anggota.php'
						</script>";
					}
}
else
{
	$simpan = mysqli_query($koneksi, "INSERT INTO pegawai (nama_pegawai, nip, alamat)
		VALUES ('$_POST[tnama]', '$_POST[tnip]', '$_POST[talamat]')
		");
	if($simpan)
	{
		echo "<script>
		alert('Simpan data sukses');
		document.location='anggota.php'
		</script>";
	}
	else
	{
		echo "<script>
		alert('Simpan data gagal');
		document.location='anggota.php'
		</script>";
	}
}


	
}

if(isset($_GET['hal']))
{
	if($_GET['hal'] == "edit")
	{
		$tampil = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id_pegawai = '$_GET[id]' ");
		$data = mysqli_fetch_array($tampil);
		if($data)
		{
			$vnama = $data['nama_pegawai'];
			$vnip = $data['nip'];
			$valamat = $data['alamat'];
		}
	}
	else if ($_GET['hal'] == "hapus")
	{
		$hapus = mysqli_query($koneksi, "DELETE FROM pegawai WHERE id_pegawai = '$_GET[id]' ");
		if($hapus){
			echo "<script>
			alert('Hapus data sukses');
			document.location='anggota.php'
			</script>";
		}
	}
}



 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Hello World!</title>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
    <link rel="stylesheet" type="text/css" href="../assets/font/css/all.min.css">
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
		<label><i><b>Nama</b></i></label>
		<input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" required></input>
	</div>
	<div class="form-group">
		<label><b><i>Nip</i></b></label>
		<input type="text" name="tnip" value="<?=@$vnip?>" class="form-control" required></input>
	</div>
	<div class="form-group">
		<label ><b><i>Alamat</i></b></label>
		<textarea class="form-control" name="talamat" required><?=@$valamat?></textarea>
	</div>
	<button type="submit" class="btn btn-success" name="bsimpan"><b>Simpan</b></button>
  	<button type="reset" class="btn btn-danger" name="breset"><b>Kosongkan</b></button>
  	<a href="anggota.php" type="kembali" class="btn btn-info" name="kembali"><b>Kembali</b></a>

</form>
  </div>
</div>

<div class="card mt-5">
  <div class="card-header bg-dark text-white">
    <i><b>Daftar Anggota</b></i>
  </div>
  <div class="card-body">

  	<table class="table table-bordered table-striped">
  		<tr>
  			<th><i><b>No</b></i></th>
  			<th><i><b>Nama</b></i></th>
  			<th><i><b>Nip</b></i></th>
  			<th><i><b>Alamat</b></i></th>
  			<th><i><b>Aksi</b></i></th>
  		</tr>
  		<?php 
  		$no = 1;
  		$tampil = mysqli_query($koneksi, "SELECT * from pegawai order by id_pegawai desc");
  		while($data = mysqli_fetch_array($tampil)) :
  		 ?>
  		<tr>
  			<th><?=$no++;?></th>
  			<th><?=$data['nama_pegawai']?></th>
  			<th><?=$data['nip']?></th>
  			<th><?=$data['alamat']?></th>
  			<td>
  				<a href="crud.php?hal=edit&id=<?=$data['id_pegawai']?>" class="btn btn-info"><b>Edit</b></a>
  				<a href="crud.php?hal=hapus&id=<?=$data['id_pegawai']?>" onclick="return confirm('Yakin menghapus ?')" class="btn btn-danger"><b>Hapus</b></a>
  			</td>
  		</tr>
  	<?php endwhile; ?>
  	</table>

  </div>
</div>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="../assets/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript" src="assets/js/admin.js"></script>
</body>
</html>