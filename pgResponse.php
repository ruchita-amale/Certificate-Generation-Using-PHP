<?php

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
    
	$message = '';
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

	require_once("includes/connection.php");
	
	if(isset($_GET['order_id']) && isset($_GET['state'])){
	    $order_id = addslashes($_GET['order_id']);
	    $state = addslashes($_GET['state']);
	}
	else{
	    header("Location: index.php");
	    exit();
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

  <title>AVPOLY</title>
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
            <div class="col-md-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h5 class="m-0 font-weight-bold text-primary">Covid Free India - National level drawing competition 2020</h5>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <h1>Thank You for participation.</h1>
                </div>
              </div>
            </div>

            		<!-- FORM -->
		            <div class="col-md-7">
		              <div class="card shadow mb-4">
		                <!-- Card Header - Dropdown -->
		                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		                  <h5 class="m-0 font-weight-bold text-primary">
		                  	<a download="<?php echo $order_id;?>-certificates-<?php echo $order_id;?>.jpg" href="certificates/<?php echo $state.'/'.$order_id; ?>.jpg" title="ImageName">
		                  		Click to download certificate
		                  	</a>
		                  </h5>
		                </div>
		                <!-- Card Body -->
		                <div class="card-body">
		                	<?php
		                		echo '<img src="certificates/'.$state.'/'.$order_id.'.jpg" style="width:100%" >';
		                	?>
		                </div>
		              </div>
		            </div>

          </div>

          <!-- LOGO -->
          <div class="row">


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