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

    <a class="navbar-brand" style="margin-left:2%" href="#">3D Parchment Reconstruction</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" style="margin-right:2%" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link dropbtn" href="services.php">Services</a>

        </li>

        <!-- show logout once the user has already logged in -->
        <li class="nav-item">
          <?php
          if(isset($_SESSION['username'])) {
            echo '<a class="nav-link" href="logout.php">Logout</a>';
          } else {
            echo '<a class="nav-link" href="login.php">Login</a>';
          }
          ?>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!-- Page Content -->
<div class="container">
  <div class="row">
    <div class="col-sm-8">
      <h2 class="mt-4">Parchment Project</h2>
      <p>Many museums and archives are in possession of damaged artefacts, creating a demand for techniques that can restore them. Fire-damaged parchments, for example, often suffer from uneven shrinkage, waring and distortion. They need new technology to flatten the parchment and to make the texts legible. Prof. Tim Weyrich, who belongs to the UCL Virtual Environments and Computer Graphics group, has succeeded in using 3D reconstruction techniques to restore the content of fire-damaged parchments. However, to make use of the algorithms his team has devised, archivists and transcribers still face the difficulty of compiling the source code themselves. Therefore, we provide a web application based on such algorithms that reaches out to museums and archives, making it easy for them to restore their artifacts. </p>
      <p>Follow these simple steps to start flattening your parchments!</p>
      <ol>
        <li>Login, or create an account if you do not have one</li>
        <li>Upload your images and choose your pipeline at the services page</li>
        <li>Download images once our algoritms finish running (our algorithms typically take a few hours and we will email you once your parchments are processed)</li>
      </ol>
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
          <a href = "http://reality.cs.ucl.ac.uk/weyrich.html">Prof. Weyrich's academic website</a><br>
          <a href = "http://reality.cs.ucl.ac.uk/weyrich.html">Parchment flattening project website</a><br>
          <a href = "http://reality.cs.ucl.ac.uk/projects/gpb/index.html">Great Parchment Book website</a>
        </p>
      </address>
    </div>
  </div>
</div>
<!-- /.container -->

<!-- Footer -->
<footer class="py-3 bg-dark fixed-bottom">
  <p class="m-0 text-center text-white">Wanyue Zhang, Ionut Deaconu, Sergio Hernandez &copy; UCL 2017</p>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="js/script.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
