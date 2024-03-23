<?php
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
	$namaalbum = $_POST['NamaAlbum'];
	$deskripsi = $_POST['Deskripsi'];
	$tanggal = date('Y-m-d');
	$userid = $_SESSION['UserID'];

    $sql = mysqli_query($koneksi, "INSERT INTO album VALUES('','$namaalbum','$deskripsi','$tanggal','$userid')");

    echo "<script>
    alert('Data Berhasil di Simpan!');
    location.href='../admin/album.php';
    </script>";
}

if (isset($_POST['edit'])) {
    $albumid = $_POST['AlbumID'];
	$namaalbum = $_POST['NamaAlbum'];
	$deskripsi = $_POST['Deskripsi'];
	$tanggal = date('Y-m-d');
	$userid = $_SESSION['UserID'];

    $sql = mysqli_query($koneksi, "UPDATE album SET NamaAlbum='$namaalbum', Deskripsi='$deskripsi', TanggalDibuat='$tanggal'
    WHERE AlbumID='$albumid'");

    echo "<script>
    alert('Data Berhasil di Perbarui!');
    location.href='../admin/album.php';
    </script>";
}

if (isset($_POST['hapus'])){
    $albumid = $_POST['AlbumID'];

    $sql = mysqli_query($koneksi, "DELETE FROM album WHERE AlbumID='$albumid'");

    echo "<script>
    alert('Data Berhasil di Hapus!');
    location.href='../admin/album.php';
    </script>";
}

?>