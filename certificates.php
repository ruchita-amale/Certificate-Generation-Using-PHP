<?php
	$message = '';
	require_once("includes/connection.php");
	require_once("includes/generateCertificate.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>UNESCO</title>
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
            <div class="col-md-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h4 class="m-0 font-weight-bold text-primary">GET YOUR CERTIFICATE</h4>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                	<h4 class="text-primary">
                		Covid Free India - National level drawing competition 2020
                	</h4>
                	<form action="certificates.php" method="GET">
                		<label>Enter Email ID or Mobile number registered by you: </label>
                  		<input type="text" name="email" class="form-control" placeholder="Email or Mobile">
                  		<br>
                  		<input type="submit" class="btn btn-sm btn-primary shadow-sm">
                	</form>
                  <div class="col-md-12">
                    <br>
                    <a href="index.php">Click here to participate.</a>
                    <br>
                    <a target="_blank" href="https://wa.me/+918421504851/">If any query, whatsapp message to 8421504851 </a>
                  </div>
                </div>
              </div>
            </div>

            <?php
	            if (isset($_GET['email'])) {
	            	$email = addslashes($_GET['email']);
                
                    if (strpos($email, '@') !== false) {
                      $sql = "SELECT * FROM `competition` WHERE `email`=?;";
                    }
                    else{
                      $sql = "SELECT * FROM `competition` WHERE `mobile`=?;";
                    }

      					
      					$stmt = mysqli_stmt_init($con);
      					if (!mysqli_stmt_prepare($stmt, $sql)) {
      						echo "ERROR".mysqli_stmt_error($stmt);
      					}
      					else {
      						mysqli_stmt_bind_param($stmt, "s", $email);
      						mysqli_stmt_execute($stmt);
      						$result = mysqli_stmt_get_result($stmt);
      						// echo mysqli_num_rows($result);
      						if (mysqli_num_rows($result) != 0) {
      							while ($row = mysqli_fetch_assoc($result)) {
      								$id = $row['id'];
      								$name = $row['name'];
      								$school = $row['school'];
                      $state = $row['state'];
      								$ORDERID = $row['order_id'];
                      
                      $certificates = 'certificates/'.$state.'/'.$ORDERID.'.jpg';
                      $certificates .= '?'.filemtime($certificates);
      								
                      echo ' 
      									<div class="col-md-3">
                          <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                              <h5 class="m-0 font-weight-bold text-primary">'.$name.'</h5>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                              <img src="'.$certificates.'" style="width:100%" >
                              <br>
                              <br>
                              <center>
                                <h5 class="m-0 font-weight-bold text-primary">
                                  <a download="'.$id.'-certificates-'.$ORDERID.'.jpg" href="'.$certificates.'" title="DOWNLOAD">
                                    Click to download certificate
                                  </a>
                                </h5>
                              </center>
                            </div>
                          </div>
                        </div>
                      ';
      							}
      						}
      						else{
      							echo ' 
      								<div class="col-md-12">
                        <div class="card shadow mb-4">
                          <!-- Card Header - Dropdown -->
                          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h5 class="m-0 font-weight-bold text-primary">
                              CERTIFICATE NOT FOUND
                            </h5>
                          </div>
                          <!-- Card Body -->
                          <div class="card-body">
                            <h4 class="text-primary">
                              CERTIFICATE NOT FOUND
                            </h4>
                            <p>
                              <a href="index.php">Click here to participate</a>
                            </p>
                          </div>
                        </div>
                      </div>
                    ';
      						}
      					}
      				}
      			?>
            
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
                      <h5 class="text-primary" style="text-align: center; font-weight: bold;">PRIZE SPONSORED BY - Innerwheel Club Of Bombay Bayveiw</h5>
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
<?php 
    $con->close();
?>