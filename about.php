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
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="about.php">About
                <span class="sr-only">(current)</span>
              </a>
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
    <div class="container">

      <!-- /.row -->
      <div class="row">
        <div class="col-sm-12">
          <h2 class="mt-4">Parchment Project</h2>
          <p>The Weyrich algorithm has 3 major components: the polygon mesh generator, the texture generator and the parchment flattener. As the first component of the pipeline, the polygon mesh generator takes images of the same piece of parchment at different angles as the input and generates a polygon mesh (a 3D model represented by a lattice of triangles). The texture generator then produces a texture file using the polygon mesh, which contains the information of colors and surface details of the 3D model. In the final step, the parchment flattener uses both the polygon mesh and the texture file to generate a flattened piece of parchment with readable text.</p>
          <p>For more details of the algorithm, please go to the <a href="http://reality.cs.ucl.ac.uk/projects/gpb/index.html">Great Parchment Book project website</a> by the Digital Reality Group.</p>
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
