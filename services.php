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
  <link href="css/dropzone.css" rel="stylesheet">

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- JQuery for image gallery -->
  <link href='node_modules/simplelightbox/dist/simplelightbox.min.css' rel='stylesheet' type='text/css'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type="text/javascript" src="node_modules/simplelightbox/dist/simple-lightbox.js"></script>
  <script src="js/dropzone.js"></script>
  <!-- Script for dropbox configuration -->

<!--<script>
Dropzone.options.myAwesomeDropzone = {
 uploadMultiple :true, //problematic line, file not uploaded
 // paramName: "file"
 parallelUploads: 100
 // timeout: 180000
  //maxFilesize:100
};

</script> -->


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

    <a class="navbar-brand" style="margin-left:2%" href="#">3D Parchment Reconstruction</a>
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
              <a href="#viewGallery">Image gallery</a>
              <a href="#pipeline">Choose pipeline</a>
              <a href="#downloadResult">Download result</a>
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


    <!-- /.row -->
      <div class="container" style="padding-top:50px">
        <div class="jumbotron">
    <div class="row" style="padding-bottom:50px">
      <div class="col-sm-12">
        <h2 id="dataset" style="padding-top:50px" class="mt-4 text-center">Upload images</h2>

<form action="dropzoneUpload.php" class="dropzone">
  <div class="fallback">
    <input name="file" type="file" multiple />
  </div>
</form>

      </div>
    </div>
<div class="row">
    <div class="col-sm">
      <form action="confirm.php" method="get">
          <input type="submit" value="Confirm" class="btn btn-outline-success float-right" style="padding-right:10px">
      </form>
    </div>
<div class="col-sm">
<form action="cancel.php" method="get">
  <input type="submit" value="Cancel" class="btn btn-outline-danger" style="padding-left:10px">
</form>
</div>
</div>

  </div>
  </div>

    <hr>

    <!-- reference: http://makitweb.com/make-photo-gallery-from-image-directory-with-php/ -->
    <div class="row" style="padding-bottom:50px" class="mt-4 text-center">
      <div class="col-sm-12">
    <h2 style="padding-top:50px" id="viewGallery" class="mt-4 text-center">Image gallery</h2>
    <div class="row">
      <div class="container">
        <div class="gallery">
          <?php
          // Image extensions
          $image_extensions = array("png","jpg","jpeg","gif");
          // Target directory from upload.php
          $foldername = $_SESSION['username'];
          $main_dir = "uploads/" . $foldername;
          $directories = glob($main_dir . '/*' , GLOB_ONLYDIR);
          $countSet = 0;
          foreach ($directories as &$dir) {
            $countSet++;
            $_SESSION['countSet'] = $countSet;
            //$dir = $_SESSION['target_dir'];
           ?>

                      <!-- Break between dataset -->
           <br>
           <input type="radio" id="<?php echo $_SESSION['countSet']; ?>" name="dataset-check" size="35"> <?php echo "Dataset $countSet"; ?> </input>
           <!--<h3><?php echo "Dataset $countSet"; ?></h3>-->
           <br>
           <div class="container" style="padding-bottom:10px">
            <?php
            $dir = $dir.'/';
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
                      // display 10 images in one row
                      if( $count%10 == 0){
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
                      <!-- Break between dataset -->
<br><br>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<hr>


<div class="container">
  <div class="jumbotron">
<div class="row" style="padding-bottom:50px">
  <div class="col-sm-12">
    <h2 id="pipeline" style="padding-top:50px" class="mt-4 text-center">Choose your pipeline</h2>
    </div>
  </div>

    <div class="row">
      <div class="col-sm-12">
        <p style="padding-top:15px">Bundler is a structure-from-motion (SfM) system for unordered image collections. It takes  takes a set of images as input, and produces a 3D reconstruction of camera and sparse scene geometry as output. For more information, please visit <a href = "http://www.cs.cornell.edu/~snavely/bundler/">this site</a>. </p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 text-center">
        <input type="radio" "id=bundler_button" name="btn-grp"> Bundler</input>
      </div>
    </div>
    <hr>


    <div class ="row">
      <div class="col-sm-12">
        <p style="padding-top:15px">PMVS is a multi-view stereo software developed by Prof. Yasutaka Furukawa and Prof. Jean Ponce, from the University of Illinois at Urbana-Champaign. It takes a set of images and camera parameters, then reconstructs 3D structure of an object or a scene visible in the images. For more information, please visit <a href = "https://www.di.ens.fr/pmvs/">this site</a>. By choosing this pipeline you will get a dense point cloud.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 text-center">
        <input type="radio" id="pmvs_button" name="btn-grp"> Bundler+PMVS</input>
      </div>
    </div>
    <hr>

<script>
if(document.getElementById('bundler_button').checked) {
} else if(document.getElementById('pmvs_button').checked) {
} else {
  alert ("You must select a button");
}
</script>


    <div class ="row">
      <div class="col-sm-12">
        <p style="padding-top:15px">Poisson reconstruction processes are able to ignore the noise present in the data to recreate a more accurate 3D representation of your artifacts. Parchment Texture is an algorithm developed by Prof. Tim Weyrich at UCL which will output texture and geometry mesh files.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 text-center">
        <input type="radio" id="poisson_button" name="btn-grp"> Bundler+PMVS+Poisson Reconstruction+Parchment Texture</radio>
      </div>
    </div>
    <hr>

    <div class ="row">
      <div class="col-sm-12">
        <p style="padding-top:15px">Due to uneven shrinkage, photos of fire-damaged parchments will be very likely to contain shadows, making the text hardly legible. Choose our Shadow Removal option for improved aethestic value and clarity. This shadow removal algorithm was developed by Prof. Tim Weyrich at UCL.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 text-center">
        <input type="radio" id="shadow_button" name="btn-grp"> Bundler+PMVS+Poisson Reconstruction+Shadow Removal+Parchment Texture</radio>
        <script>
        $("#shadow_button").click(function() {
          $(this).toggleClass('btn btn-outline-success btn-lg btn btn-success btn-lg');
        });
        </script>
      </div>
    </div>
  </div>


<hr>
    <!-- /.row -->
    <div class="row" style="padding-bottom:50px">
      <div class="col-sm-12">
        <h2 style="padding-top:50px" class="mt-4 text-center" id="downloadResult">Download flattened parchment</h2>
        <div class="mt-4 text-center">
        <button class="btn btn-outline-success btn-lg" id="open_script">Download Bundle</a>
          <script>
          $('#open_script').click(function(){
            window.location.assign('download.php');//there are many ways to do this
          });
        </script>
      </div>
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
