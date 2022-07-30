<?php

$test=$_POST['test'];

require_once("sparqllib.php");

$db = sparql_connect("http://localhost:3030/game");

sparql_ns("rdf","http://www.w3.org/1999/02/22-rdf-syntax-ns#");
sparql_ns("plc","http://www.tubessemanticweb/namespace#");

$sparql = 
    "prefix rdf:   <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
prefix gm:    <http://www.gamesemweb/ns#> 

SELECT ?name ?synopsis ?rating ?thumbnail
WHERE {
  ?s gm:genre '".$test."'.
  ?s gm:name ?name.
  ?s gm:synopsis ?synopsis.
  ?s gm:rating ?rating.
  ?s gm:banner ?thumbnail.
}";

$result = sparql_query($sparql);
$fields = sparql_field_array($result);

    print "
<head>    
  
  <link href='assets/img/icon.png' rel='icon'>
  <link href='assets/img/apple-touch-icon.png' rel='apple-touch-icon'>
  <title>PlayZone - Search</title>
    
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
        <div class='container px-4 p-6' style='padding-top:100px'>";

print "<h2>$test Games</h2>";

while($row = sparql_fetch_array($result))
{
    print "<div class='row gx-5'>
            <div class='col'>
                <div class=' mt-3 rounded-3 p-3 border bg-light'>
                    <table>
                        <tr>
                            <td>
                             <img src='$row[thumbnail]' alt='...' width=230px height=255px style='border-radius:10px; border-style: solid; border-color:white;'>
                             </td>
                             <td>
                                 <div class='card w-85 right'>
                                    <div class='card-body'>
                                        <h3 class='card-title'>$row[name]</h3>
                                        <p class='card-text fs-6'><i>Rating : $row[rating]</i><br/>$row[synopsis]</p>
                                        <div style='text-align: right;'>
                                            <form action='detail.php' method='post'>
                                                <button class='btn btn-primary' type='submit' formaction='detail.php' id='test' name='test' value='$row[name]'>Detail >></button>
                                            </form>
                                        </div>
                                    </div>
                                 </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
          </div>";
}


    print"
          </div>";
print "
<!-- ======= Footer ======= -->
  <footer id='footer'>

    <div class='footer-top'  style='padding-top:20px; padding-bottom:10px; margin-top:30px'>
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