<?php
session_start();
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <style>
      
      .banner{
          height: 50vh;
          background:  url('bg/pin.jpg');
          background-size: cover;
          background-position: center;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg body-tertiary" style="background-color: #99BC85;">
  <div class="container">
    <a class="navbar-brand" href="index.php"> Welcome Gallery P'GRS </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">
        
      </div>
      <a href="register.php" class="btn btn-outline-light m-1">Daftar</a>
      <a href="login.php" class="btn btn-outline-light m-1">Masuk</a>
    </div>
  </div>
</nav>

<div class="container-fluid banner">
  <div class="container banner-content col-ig-6">
    <div class="text-center">

    </div>
  </div>
</div>


<div class="container" >
  <div class="row">
    <?php 
      $query = mysqli_query($koneksi, "SELECT * FROM foto");
      while($data = mysqli_fetch_array($query)){
     ?>
   
     <div class="col-md-4 mt-2 " >
        <div class="card">
          <img style="height:14rem; border-radius: 10px;" src="assets/img/<?php echo $data['LokasiFile']?>" class="card-img-top" title="<?php echo $data['JudulFoto']?>">
          <div class="card-footer text-center">
          </div>
        </div>
      </div>
    <?php } ?>
    </div>
</div>

<footer class="d-flex justify-content-center border-top mt-3 fixed-bottom" style="background-color: #99BC85;">
	<p>&copy; UKK | Pingka Teresia </p>
</footer>
    
<script type="text/javascript" src="assets/css/bootstrap.min.js"></script>
</body>
</html>
