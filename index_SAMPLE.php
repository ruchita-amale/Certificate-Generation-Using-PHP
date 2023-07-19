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
            <div class="col-md-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h5 class="m-0 font-weight-bold text-primary">Covid Free India - National level drawing competition 2020</h5>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <form action="index.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
					
						<div class="col-md-12">
						
						<marquee style="background: #eee">UNESCO Wishing You All Very Happy New Year 2021</marquee>
						<br>
						<br>
						
                        <marquee style="background: #eee">स्पर्धेचा निकाल जाणून घेण्यासाठी, कृपया 26 जानेवारी 2021 रोजी या पृष्ठास पुन्हा भेट द्या.</marquee>
                        <marquee style="background: #eee">Result will be declared on 26 January 2021 ,  please visit same page on 26 January 2021</marquee>
						<marquee style="background: #eee">पप्रतियोगीता का Results जानने के लिये कृपया 26 जनवरी 2021 को इस Page पर फिर से Visit करे</marquee>
						<br>
						
                      </div>
					


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
