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
            <div class="col-md-7">
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
                        <marquee style="background: #eee">सर्व टॉप 10 विजेते आणि उत्तेजनार्थ विजेते यांनी आपले चित्र स्पीड पोस्ट द्वारे खालील पत्त्यावर पाठवावे ही नम्र विनंती ; श्री विजय पावबाके ,  शांतिनिकेतन बिल्डिंग मु पो वाणगाव ता डहाणू जिल्हा पालघर 401103</marquee>
                        <marquee style="background: #eee">All Top 10 Winners and Consolation certificate Winners are kindly requested to send their picture via speed post to the following address; Shri Vijay Pavbake, Santiniketan Building At Post Vangaon Ta Dahanu District Palghar 401103</marquee>
						<marquee style="background: #eee">
सभी 10 विजेताओं और सांत्वना प्रमाणपत्र विजेताओं से अनुरोध है कि वे अपनी तस्वीर स्पीड पोस्ट के माध्यम से निम्न पते पर भेजें; श्री विजय पवाबके, शांतिनिकेतन भवन में डाक वागाँव ता दहानू जिला पालघर 401103</marquee>
                      </div>
					  
                      <div class="col-md-12">
                        <p style="text-align: justify;">Currently,the entire country is fighting against corona virus. Everyone wants our country to be free from covid 19. So let's express our views on what can be done for covid free India through posters/drawings. So, gear up and show huge participation for this social awareness through your amazing posters.
                        <br>
                        For detail competition information in english - <a href="https://youtu.be/LpBgnJAqh7I" target="_blank">click and watch the video</a></p>
                      </div>
                      <div class="col-md-12">
                        <p style="text-align: justify;">वर्तमान में, पूरा देश कोरोना वायरस से लड़ रहा है। हर कोई चाहता है कि हमारा देश कोविड 19 से मुक्त हो। तो आइए पोस्टरों / रेखाचित्रों के माध्यम से कोविड मुक्त भारत के लिए क्या किया जा सकता है, इस पर अपने विचार व्यक्त करें। चित्र के माध्यम से 'कोविड फ्री इंडिया ' विषयपर सामाजिक जागरूकता फैलाने के लिये बडी संख्या मैं प्रतिभाग ले ।
                        <br>
                        विस्तार से जानकारी के लिए - <a target="_blank" href="https://youtu.be/3H88J85IJjg"> क्लिक करें और वीडियो देखें </a></p>
                        <br>
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

                      <div class="col-md-12">
                        <label style="padding-top: 16px;">Type of Participant: &nbsp; </label>
                        <br>
                        <label  style="padding-top: 4px;">
                          <input type="radio" name="type"  id="type" value="student" required="yes" <?php if ($type == "student") { echo 'checked'; } ?> > Student(छात्र) &nbsp; &nbsp; 
                        </label>
                        <label  style="padding-top: 4px;">
                          <input type="radio" name="type" id="type" value="citizen" style="padding-top: 10px;" required="yes" <?php if ($type == "citizen") { echo 'checked'; } ?> > Citizen(नागरिक)
                        </label>
                      </div>
                      <script type="text/javascript">
                        $('input:radio[name="type"]').click(function() {
                          if($(this).val() == 'student') 
                          {
                            document.getElementById('school').innerHTML = '<label style="padding-top: 8px;">School(विद्यालय) </label><input type="text" name="school" class="form-control form-control-user" placeholder="School(विद्यालय)" required="yes" maxlength="70">';
                          }
                          else{
                            document.getElementById('school').innerHTML = '';
                          }
                        });
                      </script>

                      <div class="col-md-12" id="school">
                        <?php 
                          if ($type == "student") { 
                            echo '<label style="padding-top: 8px;">School(विद्यालय) </label><input type="text" name="school" class="form-control form-control-user" placeholder="School(विद्यालय)" required="yes" maxlength="70" value="'.$school.'" >'; 
                          } 
                        ?> 
                      </div>

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
                        <label style="padding-top: 14px;">Drawing/Poster (.jpg, .jpeg, .png) (कृपया अपनी ड्राइंग यहाँ से अपलोड करें) </label> 
                        <input type="file" name="drawing"  required="yes">
                      </div>

                      <br>
					  
                      <div class="col-md-12">
                        <label><input type="checkbox" required="yes"> I am participating in this contest at my own will and I agree to all the terms and conditions of the organizers. I guarantee that I will not have any complaints about the results announced by the organizers. (मैं अपनी इच्छा से इस प्रतियोगिता में प्रतिभाग ले रहा हूँ । मैं आयोजकों के सभी नियमों और शर्तों से सहमत हूँ । मैं वचन देता हूँ  कि मेरी आयोजकों द्वारा घोषित रिसल्ट्स  के बारे में कोई शिकायत नहीं होगी।)</label>
                      </div>

					  <div class="col-md-12">
                        <p style="padding-top: 10px;">Fill Complete form, Click on PARTICIPATE for payment.(पूरा फॉर्म भरें, भुगतान के लिए PARTICIPATE पर क्लिक करें।)</p>
                      </div>
					  
                      <div class="col-md-12"> 
                        
                        &nbsp;<input type="submit" value="PARTICIPATE" class="btn btn-sm btn-primary shadow-sm">
                        <br>
                      </div>
					  
					  
					  <div class="col-md-12">
                        <p style="padding-top: 10px;">Technical Charges &#x20B9;10. (Online registration and process charges) </p>
                      </div>

                      <div class="col-md-12">
                        <br>
                        <a href="certificates.php">Already participated? Click here to Download Certificate.</a>
                        <br>
                        <a target="_blank" href="https://wa.me/+918421504851/">If any query, whatsapp message to 8421504851 </a>
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

                    <div class="col-md-7">
                      <h3 class="text-primary" style="font-weight: bold;">Covid Free India - National drawing competition</h3>  

                      <b>Rules and regulations </b><br>
                      <b>नियमों और विनियमों</b><br>
                      <b>Subject :- </b> portrait your any idea / view on paper regarding "Covid Free India".<br>
                      <b>विषय :- </b> "कोविड मुक्त भारत" के बारे में कागज पर अपने किसी भी विचार / विचार को चित्रित करें।.<br>
                      
                      <b>Who can Participate :- </b> Any citizen (students / teachers / employees / senior citizen any ) of India <br>
                      <b>कौन भाग ले सकता है :- </b> भारत का कोई भी नागरिक (छात्र / शिक्षक / कर्मचारी / वरिष्ठ नागरिक) <br>
                      
                      <b>Period :- </b> 5th November to 31st December <br>
                      <b>अवधि :- </b> 5 नवंबर से 31 दिसंबर<br>

                      <b>Result :- </b> will be declared on 26 January 2021 ,  please visit same page on 26 January 2021<br>
                      <b>रिसल्ट्स :- </b> प्रतियोगीता का Results जानने के लिये कृपया 26 जनवरी 2021 को इस Page पर फिर से Visit करे<br>

                      <b>Strictly follow the following guidelines </b>
                      <ol>
                        <li>"Covid Free India - National drawing competition 2020" write above title on upper side of your drawing </li>
                        <li>Write your name, adress, email and whatsapp contact On lower side of the drawing</li>
                        <li>You can use any paper and any coloring material</li>
                        <li>Digital art form not allowed</li>
                      </ol>
                      <b>नीचे लिखा दिशानिर्देशों का सख्ती से पालन करें </b>
                      <ol>
                        <li>"Covid Free India - National level drawing competition 2020" अपने ड्राइंग के ऊपरी भाग पर शीर्षक से ऊपर लिखें</li>
                        <li>ड्राइंग के निचले हिस्से पर अपना नाम, पता, ईमेल और व्हाट्सएप संपर्क लिखें</li>
                        <li>आप किसी भी कागज और किसी भी रंग की सामग्री का उपयोग कर सकते हैं</li>
                        <li>डिजिटल आर्ट फॉर्म की अनुमति नहीं है</li>
                      </ol>

                      <b>Participation Certificate to all</b><br>
                      <b>सभी को भागीदारी प्रमाण पत्र</b><br>

                      <b>Top ten prizes (पुरस्कार)</b>
                      <ol>
                        <li>3500₹  and certificate trophy</li>
                        <li>2500₹ and certificate trophy</li>
                        <li>1500₹ and certificate trophy</li>
                        <li>500₹  and certificate</li>
                        <li>500₹  and certificate</li>
                        <li>500₹  and certificate</li>
                        <li>500₹  and certificate</li>
                        <li>500₹  and certificate</li>
                        <li>500₹  and certificate</li>
                        <li>500₹  and certificate</li>
                      </ol>
                      <b>Top 150 consolation prize (will provide consolation certificate to top 150 consolation prize winners)</b>

<div class="col-md-12">
                        <marquee style="background: #eee">सर्व टॉप 10 विजेते आणि उत्तेजनार्थ विजेते यांनी आपले चित्र स्पीड पोस्ट द्वारे खालील पत्त्यावर पाठवावे ही नम्र विनंती ; श्री विजय पावबाके ,  शांतिनिकेतन बिल्डिंग मु पो वाणगाव ता डहाणू जिल्हा पालघर 401103</marquee>
                        <marquee style="background: #eee">All Top 10 Winners and Consolation certificate Winners are kindly requested to send their picture via speed post to the following address; Shri Vijay Pavbake, Santiniketan Building At Post Vangaon Ta Dahanu District Palghar 401103</marquee>
						<marquee style="background: #eee">
सभी 10 विजेताओं और सांत्वना प्रमाणपत्र विजेताओं से अनुरोध है कि वे अपनी तस्वीर स्पीड पोस्ट के माध्यम से निम्न पते पर भेजें; श्री विजय पवाबके, शांतिनिकेतन भवन में डाक वागाँव ता दहानू जिला पालघर 401103</marquee>
                      </div>
					  
                    </div>
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
