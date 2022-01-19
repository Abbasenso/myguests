<?php  
session_start();
error_reporting(E_ALL ^ E_WARNING); 
$type='';
$type=$_GET['type'];

include 'database/dbconfig.php';

if ($_SESSION['mobile_no'] == true  &&  $_SESSION['id'] == true ) {
  
} else {
  echo "<script>";
     echo 'window.location.href = "registration.php";';
    echo "</script>";
}
 
 $id = $_SESSION['id'];
 $mobile = $_SESSION['mobile_no'];
 $msg='';

 if (isset($_POST['submit'])) {
     $otp=$_POST['otp'];
     $mobile = $_SESSION['mobile_no'];
     $id = $_SESSION['id'];

     $sql=mysqli_query($conn,"SELECT `otp` FROM `mg_login` WHERE `mobile`='$mobile' and `id`='$id' and `otp`='$otp'");

     $result=mysqli_num_rows($sql);
     if ($result==1) {

        echo '<script type="text/javascript">';
        echo 'window.location.href = "details.php";';
        echo '</script>';
        
     }else{

        $msg='Wrong OTP';
     }


 }
 if ($type=='resend') {
     $otp= rand(1111,9999);
     $user='User';
     $token =  urlencode("18292788225fdb2a51bfc780.83291265");
      $user_id =  urlencode("16510051");
      $route =  urlencode("TR");
      $template_id =  urlencode("6776");
      $sender_id  =  urlencode("LAMINA");
      $language =  "EN";
      $template =  urlencode("Dear $user, Your MyGuests secret code is - $otp Thanks Lamina Research Center Pvt. Ltd");
      $contact_numbers = urlencode($mobile);
 

      $url = "http://m1.sarv.com/api/v2.0/sms_campaign.php?token=".$token."&user_id=".$user_id."&route=".$route."&template_id=".$template_id."&sender_id=".$sender_id."&language=".$language."&template=".$template."&contact_numbers=".$contact_numbers;


      function httpGet($url)
      {
         $ch = curl_init();  
 
         curl_setopt($ch,CURLOPT_URL,$url);
         curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    
         $output=curl_exec($ch);
 
         curl_close($ch);
         return $output;
      }
        


   
    $sql=mysqli_query($conn,"UPDATE `mg_login` SET `otp` = '$otp' WHERE `mg_login`.`id` = '$id'");
    httpGet($url);

 }






?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">

    <!-- ========== SEO ========== -->
    <title>My Guests</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">

    <!-- ========== FAVICON ========== -->
    <link rel="apple-touch-icon-precomposed" href="images/logomgblack.png" />
    <link rel="icon" href="images/logomgblack.png">

    <!-- ========== STYLESHEETS ========== -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="revolution/css/layers.css" rel="stylesheet" type="text/css" />
    <link href="revolution/css/settings.css" rel="stylesheet" type="text/css" />
    <link href="revolution/css/navigation.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link href="css/animate.min.css" rel="stylesheet" type="text/css">
    <link href="css/famfamfam-flags.css" rel="stylesheet" type="text/css">
    <link href="css/magnific-popup.css" rel="stylesheet" type="text/css">
    <link href="css/owl.carousel.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/responsive.css" rel="stylesheet" type="text/css">

    <!-- ========== ICON FONTS ========== -->
    <link href="fonts/font-awesome.min.css" rel="stylesheet">
    <link href="fonts/flaticon.css" rel="stylesheet">

    <!-- ========== GOOGLE FONTS ========== -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900%7cRaleway:400,500,600,700" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div id="smoothpage" class="wrapper">

        <!-- ========== TOP MENU ========== -->
      
      

        <!-- =========== PAGE TITLE ========== -->
    

        <!-- =========== MAIN ========== -->
        <main id="booking_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                     
                    </div>

                    <div class="col-md-6">
                        <div id="booking_advanced">

                            <div class="main_title a_left upper">
                                <h4>Please Verified your OTP</h4>
                            </div>
                            <!-- ========== BOOKING FORM ========== -->
                            <div class="row">
                                <form action="otp.php" method="post" class="booking_form_advanced">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>4 digit OTP</label>
                                            <strong style="color:red;">*</strong>
                                            <input name="otp" type="number" class="form-control"   required>
                                            <br>

                                            <?php
                                                   if ($msg!='') { ?>
                                                       <span style="color:red"><?php echo $msg;?></span>

                                                    <?php 
                                                      
                                                   }
                                             ?>
                                            <br>
                                             <a href="otp.php?type=resend">Resend OTP</a>
  
                                         
                                        </div>

                                    </div>


                              
                                    <div class="col-md-12">
                                        <button type="submit" class="button btn_blue pull-center" name="submit"> Verified </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                     
                    </div>

                </div>
            </div>
        </main>

        <!-- ========== FOOTER ========== -->
       
    </div>

    <!-- ========== BACK TO TOP ========== -->
    <div id="back_to_top">
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </div>

    <!-- ========== NOTIFICATION ========== -->
    <div id="notification"></div>

    <!-- ========== JAVASCRIPT ========== -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="js/jquery.smoothState.js"></script>
    <script type="text/javascript" src="js/moment.min.js"></script>
    <script type="text/javascript" src="js/morphext.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.thumbs.min.js"></script>
    <script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="js/jPushMenu.js"></script>
    <script type="text/javascript" src="js/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="js/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript" src="js/countUp.min.js"></script>
    <script type="text/javascript" src="js/jquery.countdown.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

</body>

</html>

<script type="text/javascript">
    
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

</script>