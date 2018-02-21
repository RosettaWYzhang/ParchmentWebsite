<?php
// Initialize the session
  ini_set('display_errors', 1);
  session_start();
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
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="services.php">Services</a>
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
      </div>
    </nav>

    <!-- Page Content -->
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-sm-8">
          <h2 class="mt-4">Parchment Project</h2>
          <p>Many museums and archives are in possession of damaged artefacts, creating a demand for techniques that can repair or restore them. Fire-damaged parchment, for example, often suffers from uneven shrinkage, waring and distortion, and necessitates new technology to flatten the parchment and to render the texts legible. Prof Tim Weyrich of UCL Virtual Environments and Computer Graphics group has succeeded in using 3D reconstruction techniques to restore the content on fire-damaged parchment, but to make use of the algorithm, archivists and transcribers still face the difficulty of compiling the source code themselves. </p>
          <p>Therefore, we aim to develop a web application based on the 3D reconstruction algorithm that reaches out to museums and archives.</p>
          <p>
            <a class="btn btn-primary btn-lg" href="about.html">Read more &raquo;</a>
          </p>
        </div>
        <div class="col-sm-4">
          <h2 class="mt-4">Contact Us</h2>
          <img src="images/tim.png" alt="rotated tim with parchment" style="width:60%;height:auto;">
          <address>
            <strong>Prof. Tim Weyrich</strong>
            <br>Department of Computer Science
            <br>University College London
            <br>Gower Street, WC1E 6BT
            <br>
          </address>
          <address>
            <p>Email:
            <a href="mailto:#">t.weyrich@cs.ucl.ac.uk</a><br>
            <a href = "http://reality.cs.ucl.ac.uk/weyrich.html">Web page</a><br>
            <a href = "http://reality.cs.ucl.ac.uk/weyrich.html">Project page</a><br>
            <a href = "http://reality.cs.ucl.ac.uk/projects/gpb/index.html">Great Parchment Book page</a>
            </p>
          </address>

        </div>
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-sm-12">
          <h2 class="mt-4">User Guide</h2>
          <p>Upload the images of a piece of parchment from multiple viewpoints in png format. Wait a few hours for our server to process them and simply download the flattened parchment once it is ready!</p>
            <a class="btn btn-primary btn-lg" href="services.php">Start flattening your parchment &raquo;</a>
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
    <script src="js/script.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
