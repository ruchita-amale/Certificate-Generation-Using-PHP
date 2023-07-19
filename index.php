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

require_once("includes/generateCertificate.php");

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
        GenerateCertificate($name, $school, $order_id, $state);
        header("Location: pgResponse.php?order_id=".$order_id."&state=".$state);
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

  <title>AVPOLY | Art Yourself  - National Drawing Competition 2021</title>
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
                  <h5 class="m-0 font-weight-bold text-primary">Art Yourself  - National Drawing Competition 2021</h5>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <form action="index.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
					
						<div class="col-md-12">
                        <marquee style="background: #eee">Let's Participate In "Art Yourself - National Drawing Competion 2021" </marquee>
                      </div>
					 
                      <div class="col-md-12">
						<p style="text-align: justify;"> <b>ART YOURSELF - NATIONAL DRAWING COMPETITION 2021, Organized by AMRUTVAHINI POLYTECHNIC</b>, Sponsored by <b>SHETI & SHIKSHAN VIKAS SANSTHA, SANGAMNER</b> and in collaboration with Amrutvahini Institution. on the occasion of World Drawing Day <b>ART YOURSELF - NATIONAL DRAWING COMPTITION 2021</b>  is organised at the national level. Here we provide a chance to all the national citizens of our country to participate in our nation competition by making a drawing of your imagination. After you submit a photo, your name etc. while drawing a picture you will be honored with a certificate of participation in the competition. Let's draw a portrait.
                        </p>
                      </div>
                      <div class="col-md-12">
                        <marquee style="background: #eee">Please write in English only, as the information written here will appear on the certificate, fill it correctly.</marquee>
                        <marquee style="background: #eee">कृपया, केवल अंग्रेजी में लिखें, क्योंकि यहां लिखी गई जानकारी प्रमाणपत्र पर दिखाई देगी, इसे सही भरें।</marquee>
                      </div>

                      <div class="col-md-12">
                        <h5 style="color: red"><?php echo $message; ?></h5>
                      </div>
                      <div class="col-md-12">
                        <label style="padding-top: 10px;">Full Name of Participant(पुरा नाम)</label>
                        <input type="text" name="name" class="form-control form-control-user" placeholder="Enter Full Name in English only" required="yes" maxlength="50" value="<?php echo $name; ?>">
                      </div>
                      <div class="col-md-12" id="school">
                        <?php 
                          if ($type == "student") { 
                            echo '<label style="padding-top: 8px;">School(विद्यालय) </label><input type="text" name="school" class="form-control form-control-user" placeholder="School(विद्यालय)" required="yes" maxlength="70" value="'.$school.'" >'; 
                          } 
                        ?> 
                      </div>-->

                      <div class="col-md-6">
                        <label style="padding-top: 10px;">WhatsApp Number</label>
                        <input type="number" name="mobile" class="form-control form-control-user" placeholder="WhatsApp Number" required="yes" maxlength="10" value="<?php echo $mobile; ?>" >
                      </div>

                      <div class="col-md-6">
                        <!-- (एका ई-मेल वरून एकदाच सहभाग नोंदवता येईल.) -->
                        <label style="padding-top: 10px;">Email</label>
                        <input type="email" name="email" class="form-control form-control-user" placeholder="Email" required="yes" maxlength="50" value="<?php echo $email; ?>">
                      </div>

                      <div class="col-md-6">
                        <label style="padding-top: 10px;">State(राज्य)</label>
                        <select name="state" class="form-control form-control-user" required="yes">
                          <?php
                            if ($state == "") {
                              echo '<option>State</option>';
                            }
                            else{
                              echo '<option value="'.$state.'">'.$state.'</option>';
                            }
                          ?>
                          <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                          <option value="Andhra Pradesh">Andhra Pradesh</option>
                          <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                          <option value="Assam">Assam</option>
                          <option value="Bihar">Bihar</option>
                          <option value="Chandigarh">Chandigarh</option>
                          <option value="Chhattisgarh">Chhattisgarh</option>
                          <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                          <option value="Daman and Diu">Daman and Diu</option>
                          <option value="Delhi">Delhi</option>
                          <option value="Goa">Goa</option>
                          <option value="Gujarat">Gujarat</option>
                          <option value="Haryana">Haryana</option>
                          <option value="Himachal Pradesh">Himachal Pradesh</option>
                          <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                          <option value="Jharkhand">Jharkhand</option>
                          <option value="Karnataka">Karnataka</option>
                          <option value="Kerala">Kerala</option>
                          <option value="Ladakh">Ladakh</option>
                          <option value="Lakshadweep">Lakshadweep</option>
                          <option value="Madhya Pradesh">Madhya Pradesh</option>
                          <option value="Maharashtra">Maharashtra</option>
                          <option value="Manipur">Manipur</option>
                          <option value="Meghalaya">Meghalaya</option>
                          <option value="Mizoram">Mizoram</option>
                          <option value="Nagaland">Nagaland</option>
                          <option value="Odisha">Odisha</option>
                          <option value="Puducherry">Puducherry</option>
                          <option value="Punjab">Punjab</option>
                          <option value="Rajasthan">Rajasthan</option>
                          <option value="Sikkim">Sikkim</option>
                          <option value="Tamil Nadu">Tamil Nadu</option>
                          <option value="Telangana">Telangana</option>
                          <option value="Tripura">Tripura</option>
                          <option value="Uttar Pradesh">Uttar Pradesh</option>
                          <option value="Uttarakhand">Uttarakhand</option>
                          <option value="West Bengal">West Bengal</option>
                        </select>
                      </div>

                      <div class="col-md-6">
                        <label style="padding-top: 10px;">District(जिला)</label>
                        <input type="text" name="district" class="form-control form-control-user" placeholder="District" required="yes" maxlength="15" value="<?php echo $district; ?>" >
                      </div>

                      <div class="col-md-12">
                        <label style="padding-top: 10px;">Address(पता)</label>
                        <input type="address" name="address" class="form-control form-control-user" placeholder="Address(पता)" required="yes" maxlength="70" value="<?php echo $address; ?>">
                      </div>

                      <div class="col-md-12">
                        <label style="padding-top: 14px;">Please Upload your Painting Photo Here (.jpg, .jpeg, .png)</label> 
                        <input type="file" name="drawing"  required="yes">
                      </div>

                      <br>
					  
                      <div class="col-md-12">
                        <label><input type="checkbox" required="yes"> I promise that  I  personally had drawn this painting and uploading a photo of it. I also guarantee that I have not uploaded any photos other than the painting</label>
                      </div>

					  <div class="col-md-12">
                        <p style="padding-top: 10px;">Fill Complete form, Click on PARTICIPATE.(पूरा फॉर्म भरें, सहभाग  के लिये PARTICIPATE पर क्लिक करें।)</p>
                      </div>
					  
                      <div class="col-md-12"> 
                        
                        &nbsp;<input type="submit" value="PARTICIPATE" class="btn btn-sm btn-primary shadow-sm">
                        <br>
                      </div>
					  
					  
					  <div class="col-md-12">
                        <br>
                        <a href="certificates.php">Already participated? Click here to Download Certificate.</a>
                        <br>
                        <!--<a target="_blank" href="https://wa.me/+918421504851/">If any query, whatsapp message to 8421504851 </a>-->
                      </div>

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
                        <img src="img/draw1.jpg" style="width:100%;">
                      </div>

                      <div class="item">
                        <img src="img/draw2.jpg" style="width:100%;">
                      </div>
					  
					   <div class="item">
                        <img src="img/draw3.jpg" style="width:100%;">
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
                    <b>DRAWING COMPETITION PHOTOGRAPH 2021</b>
                  </h3>
                </div>
              </div>
            </div>

          </div>

                  </div>
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
