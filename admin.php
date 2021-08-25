<?php
session_start();

if (!isset($_SESSION["username"])) {
	echo "Anda harus login dulu <br><a href='login.php'>Klik disini</a>";
	exit;
}

$level=$_SESSION["id_level"];

if ($level!=1) {
    echo "Anda tidak punya akses pada halaman admin";
    exit;
}

$id_petugas=$_SESSION["id_petugas"];
$username=$_SESSION["username"];
$nama_petugas=$_SESSION["nama_petugas"];

?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <div>
      <h1>Selamat Datang di Halaman Administrator</h1>
      <h4>Halaman ini hanya dapat diakses oleh user admin</h4>
        <p>Nama : <?php echo $nama_petugas; ?></p>
        <p>Username : <?php echo $username; ?></p>
        <a href="logout.php">Logout</a>
    </div>

</body>
</html> 