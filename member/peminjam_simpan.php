<?php

//include koneksi database
include('../koneksi.php');

//get data dari form
$id_inventaris         	= $_POST['id_inventaris'];
$nama 					= $_POST['nama'];
$kondisi       			= $_POST['kondisi'];
$keterangan     		= $_POST['keterangan'];
$jumlah     			= $_POST['jumlah'];
$id_jenis     			= $_POST['id_jenis'];
$tanggal_register    	= $_POST['tanggal_register'];
$id_ruang     			= $_POST['id_ruang'];
$kode_inventaris     	= $_POST['kode_inventaris'];
$id_petugas     		= $_POST['id_petugas'];

//query insert data ke dalam database
$query = "INSERT INTO inventaris 
(id_inventaris, nama, kondisi, keterangan, jumlah, ,id_jenis ,tanggal_register ,id_ruang ,kode_inventaris ,id_petugas) 
VALUES 
('$id_inventaris', '$nama', '$kondisi', '$keterangan', '$jumlah','$id_jenis' '$tanggal_register' ,'$id_ruang' ,'$kode_inventaris' ,'$id_petugas')";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($kon->query($query)) {

    //redirect ke halaman index.php 
    header("location: peminjaman.php");

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>