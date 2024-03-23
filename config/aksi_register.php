<?php 
include'koneksi.php';

$username = $_POST['Username'];
$password = $_POST['Password'];
$email = $_POST['Email'];
$namalengkap = $_POST['NamaLengkap'];
$alamat = $_POST['Alamat'];

$sql = mysqli_query($koneksi, "INSERT INTO user VALUES ('','$username','$password','$email','$namalengkap','$alamat')");

if ($sql) {
	echo "<script>
	alert('Pendaftaran akun berhasil');
	location.href='../admin/index.php';
	</script>";
}

 ?>