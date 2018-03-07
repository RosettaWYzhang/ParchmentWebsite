
<?php
// Initialize the session
ini_set('display_errors', 1);
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>3D Reconstruction of fire-damaged parchment</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/business-frontpage.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- JQuery for image gallery -->
  <link href='node_modules/simplelightbox/dist/simplelightbox.min.css' rel='stylesheet' type='text/css'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="node_modules/simplelightbox/dist/simple-lightbox.js"></script>

  <!-- Script to load image gallery -->
  <script type='text/javascript'>
  $(document).ready(function(){
    console.log("before executing lightbox");
    // Intialize gallery
    var gallery = $('.gallery a').simpleLightbox();
  });
  </script>


</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

    <a class="navbar-brand" style="margin-left:2%" href="#">3D parchment reconstruction</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" style="margin-right:2%" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home
          </a>
        </li>

        <li class="nav-item active">
          <div class="dropdown">
            <a class="nav-link dropbtn" href="services.php">Services
              <span class="sr-only">(current)</span>
            </a>
            <!--<a class="nav-link dropbtn" href="services.php">Services</a>-->
            <div class="dropdown-content">
              <a href="#">Upload dataset</a>
              <a href="#">Choose pipeline</a>
              <a href="#">Download result</a>
            </div>
          </div>
        </li>


        <li class="nav-item">
          <?php
          if(isset($_SESSION['username'])) {
            echo '<a class="nav-link" href="logout.php">Logout</a>';
          } else {
            echo '<a class="nav-link" href="login.html">Login</a>';
          }
          ?>
        </li>


      </ul>
    </div>

  </nav>

  <!-- Page Content -->
  <div class="container">


   <h2>Choose your pipeline</h2>
    <div class="row">
      <div class="col-sm-6">
        <p>1. Due to uneven shrinkage, photos of fire-damaged parchments contain shadows which make the text illegible. Choose our Shadow Removal option for improved aethestic value and clarity. </p>
      </div>
      <div class="col-sm-4">
        <button type="button" class="btn btn-success btn-sm" id="pipeline1" onclick="activateColor()">Shadow Removal</button>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
        <p>2. Bundler is a structure-from-motion (SfM) system for unordered image collections. It takes  takes a set of images as input, and produces a 3D reconstruction of camera and sparse scene geometry as output. For more information, please visit <a href = "http://www.cs.cornell.edu/~snavely/bundler/">this site</a>. </p>
      </div>
      <div class="col-sm-4">
        <button type="button" class="btn btn-success btn-sm">Bundler</button>
      </div>
    </div>

    <div class ="row">
      <div class="col-sm-6">
        <p>3. PMVS is a multi-view stereo software that takes a set of images and camera parameters, then reconstructs 3D structure of an object or a scene visible in the images. For more information, please visit <a href = "https://www.di.ens.fr/pmvs/">this site</a>. </p>
      </div>
      <div class="col-sm-4">
        <button type="button" class="btn btn-success btn-sm">PMVS</button>
      </div>
    </div>


    <div class ="row">
      <div class="col-sm-6">
        <p>4. Input JPG files and get a dense point cloud.</p>
      </div>
      <div class="col-sm-4">
        <button type="button" class="btn btn-success btn-sm">Bundler+PMVS</button>
      </div>
    </div>

    <div class ="row">
      <div class="col-sm-6">
        <p>5. Future work.</p>
      </div>
      <div class="col-sm-6">
        <button type="button" class="btn btn-info btn-sm">Bundler+PMVS+Poisson Reconstruction+Parchment Flattener</button>
      </div>
    </div>

    <div class ="row">
      <div class="col-sm-6">
        <p>6. Future work.</p>
      </div>
      <div class="col-sm-6">
        <button type="button" class="btn btn-info btn-sm">Bundler+PMVS+Shadow Removal+Poisson Reconstruction+Parchment Flattener</button>
      </div>
    </div>

    <!-- /.row -->
    <div class="row">
      <div class="col-sm-12">
        <h2 class="mt-4">Download flattened parchment</h2>
        <button id="open_script">Download Bundle</a>
          <script>
          $('#open_script').click(function(){
            window.location.assign('download.php');//there are many ways to do this
          });
        </script>
      </div>
    </div>
    <!-- /.container -->
  </div>

  <!-- Footer -->
  <footer class="py-3 bg-dark fixed-bottom">

    <p class="m-0 text-center text-white">Wanyue Zhang, Ionut Deaconu, Sergio Hernandez &copy; UCL 2017</p>

    <!-- /.container -->
  </footer>



</body>

</html>
