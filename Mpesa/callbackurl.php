<?php
     header("Content-Type: application/json");
    session_start();
     $response = '{
         "ResultCode": 0, 
         "ResultDesc": "Confirmation Received Successfully"
     }';
     $mpesaResponse = file_get_contents('php://input');
     $logFile = "mpesaconfirmation.json";
     $log = fopen($logFile, "w");
 
     fwrite($log, $mpesaResponse);
     fclose($log);


     
    
     $mpesaResponse = file_get_contents('mpesaconfirmation.json');
     $callbackContent = json_decode($mpesaResponse);

     $Resultcode = $callbackContent->Body->stkCallback->ResultCode;
     $CheckoutRequestID = $callbackContent->Body->stkCallback->CheckoutRequestID;
     $Amount = $callbackContent->Body->stkCallback->CallbackMetadata->Item[0]->Value;
     $MpesaReceiptNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[1]->Value;
     $PhoneNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[4]->Value;
     $formatedPhone  = str_replace("254", "0" , $PhoneNumber); 
     if ($Resultcode == 0) {

    
      // Connect to DB
      $conn = mysqli_connect("localhost","dennis","12414-Denn!s","projectDB");
      
      $userID = $_SESSION['user_id'];
      $prod_id =  $_SESSION['prod_id'];
      
    
      if ($conn->connect_error) {
          die("<h1>Connection failed:</h1> " . $conn->connect_error);
      } else {
  
  
          $insert = $conn->query("INSERT INTO payment_info VALUES ('$CheckoutRequestID','$Resultcode','$Amount','$MpesaReceiptNumber','$PhoneNumber','$userID','$uri')");
          $conn = null;
      }
  }

     

 
     echo $response;