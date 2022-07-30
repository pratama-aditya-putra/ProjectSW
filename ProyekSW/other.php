<?php
$test=$_POST['test'];

require_once("sparqllib.php");

$db = sparql_connect("http://localhost:3030/bioskop");

sparql_ns("rdf","http://www.w3.org/1999/02/22-rdf-syntax-ns#");
sparql_ns("plc","http://www.tubessemanticweb/namespace#");

$sparql = 
    "prefix rdf:   <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
prefix film:  <http://www.kuykebioskop/fake#> 

SELECT ?name ?location ?harga ?harga2 ?harga3 ?img 
WHERE {
  ?s film:nama ?name.
  ?s film:lokasi ?location.
  ?s film:weekday ?harga.
  ?s film:jumat ?harga2.
  ?s film:weekend ?harga3.
  ?s film:gambar ?img.
  filter(?harga <= '$test')
} LIMIT 10";

$result = sparql_query($sparql);
$fields = sparql_field_array($result);

print "
<head>
  <meta charset='utf-8'>
  <meta content='width=device-width, initial-scale=1.0' name='viewport'>

  <title>Ads</title>

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
</head>";

print "
<main id='main'>

    <!-- ======= Breadcrumbs ======= -->
    <section class='breadcrumbs' style='margin-top:0px;'>
      <div class='container'>

        <div class='d-flex justify-content-between align-items-center'>
          <h2>Ads</h2>
          <ol>
            <li><a href='other.html'>Kembali</a></li>
            <li>Ads</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->
    
    <br/><h3>Hasil Pencarian</h3><br/>
    <p>Gimana udah ketemu yang pas, kalau belum silahkan pencet tombol kembali</p>";

while($row = sparql_fetch_array($result))
{
    print "<div class='row gx-5'>
            <div class='col'>
                <div class=' mt-3 rounded-3 p-1 border bg-light'>
                    <table>
                        <tr>
                            <td>
                             <img src='$row[img]' alt='...' width=180px height=180px style='border-radius:10px; border-style: solid; border-color:white;'>
                             </td>
                             <td>
                                 <div class='card w-100 right'  style='border-style: none;'>
                                    <div class='card-body bg-light'>
                                        <h3 class='card-title'>$row[name]</h3>
                                        <p class='card-text fs-6'>Hari Biasa  : $row[harga]<br/>
                                        Hari Jum'at  : $row[harga2]<br/>
                                        Akhir Minggu : $row[harga3]<br/>
                                        $row[location]
                                        </p>
                                    </div>
                                 </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
          </div>";
}
print "
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
          &copy; Copyright <strong><span>OnePage</span></strong>. All Rights Reserved
        </div>
        <div class='credits'>
          Designed by <a href='https://bootstrapmade.com/'>BootstrapMade</a>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->";


?>