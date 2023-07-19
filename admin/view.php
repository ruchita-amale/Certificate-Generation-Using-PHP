<?php
  $loginname = "ADMIN ";
  $message = "";
  $limit = 10;

  $id = "";
  $orderid = "";
  $name = "";
  $type = "";
  $mobile = "";
  $email = "";
  $state = "";
  $district = "";
  $address = "";
  $flag = 1;
  $url = "";

  $certificate = '../img/demo.jpg';

  include 'includes/connection.php';
  include 'includes/generateCertificate.php';


  $vid = 0;
  if (isset($_POST['vid'])) {
    $order_id = addslashes($_POST['order_id']);
    $vid = addslashes($_POST['vid']);
    $url = addslashes($_POST['url']);
    $name = addslashes($_POST['name']);
    $school = addslashes($_POST['school']);
    $state = addslashes($_POST['state']);
    $sql = "UPDATE `competition` SET `name` = ?, `school`=?, `pay_status` = '1'  WHERE `id` = ?;";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "SERVER ERROR: ".mysqli_stmt_error($stmt);
    }
    else{
      mysqli_stmt_bind_param($stmt, "sss", $name, $school, $vid);
      mysqli_stmt_execute($stmt);
      GenerateCertificate($name, $school, $order_id, $state);
    }

  
  }

  if ($url != "") {
    $back_url = $url;
  }
  else if (isset($_SERVER['HTTP_REFERER'])) {
    $back_url = $_SERVER['HTTP_REFERER'];
  }
  else{
    $back_url = $url;
  }

  if (isset($_GET['vid'])) {
    $vid = addslashes($_GET['vid']);
  }

  if ($vid != 0) {
    $sql = "SELECT * FROM `competition` WHERE id=?";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "ERROR".mysqli_stmt_error($stmt);
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $vid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      // echo mysqli_num_rows($result);
      if (mysqli_num_rows($result) != 0 && $row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $order_id = $row['order_id'];
        $name = $row['name'];
        $type = $row['type'];
        $state = $row['state'];
        $district = $row['district'];
        $address = $row['address'];
        $school = $row['school'];
        $mobile = $row['mobile'];
        $email = $row['email'];
        $drawing = $row['drawing'];
        $pay_status = $row['pay_status'];
        $timestamp = $row['timestamp'];


        if ($pay_status == 1) {
          $certificate = '../certificates/'.$state.'/'.$order_id.'.jpg'; 
          $certificate .= '?'.filemtime($certificate); 
        }
      }
      else{
        // echo "INVALID PATICIPANT";
        header("Location: ".$back_url);
        exit();
      }
    }
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
  <title>Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <style type="text/css">
    input,  select{
      margin-top: 4px;
    }
  </style>
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include 'includes/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include 'includes/topbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Content Row -->
          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12">
              <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                  <br>
                    <h4 style="text-align: center;" class="text-primary">PARTICIPANT ID: <?php echo $id.'-'.$order_id; ?></h4>
                    <br>
                    <b>Name:</b><?php echo $name; ?><br>
                    <b>Type:</b><?php echo $type; ?><br>
                    <b>School:</b><?php echo $school; ?><br>
                    <b>Mobile:</b><?php echo $mobile; ?><br>
                    <b>Email:</b><?php echo $email; ?><br>
                    <b>State:</b><?php echo $state; ?><br>
                    <b>District:</b><?php echo $district; ?><br>
                    <b>Address:</b><?php echo $address; ?><br>
                    <b>Pay status:</b><?php echo $pay_status; ?><br>
                    <b>Timestamp:</b><?php echo $timestamp; ?><br>
                    <br>
                    <form action="view.php" method="POST" enctype="multipart/form-data">
                      <div class="row">

                        <div class="col-md-12">
                          <h5 style="color: red"><?php echo $message; ?></h5>
                        </div>

                        <div class="col-md-12">

                          <input type="hidden" name="url" value="<?php echo $back_url; ?>">
                          <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                          <input type="hidden" name="vid" value="<?php echo $vid; ?>">
                          <input type="hidden" name="state" value="<?php echo $state; ?>">

                          <label>Name on certificate</label>
                          <input type="text" name="name" class="form-control form-control-user" placeholder="Name" required="yes" maxlength="50" value="<?php echo $name; ?>">
                        </div>

                        <div class="col-md-12" id="school">
                          <label style="padding-top: 8px;">School/Address</label>
                          <input type="text" name="school" class="form-control form-control-user" placeholder="School / Address" required="yes" maxlength="70" value="<?php echo $school; ?>" > 
                        </div>

                        <div class="col-md-12"> 
                          <br>
                          &nbsp;<input type="submit" value="<?php if($pay_status == 0){echo 'Mark as PAID & ';} ?>Regenerate Certificate" class="btn btn-sm btn-primary shadow-sm">
                          <br>
                        </div>

                      </div>
                    </form>
                    <br>
                    <img src="../drawing/<?php echo $state.'/'.$drawing; ?>" style="width:96%">
                    <br>
                    <?php
                      $sql = "SELECT * FROM `payment` WHERE `CUST_ID`=?";
                      $stmt = mysqli_stmt_init($con);
                      if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "ERROR".mysqli_stmt_error($stmt);
                      }
                      else {
                        mysqli_stmt_bind_param($stmt, "s", $vid);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        if (mysqli_num_rows($result) != 0){
                          while($row = mysqli_fetch_assoc($result)) {
                            echo "<b>payment_id: </b>".$row['payment_id'].'<br>';
                            echo "<b>ORDERID: </b>".$row['ORDERID'].'<br>';
                            echo "<b>CUST_ID: </b>".$row['CUST_ID'].'<br>';
                            echo "<b>CURRENCY: </b>".$row['CURRENCY'].'<br>';
                            echo "<b>GATEWAYNAME: </b>".$row['GATEWAYNAME'].'<br>';
                            echo "<b>RESPMSG: </b>".$row['RESPMSG'].'<br>';
                            echo "<b>BANKNAME: </b>".$row['BANKNAME'].'<br>';
                            echo "<b>PAYMENTMODE: </b>".$row['PAYMENTMODE'].'<br>';
                            echo "<b>MID: </b>".$row['MID'].'<br>';
                            echo "<b>RESPCODE: </b>".$row['RESPCODE'].'<br>';
                            echo "<b>TXNID: </b>".$row['TXNID'].'<br>';
                            echo "<b>TXNAMOUNT: </b>".$row['TXNAMOUNT'].'<br>';
                            echo "<b>STATUS: </b>".$row['STATUS'].'<br>';
                            echo "<b>BANKTXNID: </b>".$row['BANKTXNID'].'<br>';
                            echo "<b>TXNDATE: </b>".$row['TXNDATE'].'<br><br>';
                          }
                        }
                        else{
                          echo "PAYMENT INFO NOT AVAILABLE";
                        }
                      }
                    ?>
                    <br>
                    <img src="<?php echo $certificate; ?>" style="width:96%">
                    <br>
                    <?php
                      echo '<a download="'.$id.'-certificates-'.$order_id.'.jpg" href="'.$certificate.'" title="DOWNLOAD">';
                    ?>
                      <h4 class="text-primary" style="text-align: center;">Click to download Certificate.</h4>
                    </a>
                    <?php
                      echo '<a download="'.$id.'-drawing-'.$order_id.'.jpg" href="../drawing/'.$state.'/'.$drawing.'" title="DOWNLOAD">';
                    ?>
                      <h4 class="text-primary" style="text-align: center;">Click to download Drawing.</h4>
                    </a>
                    <center>
                      <a href="<?php echo $back_url; ?>">
                        <button class="btn btn-primary">
                          GO BACK
                        </button>
                      </a>
                    </center>
                </div>
              </div>
            </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; UNESCO 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->






  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

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
