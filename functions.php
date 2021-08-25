<?php
$host="localhost";
$user="root";
$password="";
$db="dbkoperasi";

$kon = mysqli_connect($host,$user,$password,$db);
if (!$kon){
	  die("Koneksi gagal:".mysqli_connect_error());
}

function query($query) {
    global $kon;
    $result = mysqli_query($kon,$query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function inven($inven) {
    global $kon;

    $nama = htmlspecialchars($inven['nama']); 
    $kondisi = $inven['kondisi'];
    $keterangan =  htmlspecialchars($inven['keterangan']);
    $jumlah = htmlspecialchars($inven['jumlah']);
    $id_jenis = $inven['id_jenis'];
    $id_ruang = $inven['id_ruang'];
    $kode_inventaris = htmlspecialchars($inven['kode_inventaris']);
    $id_petugas = $_SESSION['id_petugas'];
    
    $query = "INSERT INTO inventaris VALUES(NULL,'$nama','$kondisi','$keterangan','$jumlah','$id_jenis',NOW(),'$id_ruang','$kode_inventaris','$id_petugas')";
    
  
    mysqli_query($kon, $query);

return mysqli_affected_rows($kon);
}

function drop($id) {
    global $kon;
    mysqli_query($kon, "DELETE FROM inventaris WHERE id_inventaris = $id");
    
    return mysqli_affected_rows($kon);
}

function hapus($id) {
    global $kon;
    mysqli_query($kon, "DELETE FROM peminjaman WHERE id_peminjaman = $id");
    
    return mysqli_affected_rows($kon);
}

function change($change) {
    global $kon;

    $id = $change["id_inventaris"];
    $nama = htmlspecialchars($change['nama']); 
    $kondisi = $change['kondisi'];
    $keterangan =  htmlspecialchars($change['Keterangan']);
    $jumlah = htmlspecialchars($change['jumlah']);
    $kode = htmlspecialchars($change['kode_inventaris']);


   $query = "UPDATE inventaris SET
               nama = '$nama',
                kondisi = '$kondisi',
                Keterangan = '$keterangan',
                jumlah = '$jumlah',
               kode_inventaris = '$kode'
               WHERE id_inventaris = $id
    ";

mysqli_query($kon,$query);

return mysqli_affected_rows($kon);
} 

function pinjam($pinjam) {
    global $kon;

    $tanggal_pinjam = $pinjam['tanggal_pinjam'];
    $tanggal_kembali = $pinjam['tanggal_kembali'];
    $status_peminjaman = $pinjam['status_peminjaman'];
    $id_pegawai = $pinjam['id_pegawai'];
    $id_inventaris = $pinjam['id_inventaris'];
    $jumlah = htmlspecialchars($pinjam['jumlah']);
    
    $query = "INSERT INTO peminjaman (tanggal_pinjam, tanggal_kembali, status_peminjaman, id_pegawai, id_inventaris, jumlah) VALUES (NULL, '$tanggal_pinjam', NULL, '$status_peminjaman', '$id_pegawai', '$id_inventaris', '$jumlah')
    ";
    
  
    mysqli_query($kon, $query);

return mysqli_affected_rows($kon);
}

?>