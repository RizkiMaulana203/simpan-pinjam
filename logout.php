<?php
session_start();

$_SESSION['id_petugas']='';
$_SESSION['username']='';
$_SESSION['nama_petugas']='';
$_SESSION['id_level']='';

unset($_SESSION['id_petugas']);
unset($_SESSION['username']);
unset($_SESSION['nama_petugas']);
unset($_SESSION['id_level']);

session_unset();
session_destroy();
header('Location:index.php');

?>