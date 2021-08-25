<?php

//include koneksi database
include('../koneksi.php');

//get data dari form
$id_peminjaman          = $_POST['id_peminjaman'];
$tanggal_kembali        = $_POST['tanggal_kembali'];
$status_peminjaman      = $_POST['status_peminjaman'];
$jumlah                 = $_POST['jumlah'];

//query update data ke dalam database berdasarkan ID
$query = "UPDATE peminjaman SET tanggal_kembali = '$tanggal_kembali', status_peminjaman = '$status_peminjaman', jumlah = '$jumlah' WHERE id_peminjaman = '$id_peminjaman'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if($kon->query($query)) {
    //redirect ke halaman index.php 
    header("location: peminjaman.php");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}

?>