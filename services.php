<?php
// Initialize the session
ini_set('display_errors', 1);
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.html");
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


    <!-- Script to load image gallery -->
    <script type='text/javascript'>
    $(document).ready(function(){

      // Intialize gallery
      var gallery = $('.gallery a').simpleLightbox();

    });
    </script>


  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">3D parchment reconstruction</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="services.php">Services
              <span class="sr-only">(current)</span>
            </a>
            <li class="nav-item">
              <?php
              if(isset($_SESSION['username'])) {
                echo '<a class="nav-link" href="logout.php">Logout</a>';
              } else {
                echo '<a class="nav-link" href="login.html">Login</a>';
              }
              ?>
            </li>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <!-- /.row -->
      <div class="row">
        <div class="col-sm-12">
          <h2 class="mt-4">Upload images</h2>
          <form action="upload.php" method="post" enctype="multipart/form-data">
            <!--<span class="btn btn-primary btn-sm btn-file">-->
              <input class="btn btn-default btn-lg" onclick="enableInput()" type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple">
              <script>
              function enableInput() {
                document.getElementById("submitButton").disabled = false;
              }
             </script>
            <!--</span>-->
            <span class="btn btn-default btn-sm btn-file">
              <input class="btn btn-success btn-sm" type="submit" value="Upload Image" name="submit" id="submitButton" disabled>
            </span>
          </form>
        </div>
      </div>

        <!-- reference: http://makitweb.com/make-photo-gallery-from-image-directory-with-php/ -->
        <h2>Image gallery of your uploaded images</h2>
<div class="row">
        <div class="container">
        <div class="gallery">
          <?php
          // Image extensions
          $image_extensions = array("png","jpg","jpeg","gif");

          // Target directory from upload.php

          $dir = $_SESSION['target_dir'];
          if (is_dir($dir)){

            if ($dh = opendir($dir)){
              $count = 1;

              // Read files
              while (($file = readdir($dh)) !== false){

                if($file != '' && $file != '.' && $file != '..'){

                  // Thumbnail image path
                  // $thumbnail_path = "images/thumbnail/".$file;

                  // Image path
                  $image_path = $dir.$file;

                  //$thumbnail_ext = pathinfo($thumbnail_path, PATHINFO_EXTENSION);
                  $image_ext = pathinfo($image_path, PATHINFO_EXTENSION);

                  // Check its not folder and it is image file
                  if(!is_dir($image_path) &&
                  //in_array($thumbnail_ext,$image_extensions) &&
                  in_array($image_ext,$image_extensions)){
              ?>

                    <!-- Image -->
                    <a href="<?php echo $image_path; ?>">
                      <img src="<?php echo $image_path; ?>" style="width:10%;height:10%" alt="" title=""/>
                    </a>

                    <?php

                    // Break
                    // display 4 images in one row
                    if( $count%4 == 0){
                      ?>
                      <div class="clear"></div>
                      <?php
                    }
                    $count++;
                  }
                }

              }
              closedir($dh);
            }
          }
          ?>
        </div>
      </div>
</div>


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
          <p>
            <a class="btn btn-primary btn-lg" href="#">Download &raquo;</a>
          </p>
        </div>
      </div>
    <!-- /.container -->
  </div>

    <!-- Footer -->
    <footer class="py-3 bg-dark fixed-bottom">
      <div class="container">
        <p class="m-0 text-center text-white">Wanyue Zhang, Ionut Deaconu, Sergio Hernandez &copy; UCL 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- JQuery for image gallery -->
    <link href='node_modules/simplelightbox/dist/simplelightbox.min.css' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="node_modules/simplelightbox/dist/simple-lightbox.js"></script>


  </body>

</html>
