<?php 


include 'database/dbconfig.php';
session_start();

if (isset($_POST['submit'])) {

	$name = $conn -> real_escape_string($_POST['name']);
    $email = $conn -> real_escape_string($_POST['email']);
    $mobile = $conn -> real_escape_string($_POST['mobile_no']);
    $state = $conn -> real_escape_string($_POST['state']);
    $password = $conn -> real_escape_string($_POST['password']);

    $otp= rand(1111,9999);

    $date=date('Y-m-d');

    $sql=mysqli_query($conn,"SELECT * FROM `mg_login` WHERE `mobile`='$mobile' and `otp_verified`=1");
    $result=mysqli_num_rows($sql);

    if ($result >=1) {

    	echo '<script type="text/javascript">';
        echo 'alert("This Number Already Exists");';
        echo 'window.location.href = "registration.php";';
        echo '</script>';
    	
    }else{
   
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



    $sql=mysqli_query($conn,"INSERT INTO `mg_login` (`id`, `name`, `email`, `mobile`, `state`, `password`, `otp`, `otp_verified`, `date`, `updated_at`, `status`) VALUES (NULL, '$name', '$email', '$mobile', '$state', '$password', '$otp', '0', '$date', current_timestamp(), '0')");

    $id=mysqli_insert_id($conn);
    

    if ($sql==true) {

        httpGet($url);
        $_SESSION['id'] = $id;
        $_SESSION['mobile_no'] = $mobile;
    	echo '<script type="text/javascript">';
        echo 'window.location.href = "otp.php";';
        echo '</script>';
    	
    }else{

       echo '<script type="text/javascript">';
        echo 'alert("Something Wrong !");';
        echo 'window.location.href = "registration.php";';
        echo '</script>';
    }
}

    

	
}

?>
