<?php
session_start();
$UserID = $_SESSION['UserID'];
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda Belum Login!');
    location.href='../home.php';
    </script>";
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Website Galeri Foto</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body>
<nav class="navbar navbar-expand-lg body-tertiary" style="background-color: #99BC85;">
  <div class="container px-5">
  <a class="navbar-brand" href="index.php">Website Galeri Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">
        <a href="index.php" class="nav-link">Gallery</a>
        <a href="album.php" class="nav-link">Album</a>
        <a href="foto.php" class="nav-link">Foto</a>
      </div>

      <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">Keluar</a>
</div>
</div>
    </div>
  </div>
</nav>

<div class="container m-3">
      
      <?php
      $album = mysqli_query($koneksi, "SELECT * FROM album WHERE UserID='$UserID'");
      while($row = mysqli_fetch_array($album)){ ?>
      <a href="home.php?AlbumID=<?php echo $row['AlbumID'] ?>" class="btn btn-outline-primary"> <?php echo $row['NamaAlbum'] ?></a>
     
      <?php } ?>
      
               
<div class="row">
 <?php
 if (isset($_GET['AlbumID'])) {
  $AlbumID = $_GET['AlbumID'];
  $query = mysqli_query($koneksi, " SELECT * FROM foto WHERE UserID='$UserID' AND AlbumID='$AlbumID'");
  while($data = mysqli_fetch_array($query)) { ?>
  <div class="col-md-3 mt-2">
                <div class="card">
                    <img style="height: 12rem; border-radius: 10px;"  src="../assets/img/<?php echo $data['LokasiFile'] ?>"
                     class="card-img-top" title="<?php echo $data['JudulFoto'] ?>">
                      <div class="card-footer text-center">
                        <?php
                        $FotoID = $data['FotoID'];
                        $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE FotoID='$FotoID' AND UserID='$UserID'");
                        if (mysqli_num_rows($ceksuka) == 1) { ?>
                         <a href="../config/proses_like.php?FotoID=<?php echo $data['FotoID']?>"  
                         type="submit" name="batalsuka"><i class="fa fa-heart m-1"></i></a>

                        
                        <?php } else{ ?>
                          <a href="../config/proses_like.php?FotoID=<?php echo $data['FotoID']?>" 
                           type="submit" name="suka"><i class="fa-regular fa-heart m-1"></i></a>
                        <?php }
                        $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE FotoID='$FotoID'");
                        echo mysqli_num_rows($like). 'Suka';
                        ?>
                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['FotoID'] ?>"><i class="fa-regular fa-comment" style="color:#EE4266"></i></a>
           
           <?php 
              $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE FotoID='$FotoID'");
              echo mysqli_num_rows($jmlkomen).' Komentar';
                        ?>
                        </div>
                        </div>
                        </div>
                        </a>

<?php } }else{  

$query = mysqli_query($koneksi, "SELECT * FROM foto WHERE UserID='$UserID'");
while($data = mysqli_fetch_array($query)){
?>
<div class="col-md-3 mt-2">
                <div class="card">
                    <img style="height: 12rem;" src="../assets/img/<?php echo $data['LokasiFile'] ?>"
                     class="card-img-top" title="<?php echo $data['JudulFoto'] ?>">
                      <div class="card-footer text-center">
                        <?php
                        $FotoID = $data['FotoID'];
                        $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE FotoID='$FotoID' AND UserID='$UserID'");
                        if (mysqli_num_rows($ceksuka) == 1) { ?>
                         <a href="../config/proses_like.php?FotoID=<?php echo $data['FotoID']?>"  
                         type="submit" name="batalsuka"><i class="fa fa-heart m-1"></i></a>

                        
                        <?php } else{ ?>
                          <a href="../config/proses_like.php?FotoID=<?php echo $data['FotoID']?>" 
                           type="submit" name="suka"><i class="fa-regular fa-heart m-1"></i></a>
                       <?php }
                        $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE FotoID='$FotoID'");
                        echo mysqli_num_rows($like). 'Suka';
                        ?>
                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['FotoID'] ?>"><i class="fa-regular fa-comment" style="color:#EE4266"></i></a>
           
              
           
           <?php 
              $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE FotoID='$FotoID'");
              echo mysqli_num_rows($jmlkomen).' Komentar';
           ?>
           </div>
         </div>
       </div>
     </a>

 <div class="modal fade" id="komentar<?php echo $data['FotoID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl">
     <div class="modal-content">
       <div class="modal-body">
         <div class="row">
           <div class="col-md-8">
             <img src="../assets/img/<?php echo $data['LokasiFile']?>" class="card-img-top" title="<?php echo $data['JudulFoto']?>" style="height:13rem width:20rem; border-radius: 10px;">
           </div>
           <div class="col-md-4">
             <div class="m-2">
               <div class="overflow-auto">
                 <div class="stycky-top">
                   <strong><?php echo $data['JudulFoto'] ?></strong><br>
                        </div>
                 <hr>
                 <p align="left">
                   <?php echo $data['DeskripsiFoto'] ?>
                 </p>
                 <hr>
                 <?php 
                 $FotoID = $data['FotoID'];
                 $Komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.UserID=User.UserID WHERE komentarfoto.FotoID ='$FotoID'");
                 while($row = mysqli_fetch_array($Komentar)){
                 ?>
                  <p align="left">
                   <strong><?php echo $row['NamaLengkap']?></strong>
                   <?php echo $row['IsiKomentar'] ?>
                  </p>
                 <?php } ?>
                 <hr>
                 <div class="sticky-bottom">
                   <form action="../config/proses_komentar.php" method="POST">
                     <div class="input-group">
                       <input type="hidden" name="FotoID" value="<?php echo $data['FotoID'] ?>">
                       <input type="text" name="IsiKomentar" class="form-control" placeholder="Tambah Komentar">
                       <div class="input-group-prepend">
                         <button type="submit" name="KirimKomentar" Class="btn btn-outline-primary">Kirim</button>
                       </div>
                     </div>
                   </form>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
</div>

          
<?php } } ?>
</div>
</div>





<footer class="d-flex justify-content-center border-top mt-3 fixed-bottom" style="background-color: #99BC85;">
	<p>&copy; UKK | Pingka Teresia </p>
</footer>


<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>