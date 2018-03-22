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
 <script src="js/script.js"></script>
 <!-- AngularJS -->
 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

 <!-- Script for dropbox configuration -->
 <script>
 Dropzone.options.myAwesomeDropzone = {
  // uploadMultiple :true,
  // paramName: "file",
  // parallelUploads: 100,
  timeout: 180000,
  addRemoveLinks: true,
  removedfile: function(file) {
   var name = file.name;
   $.ajax({
    type: 'POST',
    url: 'dropzoneUpload.php',
    data: {name:name,request:2},
    dataType: 'html'
   });
   var _ref;
   return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
  }
 };
</script>


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
      <div class="dropdown-content">
       <a href="#">Upload dataset</a>
       <a href="#viewGallery">Choose dataset</a>
       <a href="#pipeline">Choose pipeline</a>
       <a href="#startService">Start the service</a>
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
 <div class="container" ng-app="">

  <!-- /.row -->
  <div class="container">
   <div class="jumbotron" style="background-color:#f8f1e5 !important">
    <div class="row" style="padding-bottom:50px">
     <div class="col-sm-12">
      <div style="padding-bottom:50px">
       <h2 id="dataset" style="padding-top:50px" class="mt-4 text-center">1. Upload images</h2>
      </div>
      <form action="dropzoneUpload.php" class="dropzone" id="myAwesomeDropzone">
       <div class="fallback">
        <input name="file" type="file" multiple />
       </div>
      </form>

     </div>
    </div>
    <div class="row">

     <div class="col-sm">
      <form action="confirm.php" method="get">
       <input type="submit" value="Confirm" class="btn btn-success float-right" style="padding-right:10px">
      </form>
     </div>

     <div class="col-sm">
      <form action="cancel.php" method="get">
       <input type="submit" value="Cancel" class="btn btn-danger">
      </form>
     </div>

    </div>



   </div>
  </div>


  <!-- reference: http://makitweb.com/make-photo-gallery-from-image-directory-with-php/ -->
  <!-- image gallery -->
  <div class="container" id="viewGallery">
   <div class="jumbotron">
    <div style="padding-top:50px" class="row" style="padding-bottom:50px" class="mt-4 text-center">
     <div class="col-sm-12">
      <div style="padding-bottom:50px">
       <h2 class="mt-4 text-center">2. Choose dataset</h2>
      </div>
      <p>To start the service, you should choose a dataset. To make sure you have uploaded the right files, please click on an image to view it in the image gallery. </p>
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
          ?>
          <!-- Break between dataset -->
          <br>
          <div class="row">
           <div class="col-3">
            <span><input type="radio" style="font-size:30px;" id="<?php echo $_SESSION['countSet']; ?>" name="dataset-check" > <span style="font-weight:bold" ng-bind="<?php echo "datasetName".$_SESSION['countSet']; ?>"> </span></input></span>
           </div>
           <div class="col-1">
            <button type="button" onclick="renameOnClick(<?php echo $_SESSION['countSet']; ?>)" id="renameButton" class="btn btn-success btn-sm">Rename</button>
           </div>
           <div class="col-1">
            <form action="delete_dataset.php" method="post">
             <input type="hidden" name="delete_dataset" value="<?php echo $_SESSION['countSet']; ?>" />
             <input type="submit" value="Delete" class="btn btn-danger btn-sm" />
            </form>
           </div>
           <div class="col-5">
            <p>ID: <?php $newdir=$dir; $newnewdir = substr($newdir, strpos($newdir, "/") + 1);echo substr($newnewdir, strpos($newnewdir, "/") + 1);?> </p>
           </div>
          </div>

          <!-- popup window which allows the user to rename the dataset -->
          <div id="<?php echo "renameModal".$_SESSION['countSet']; ?>" class="modal">
           <!-- Modal content -->
           <div class="modal-content">
            <span onclick="confirmOnClick(<?php echo $_SESSION['countSet']; ?>)" class="close">&times;</span>
            <div class="container">
             <div class="text-center">
              <p>Dataset Name: <input class="text-center" type="text" ng-model="<?php echo "datasetName".$_SESSION['countSet']; ?>" ng-init= "<?php echo "datasetName".$_SESSION['countSet']."='dataset '" ?>"  ></p>
              <div class="text-center">
               <button type="button" onclick="confirmOnClick(<?php echo $_SESSION['countSet']; ?>)" id="<?php echo "renameConfirmButton".$_SESSION['countSet']; ?>" class="btn btn-success btn-sm">Confirm</button>
              </div>
             </div>
            </div>
           </div>
          </div>


          <div class="container" style="padding-bottom:50px">
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
                 <img src="<?php echo $image_path; ?>" style="width:10%;height:auto" alt="" title=""/>
                </a>

                <?php
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
      </div> <!-- row ends -->
     </div>
    </div> <!-- view gallery ends -->
    <div class="text-center">
     <a href="#" class="btn btn-info">&laquo; Previous</a>
     <a href="#pipeline" class="btn btn-warning">Next &raquo;</a>
    </div>
   </div> <!-- end jumbotron -->
  </div> <!-- end container -->


  <div id="pipeline" style="padding-top:50px" class="container">
   <div class="jumbotron" style="background-color:#f8f1e5 !important">

    <div class="row" style="padding-bottom:50px">
     <div class="col-sm-12">
      <h2 class="mt-4 text-center">3. Choose your pipeline</h2>
     </div>
    </div>
    <hr>

    <div class="row">
     <div class="col-sm-12 text-center">
      <input type="radio" "id=bundler_button" name="btn-grp"><b> Bundler</b></input>
     </div>
    </div>
    <div class="row">
     <div class="col-sm-12">
      <p style="padding-top:10px">Bundler is a structure-from-motion (SfM) system for unordered image collections. It takes  takes a set of images as input, and produces a 3D reconstruction of camera and sparse scene geometry as output. For more information, please visit <a href = "http://www.cs.cornell.edu/~snavely/bundler/">this site</a>. </p>
     </div>
    </div>
    <hr>


    <div class="row">
     <div class="col-sm-12 text-center">
      <input type="radio" id="poisson_button" name="btn-grp"> <b>Bundler+PMVS+Poisson Reconstruction+Parchment Texture</b></radio>
     </div>
    </div>
    <div class ="row">
     <div class="col-sm-12">
      <p style="padding-top:10px">PMVS is a multi-view stereo software developed by Prof. Yasutaka Furukawa and Prof. Jean Ponce, from the University of Illinois at Urbana-Champaign. It takes a set of images and camera parameters, then reconstructs 3D structure of an object or a scene visible in the images. For more information, please visit <a href = "https://www.di.ens.fr/pmvs/">this site</a>. By choosing this pipeline you will get a dense point cloud.</p>
     </div>
    </div>
    <hr>

    <div class="row">
     <div class="col-sm-12 text-center">
      <input type="radio" id="poisson_button" name="btn-grp"> <b>Bundler+PMVS+Poisson Reconstruction+Parchment Texture</b></radio>
     </div>
    </div>
    <div class ="row">
     <div class="col-sm-12">
      <p style="padding-top:10px">Poisson reconstruction processes are able to ignore the noise present in the data to recreate a more accurate 3D representation of your artifacts. Parchment Texture is an algorithm developed by Prof. Tim Weyrich at UCL which will output texture and geometry mesh files.</p>
     </div>
    </div>
    <hr>

    <div class="row">
     <div class="col-sm-12 text-center">
      <input type="radio" id="shadow_button" name="btn-grp"><b> Bundler+PMVS+Poisson Reconstruction+Shadow Removal+Parchment Texture</b></radio>
      <script>
      $("#shadow_button").click(function() {
       $(this).toggleClass('btn btn-outline-success btn-lg btn btn-success btn-lg');
      });
      </script>
     </div>
    </div>
    <div class ="row">
     <div class="col-sm-12">
      <p style="padding-top:10px">Due to uneven shrinkage, photos of fire-damaged parchments will be very likely to contain shadows, making the text hardly legible. Choose our Shadow Removal option for improved aethestic value and clarity. This shadow removal algorithm was developed by Prof. Tim Weyrich at UCL.</p>
     </div>
    </div>

    <div class="text-center" style="padding-top:20px">
     <a href="#viewGallery" class="btn btn-info">&laquo; Previous</a>
     <a href="#startService" class="btn btn-warning">Next &raquo;</a>
    </div>

   </div> <!-- end jumbotron -->
  </div> <!-- end pipeline section -->

  <!-- /.row -->
  <div class="container" style="padding-top:50px" id="startService">
   <div class="jumbotron">
    <div class="row" style="padding-bottom:50px">
     <div class="col-sm-12">
      <h2 class="mt-4 text-center">4. Start the service</h2>
      <p>After you have selected a dataset and a pipeline, we are now able to process the images. Our pipeline runs for several hours and you will receive an email once it is done. Due to the current limitation of our web app, the email will most likely end up in the junk mailbox in your UCL email. </p>
     </div>
    </div>
    <div class="row">
     <div class="col-sm"></div>
     <div class="col-sm">
      <a href="#pipeline" class="btn btn-info btn-md float-right">&laquo; Previous</a>
     </div>

     <div class="col-sm">
      <div class="text-center">
       <button type="button" class="btn btn-success btn-md" onclick="startService()">Start</button>
      </div>
     </div>

     <div class="col-sm">
      <a href="#downloadResult" class="btn btn-warning btn-md">Next &raquo;</a>
     </div>
     <div class="col-sm"></div>

    </div>
   </div>
  </div>


  <!-- /.row -->
  <div class="container">
   <div class="jumbotron" style="background-color:#f8f1e5 !important">
    <div class="row" style="padding-bottom:50px">
     <div class="col-sm-12">
      <h2 style="padding-top:50px" class="mt-4 text-center" id="downloadResult">5. Download flattened parchments</h2>
      <div class="mt-4 text-center">
       <form action="download.php" method="post">
        <input id="IDforDL" style="width:50%" type="text" name="datasetID" placeholder="Enter the unique dataset ID emailed to you">
        <input id="downloadButton" class="btn btn-success btn-lg" type="submit" value="Download">
       </form>

       <script>
       // disable download button if no ID is entered
       $(document).ready(function(){
        $('#downloadButton').attr('disabled',true);
        $('#IDforDL').keyup(function(){
         if($(this).val().length !=0)
         $('#downloadButton').attr('disabled', false);
         else
         $('#downloadButton').attr('disabled',true);
        })
       });
       </script>
      </div>
     </div>
    </div>
    <div class="text-center">
     <a href="#startService" class="btn btn-info">&laquo; Previous</a>
    </div>
   </div>
  </div>


  <!-- /.container -->
 </div>

 <!-- Footer -->
 <footer class="py-3 bg-dark fixed-bottom">
  <p class="m-0 text-center text-white">Wanyue Zhang, Ionut Deaconu, Sergio Hernandez &copy; UCL 2017</p>
 </footer>

</body>
</html>
