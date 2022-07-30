<?php
$test = $_POST['test'];
$temp ="";
$name=" ";

require_once("sparqllib.php");

$db = sparql_connect("http://localhost:3030/game");

sparql_ns("rdf","http://www.w3.org/1999/02/22-rdf-syntax-ns#");
sparql_ns("plc","http://www.tubessemanticweb/namespace#");

$sparql = 
    "prefix rdf:   <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
prefix gm:    <http://www.gamesemweb/ns#> 

SELECT *
WHERE {
  ?s gm:name '".$test."'.
  ?s gm:name ?name.
  ?s gm:rating ?rating.
  ?s gm:developer ?dev.
  ?s gm:genre ?genre.
  ?s gm:link ?link.
  ?s gm:gmply ?gmply.
  ?s gm:img1 ?img1.
  ?s gm:img2 ?img2.
  ?s gm:img3 ?img3.
}";

$result = sparql_query($sparql);
$fields = sparql_field_array($result);

while($row = sparql_fetch_array($result)){
    if($name != $temp){
        $name = $row['name'];
        $rating = $row['rating'];
        $dev = $row['dev'];
        $genre = $row['genre'];
        $gmply = $row['gmply'];
        $link = $row['link'];
        $img1 = $row['img1'];
        $img2 = $row['img2'];
        $img3 = $row['img3'];
    }
    else{
        $genre .= ", ".$row['genre'];
    }
    $temp = $name;
}

print "
<head>
  <meta charset='utf-8'>
  <meta content='width=device-width, initial-scale=1.0' name='viewport'>

  <title>PlayZone - $name</title>

  <link href='assets/img/icon.png' rel='icon'>
  <link href='assets/img/apple-touch-icon.png' rel='apple-touch-icon'>

    
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i' rel='stylesheet'>
  <link href='assets/vendor/bootstrap/css/bootstrap.min.css' rel='stylesheet'>
  <link href='assets/vendor/icofont/icofont.min.css' rel='stylesheet'>
  <link href='assets/vendor/boxicons/css/boxicons.min.css' rel='stylesheet'>
  <link href='assets/vendor/remixicon/remixicon.css' rel='stylesheet'>
  <link href='assets/vendor/venobox/venobox.css' rel='stylesheet'>
  <link href='assets/vendor/owl.carousel/assets/owl.carousel.min.css' rel='stylesheet'>
  <link href='assets/vendor/aos/aos.css' rel='stylesheet'>

  <link href='assets/css/style.css' rel='stylesheet'>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id='header' class='fixed-top'>
    <div class='container d-flex align-items-center'>

      <h1 class='logo me-auto'><a href='index.html'>PlayZone</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href='index.html' class='logo me-auto'><img src='assets/img/logo.png' alt='' class='img-fluid'></a>-->

      <nav class='nav-menu d-none d-lg-block'>
        <ul>
          <li class='active'><a href='index.html'>Home</a></li>
          <li><a href='index.html#about'>About</a></li>
          <li><a href='index.html#team'>Team</a></li>
          <li class='drop-down'>Genre
            <ul>
              <li>
                <form method='post' action='list.php' class='d-grid gap-2'>
                    <input style ='color:black;' class='btn btn-outline-light' type='submit' name='test' id='test' value='First-Person Shooting'>
                </form>
              </li>
              <li>
                <form method='post' action='list.php' class='d-grid gap-2'>
                    <input style ='color:black;' class='btn btn-outline-light' type='submit' name='test' id='test' value='Action'>
                </form>
              </li>
              <li>
                <form method='post' action='list.php' class='d-grid gap-2'>
                    <input style ='color:black;' class='btn btn-outline-light' type='submit' name='test' id='test' value='Sports'>
                </form>
              </li>
              <li>
                <form method='post' action='list.php' class='d-grid gap-2'>
                    <input style ='color:black;' class='btn btn-outline-light' type='submit' name='test' id='test' value='Strategy'>
                </form>
              </li>
            </ul>
            <li><a href='other.html'>Other</a></li>
          </li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
  
  <main id='main'>

    <!-- ======= Breadcrumbs ======= -->
    <section id='breadcrumbs' class='breadcrumbs'>
      <div class='container'>

        <div class='d-flex justify-content-between align-items-center'>
          <h2>Game Details</h2>
          <ol>
            <li><a href='index.html'>Home</a></li>
            <li>Game Details</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id='portfolio-details' class='portfolio-details'>
      <div class='container' data-aos='fade-up'>

        <div class='portfolio-details-container'>

          <div class='owl-carousel portfolio-details-carousel'>
            <img src='$img1' style='width: 500px; height: 200px;' class='img-fluid' alt='' >
            <img src='$img2' style='width: 500px; height: 200px;' class='img-fluid' alt=''>
            <img src='$img3' style='width: 500px; height: 200px;' class='img-fluid' alt=''>
          </div>

          <div class='portfolio-info'>
            <h3>$name</h3>
            <ul>
              <li><strong>Rating</strong>: <i>$rating</i></li>
              <li><strong>Developer</strong>: $dev</li>
              <li><strong>Genre</strong>: $genre</li>
              <li><strong>Game Website</strong>: <a href='$link' target='_blank'><i>Click Here to Go to Website</i></a></li>
            </ul>
          </div>

        </div>

        <div class='portfolio-description'>
          <h2>Description</h2>
          <p>
            $gmply
          </p>
        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id='footer'>

    <div class='footer-top'  style='padding-top:20px; margin-top:30px'>
      <div class='container'>
        <div class='row' style='height:100px;'>

          <div class='col-lg-3 col-md-3 footer-contact'>
            <h3>PlayZone</h3>
            <p>
              Medan, Jl.Pembangunan <br>
              Sumatera Utara<br>
              Indonesia<br><br>
            </p>
          </div>
          
          <div class='col-lg-3 col-md-6 footer-contact'>
            <p>
              <strong>Phone : </strong>+62 896-122-575-81<br>
              <strong>Email : </strong>PlayZone@gmail.com<br>
            </p>
          </div>

        </div>
      </div>
    </div>

    <div class='container d-md-flex py-4  justify-content-center'>

      <div class='col-lg-3 col-md-6 text-center'>
        <div class='copyright'>
          &copy; Copyright <strong><span>PlayZone</span></strong>. All Rights Reserved
        </div>
        <div class='credits'>
          Designed by <a href='https://bootstrapmade.com/'>BootstrapMade</a>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->
  
  <a href='#' class='back-to-top'><i class='ri-arrow-up-line'></i></a>
  <div id='preloader'></div>

  <!-- Vendor JS Files -->
  <script src='assets/vendor/jquery/jquery.min.js'></script>
  <script src='assets/vendor/bootstrap/js/bootstrap.bundle.min.js'></script>
  <script src='assets/vendor/jquery.easing/jquery.easing.min.js'></script>
  <script src='assets/vendor/php-email-form/validate.js'></script>
  <script src='assets/vendor/waypoints/jquery.waypoints.min.js'></script>
  <script src='assets/vendor/counterup/counterup.min.js'></script>
  <script src='assets/vendor/venobox/venobox.min.js'></script>
  <script src='assets/vendor/owl.carousel/owl.carousel.min.js'></script>
  <script src='assets/vendor/isotope-layout/isotope.pkgd.min.js'></script>
  <script src='assets/vendor/aos/aos.js'></script>

  <!-- Template Main JS File -->
  <script src='assets/js/main.js'></script>

</body>";


?>