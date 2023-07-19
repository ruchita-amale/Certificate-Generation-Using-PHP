<?php
  $loginname = "ADMIN ";

  $limit = 10;

  $id = "";
  $orderid = "";
  $name = "";
  $type = "";
  $mobile = "";
  $email = "";
  $state = "";
  $district = "";
  $flag = 1;
  
  $url_base = "index";
  $url = ".php?";

  $sql = "SELECT * FROM `competition` ";
  $where = " WHERE `pay_status`=0 ";
  $order = " ORDER BY `id` DESC ";

  if (isset($_GET['id']) && $_GET['id']!='') {
    $id = addslashes($_GET['id']);
    $where .= ' AND  `id` LIKE "'.$id.'"';
    $flag = 0;
    $url .= 'id='.$id.'&';
  }

  if (isset($_GET['orderid']) && $_GET['orderid']!='') {
    $orderid = addslashes($_GET['orderid']);
    $where .= ' AND `order_id` LIKE "%'.$orderid.'%"';
    $flag = 0;
    $url .= 'orderid='.$orderid.'&';
  }

  if (isset($_GET['name']) && $_GET['name']!='') {
    $name = addslashes($_GET['name']);
    $where .= ' AND `name` LIKE "%'.$name.'%"';
    $flag = 0;
    $url .= 'name='.$name.'&';
  }

  if (isset($_GET['type']) && $_GET['type']!='Type') {
    $type = addslashes($_GET['type']);
    $where .= ' AND `type` = "'.$type.'"';
    $flag = 0;
    $url .= 'type='.$type.'&';
  }

  if (isset($_GET['mobile']) && $_GET['mobile']!='') {
    $mobile = addslashes($_GET['mobile']);
    $where .= ' AND `mobile` LIKE "%'.$mobile.'%"';
    $flag = 0;
    $url .= 'mobile='.$mobile.'&';
  }

  if (isset($_GET['email']) && $_GET['email']!='') {
    $email = addslashes($_GET['email']);
    $where .= ' AND `email` LIKE "%'.$email.'%"';
    $flag = 0;
    $url .= 'email='.$email.'&';
  }

  if (isset($_GET['state']) && $_GET['state']!='State') {
    $state = addslashes($_GET['state']);
    $where .= ' AND `state` = "'.$state.'"';
    $flag = 0;
    $url .= 'state='.$state.'&';
  }

  if (isset($_GET['district']) && $_GET['district']!='') {
    $district = addslashes($_GET['district']);
    $where .= ' AND `district` LIKE "%'.$district.'%"';
    $flag = 0;
    $url .= 'district='.$district.'&';
  }

  if (isset($_GET['page']) && $_GET['page']!='') {
    $page = $_GET['page'];
  }
  else if (isset($_POST['page']) && $_POST['page']!='') {
    $page = $_POST['page'];
  }
  else{
    $page = 1;
  }

  $start = ($page-1)*$limit;
  $end = $start+$limit+1;

  $limit_sql = " LIMIT ".$start.", ".$end." ; "; 
  $sql = $sql.$where.$order.$limit_sql;
  include 'includes/connection.php';
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
    input[type='text'],  select{
      color: blue!important;
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
                  <h2 class="text-primary" style="text-align: center; font-weight: bold;">
                    SEARCH IN FAIL
                  </h2>
                  <br>

                  <form method="GET">
                    <div class="row">
                      <div class="col-md-4">
                        <input type="text" name="id" placeholder="ID" class="form-control" autocomplete="off" value="<?php echo $id; ?>" >
                      </div>
                      <div class="col-md-4">
                        <input type="text" name="orderid" placeholder="ORDER ID" class="form-control" autocomplete="off" value="<?php echo $orderid; ?>" >
                      </div>
                      <div class="col-md-4">
                        <input type="text" name="name" placeholder="NAME" class="form-control" autocomplete="off" value="<?php echo $name; ?>" >
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <input type="text" name="mobile" placeholder="MOBILE" class="form-control" autocomplete="off" value="<?php echo $mobile; ?>" >
                      </div>
                      <div class="col-md-4">
                        <input type="text" name="email" placeholder="EMAIL" class="form-control" autocomplete="off" value="<?php echo $email; ?>" >
                      </div>
                      <div class="col-md-4">
                        <input type="text" name="district" placeholder="District" class="form-control" autocomplete="off" value="<?php echo $district; ?>" >
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <select class="form-control" autocomplete="off" name="type">
                          <option value="Type">Type-ALL</option>
                          <option value="student" <?php if ($type == 'student') { echo 'selected="yes"'; } ?> >Student</option>
                          <option value="citizen" <?php if ($type == 'citizen') { echo 'selected="yes"'; } ?>>Citizen</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <select name="state" class="form-control form-control-user" required="yes" autocomplete="off">
                          <?php
                            if ($state == "") {
                              echo '<option value="State">State-ALL</option>';
                            }
                            else{
                              echo '<option value="'.$state.'">'.$state.'</option><option value="State">State-ALL</option>';
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
                      <div class="col-md-4">
                        <input type="submit" value="SEARCH"  class="btn btn-sm btn-primary shadow-sm">
                        <input type="reset" value="RESET"  class="btn btn-sm btn-primary shadow-sm">
                      </div>
                    </div>
                  </form>

                  <br>
                </div>
              </div>
            </div>

            <!-- Area Chart -->
            <div class="col-xl-12">
              <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                  <br>

                  <div class="table-responsive">
                    <h4 style="text-align: center;" class="text-primary">Page No: <?php echo $page; ?></h4>
                    <br>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <td>Id - Order Id</td>
                          <td>Name</td>
                          <td>Action</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $stmt = mysqli_stmt_init($con);
                          $count = 0;
                          if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "ERROR".mysqli_stmt_error($stmt);
                          }
                          else {
                            // mysqli_stmt_bind_param($stmt, "s", $email);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            // echo mysqli_num_rows($result);
                            if (mysqli_num_rows($result) != 0) {
                              while ($count < $limit && $row = mysqli_fetch_assoc($result)) {
                                echo '<tr><td>'.$row['id'].'-'.$row['order_id'].'</td><td>'.$row['name'].'</td><td><a href="view.php?vid='.$row['id'].'"><img src="img/view.png" width="20"></a></td></tr>';
                                $count++;
                              }
                            }
                            else{
                              echo "<tr><td colspan='3' style='text-align:center;'>NOT FOUND</td></tr>";
                            }
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="row">
                    <div class="col-sm-8">
                      <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                        <ul class="pagination">

                          <?php

                            if ($page == 1) {
                              echo '
                                <li class="paginate_button page-item previous disabled" id="dataTable_previous">
                                  <a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous
                                  </a>
                                </li>
                              ';
                            }
                            else{
                              $previous = $page-1;
                              echo '
                                <li class="paginate_button page-item previous" id="dataTable_previous">
                                  <a href="'.$url_base.$url.'page='.$previous.'" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous
                                  </a>
                                </li>
                              ';
                            }

                            if ($count == $limit) {
                              $next = $page+1;
                              echo '
                                <li class="paginate_button page-item next" id="dataTable_previous">
                                  <a href="'.$url_base.$url.'page='.$next.'" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Next
                                  </a>
                                </li>
                              ';
                            }
                            else {
                              echo '
                                <li class="paginate_button page-item next disabled" id="dataTable_previous">
                                  <a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Next
                                  </a>
                                </li>
                              ';
                            }
                          ?>
                        </ul>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <form action="<?php echo $url; ?>" method="POST">
                        <input type="text"  name="page" placeholder="PAGE" style="width: 58%;border: 1px solid #ddd;padding: 6px; border-radius: 6px 0px 0px 4px;margin: -4px;" >
                        <input type="submit" class="btn btn-primary" style="width: 40%;margin: 0px;border-radius: 0px 6px 6px 0px" value="GO TO">
                      </form>
                    </div>
                  </div>
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
