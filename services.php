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
            <span class="btn btn-default btn-lg btn-file">
              <input onclick="enableInput()" type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple">
              <script>
              function enableInput() {
                document.getElementById("submitButton").disabled = false;
              }
            </script>
            </span>
            <span class="btn btn-default btn-lg btn-file">
              <input type="submit" value="Upload Image" name="submit" id="submitButton" disabled>
            </span>
          </form>
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
      <!-- /.row -->
    </div>
    <!-- /.container -->

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

  </body>

</html>
