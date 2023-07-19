<?php

$message = "";

$name = "";
$type = "";
$school = "";
$mobile = "";
$email = "";
$state = "";
$district = "";
$address = "";

if (isset($_POST['name'])) {
  include "includes/upload.php";
  include "includes/connection.php";

  $name = addslashes($_POST['name']);
  $type = addslashes($_POST['type']);
  $address = addslashes($_POST['address']);
  $district = addslashes($_POST['district']);
  if (isset($_POST['school'])) {
    $school = addslashes($_POST['school']);
  }
  else{
    $school = $address;
  }
  $mobile = addslashes($_POST['mobile']);
  $email = addslashes($_POST['email']);
  $state = addslashes($_POST['state']);
  // $drawing 

  $order_id = time().rand(10000,99999);

  if (!empty($_FILES['drawing']['name'])) {
    $drawing = UploadImage($_FILES['drawing'], $order_id,'drawing/'.$state);
  }
  else{
    $drawing = "ERROR";
    $message = "Please upload valid image. .jpg, .jpeg, .png files only.";
  }
  

  if ($drawing != "ERROR") {
    if ($drawing != "ERROR") {
      $sql = "INSERT INTO `competition` (`id`, `order_id`, `name`, `type`, `state`, `district`, `address`, `school`, `mobile`, `email`, `drawing`, `pay_status`, `timestamp`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', CURRENT_TIMESTAMP);";
      $stmt = mysqli_stmt_init($con);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "ERROR".mysqli_stmt_error($stmt);
      }
      else {
        mysqli_stmt_bind_param($stmt, "ssssssssss", $order_id, $name, $type, $state, $district, $address, $school, $mobile, $email, $drawing);
        mysqli_stmt_execute($stmt);
        header("Location: PaytmKit/pgRedirect.php?order_id=".$order_id);
        exit();
      }
    }
  }
  else{
    $message = "Please upload valid image. .jpg, .jpeg, .png files only.";
  }
  $con->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>UNESCO | Result of Covid Free India - National level drawing competition 2020-21</title>
  <link rel="icon" href="img/icon.png" type = "image/x-icon">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- myCarousel -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,

      input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;

    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;

      }
  </style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include 'includes/topbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Content Row -->
          <div class="row">

            <!-- FORM -->
            <div class="col-md-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h5 class="m-0 font-weight-bold text-primary"><a href="https://www.unescoclubsmh.in/result/">Covid Free India - National level drawing competition 2020-21 Result</a></h5>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <form action="index.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
					
						<div class="col-md-12">
                        <marquee style="background: #eee">कोविड फ्री इंडिया - राष्ट्रीय स्तरावरील रेखांकन स्पर्धा 2020-21 चा निकाल जाहीर झाला आहे.</marquee>
                        <marquee style="background: #eee">Result's Declared of Covid Free India - National level drawing competition 2020-21.</marquee>
						<marquee style="background: #eee">कोविद मुक्त भारत का परिणाम घोषित - राष्ट्रीय स्तर की ड्राइंग प्रतियोगिता 2020-21.</marquee>
                      </div>
					  
                      <div class="col-md-12">
                        <p style="text-align: justify;">
						<h4><b>For Result & Certificates - <a href="https://www.unescoclubsmh.in/result/" target="_blank">Click Here</a></b></h4>
						<br>
						
						All Top 10 Winners and Consolation certificate Winners are kindly requested to send their picture via speed post to the following address; 
						<br><b>Shri Vijay Pavbake, Santiniketan Building At Post Vangaon Ta Dahanu District Palghar (401103).</b>
                        <br>
                        </p>
                      </div>
                      <div class="col-md-12">
                        <p style="text-align: justify;">
						<h4><b>निकाल आणि प्रमाणपत्रांसाठी - <a target="_blank" href="https://www.unescoclubsmh.in/result/"> इथे क्लिक करा </a></b></h4>
						<br>
						
						सर्व टॉप 10 विजेते आणि उत्तेजनार्थ विजेते यांनी आपले चित्र स्पीड पोस्ट द्वारे खालील पत्त्यावर पाठवावे ही नम्र विनंती; 
						<br><b>श्री विजय पावबाके ,  शांतिनिकेतन बिल्डिंग मु पो वाणगाव ता डहाणू जिल्हा पालघर (401103).</b>
                        
                        
                        <br></p>
                      </div>
					
                      <div class="col-md-12">
                         <marquee style="background: #eee">राष्ट्रीय स्पर्धेतील आपल्या सहभागाबद्दल आणि ही स्पर्धा यशस्वी केल्याबद्दल आपले मनःपूर्वक आभार. येथेच पुन्हा भेटूया नवीन विषय व नवीन स्पर्धेसह.</marquee>
						<marquee style="background: #eee">Thank you very much for your participation in the national competition and for making this competition  successful. See you here again with new topics and new competitions.</marquee>
                        <marquee style="background: #eee">राष्ट्रीय प्रतियोगिता में भाग लेने और इस प्रतियोगिता को सफल बनाने के लिए आपका बहुत-बहुत धन्यवाद। नए विषयों और नई प्रतियोगिताओं के साथ यहां फिर से मिलते हैं |</marquee>
                      </div>

                      <div class="col-md-12">
                        <h5 style="color: red"><?php echo $message; ?></h5>
                      </div>
                      

                  </form>
                </div>
              </div>
            </div>

            <!-- Square Images -->
            <div class="col-md-5" >
              <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <li data-target="#myCarousel" data-slide-to="1"></li>
                      <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
					
					                      
                      <div class="item active">
                        <img src="img/26JANUARY.jpg" style="width:100%;">
                      </div>

                      <div class="item">
                        <img src="img/26JANUARY2021.jpg" style="width:100%;">
                      </div>

                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>

                  <h3 style="text-align: center;">
                    <b>HAPPY REPUBLIC DAY 2021</b>
                  </h3>
                </div>
              </div>
            </div>

          </div>

          <!-- Content Row -->
          <div class="row">
            <!-- Rectangular Chart -->
            <div class="col-md-12" >
              <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-5">
                      <div id="myCarousel1" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                          <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
                          <li data-target="#myCarousel1" data-slide-to="1"></li>
                          <li data-target="#myCarousel1" data-slide-to="2"></li>
                          <li data-target="#myCarousel1" data-slide-to="3"></li>
                          <li data-target="#myCarousel1" data-slide-to="4"></li>
                          <li data-target="#myCarousel1" data-slide-to="5"></li>
                          <li data-target="#myCarousel1" data-slide-to="6"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                          <div class="item active">
                            <img src="img/kids/1.jpg" style="width:100%;">
                          </div>
                          <div class="item">
                            <img src="img/drawing/1.jpg" style="width:100%;">
                          </div>

                          <div class="item">
                            <img src="img/kids/2.jpg" style="width:100%;">
                          </div>
                          <div class="item">
                            <img src="img/drawing/2.jpg" style="width:100%;">
                          </div>
                        
                          <div class="item">
                            <img src="img/kids/3.jpg" style="width:100%;">
                          </div>
                          <div class="item">
                            <img src="img/drawing/3.jpg" style="width:100%;">
                          </div>

                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel1" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel1" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right"></span>
                          <span class="sr-only">Next</span>
                        </a>

                      </div>
                    </div>

                    
			  
                    
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-7">
              <div class="card shadow mb-4">
                <center>
                  <div class="row">
                    <div class="col-md-12">
                      <h3 class="text-primary" style="text-align: center; font-weight: bold;">
                        Welcomes You
                      </h3>
                      <br>
                    </div>
                    <div class="col-md-4">
                      <img src="img/yogesh.jpg" style="width: 100%;max-width: 200px;">
                      <br>
                      <h4 class="text-primary" style="font-weight: bold;">YOGESH KULSHRESHTHA</h4>
                      <h4 style="font-weight: bold;">General Secretary</h4>
                      <p>Confederation Of UNESCO Clubs<br>And Association Of India</p>
                      <br>
                      <br>
                    </div>
                    <div class="col-md-4">
                      <img src="img/vijay.jpg" style="width: 100%;max-width: 200px;">
                      <br>
                      <h4 class="text-primary" style="font-weight: bold;">VIJAY B. PAWBAKE</h4>
                      <h4 style="font-weight: bold;">State Coordinator</h4>
                      <p>UNESCO School Clubs<br>MAHARASHTRA</p>
                      <br>
                      <br>
                    </div>
                    <div class="col-md-4">
                      <img src="img/shashi.jpeg" style="width: 100%;max-width: 200px;">
                      <br>
                      <h4 class="text-primary" style="font-weight: bold;">SHASHI BHADAURIA</h4>
                      <h4 style="font-weight: bold;">Convenor for competitions</h4>
                      <p>Confederation Of UNESCO Clubs<br>And Association Of India</p>
                      <br>
                      <br>
                    </div>
                  </div>
                </center>
              </div>
            </div>

            <!-- Square Images -->
            <div class="col-md-5" >
              <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                  <h3 class="text-primary" style="text-align: center; font-weight: bold;">
                    <a href="certificates.php">Previous Competition Certificates</a>
                  </h3>
                  <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                      <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
                      <li data-target="#myCarousel2" data-slide-to="1"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="img/certificates/1.jpg" style="width:100%;">
                      </div>
                      <div class="item">
                        <img src="img/certificates/2.jpg" style="width:100%;">
                      </div>
                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel2" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel2" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>
                </div>

                <center>
                  <br>
                  <h4 class="m-0 font-weight-bold text-primary">
                    16,000+ participants recived certificates.
                  </h4>
                  <br>
                </center>

              </div>
            </div>
          </div>

          <!-- LOGO -->
          <div class="row">

            <div class="col-xl-5">
              <div class="card shadow mb-4">
                <center>
                  <div class="row">
                    <div class="col-md-6">
                      <h5 class="text-primary" style="text-align: center; font-weight: bold;">Organised By Confederation of UNESCO clubs and Association Of India</h5>
                      <br>
                      <img src="img/logo/india.jpeg" style="height: 100px; max-width: 96%;">
                      <br>
                      <br>
                    </div>
                    <div class="col-md-6">
                      <h5 class="text-primary" style="text-align: center; font-weight: bold;">ASSISTED BY</h5>
                      <br>
                      <img src="img/logo/maharashtra.png" style="height: 100px; max-width: 96%;">
                      <br>
                      <br>
                    </div>
                  </div>
                </center>
              </div>
            </div>

            <div class="col-xl-5">
              <div class="card shadow mb-4">
                <center>
                  <div class="row">
                    <div class="col-md-12">
                      <h5 class="text-primary" style="text-align: center; font-weight: bold;">PRIZE SPONSORED BY - Inner Wheel Club Of Bombay Bayveiw</h5>
                    </div>
                    <div class="col-md-6">
                      <br>
                      <img src="img/logo/innerwheel.jpg" style="height: 100px; max-width: 96%;">
                      <br>
                      <br>
                    </div>
                    <div class="col-md-6">
                      <br>
                      <img src="img/logo/leadthechange.jpeg" style="height: 100px; max-width: 96%;">
                      <br>
                      <br>
                    </div>
                  </div>
                </center>
              </div>
            </div>

            <div class="col-xl-2">
              <div class="card shadow mb-4">
                <center>
                  <div class="row">
                    <div class="col-md-12">
                      <h5 class="text-primary" style="text-align: center; font-weight: bold;">MEDIA PARTNER</h5>
                    </div>
                    <div class="col-md-12">
                      <br>
                      <img src="img/logo/sakal.jpeg" style="height: 100px; max-width: 96%;">
                      <br>
                      <br>
                    </div>
                  </div>
                </center>
              </div>
            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <?php include 'includes/footer.php'; ?>

    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->



  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
