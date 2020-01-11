<?php
session_start();
$email=$password="";
$emailError=$passwordError="";
$check=true;
require_once("database.php");

if (empty($_POST["signInMail"])) {
    $emailError = "Email is required";
      $check=false;
  } else {
    $email = test_input($_POST["signInMail"]);
  }
    
  if (empty($_POST["signInPassword"])) {
    $password = "password is required";
      $check=false;
  } else {
    $password = test_input($_POST["signInPassword"]);
  }

   if($check)
   {
          $con=new DatabaseCon();
      if( $con->openConnection())
      {
       $query="select username from user where email = '$email' and password = '$password' " ;
            $con->selectFromDatabase($query);
          $data = $con->getDataFromSelect();
          if($data != null)
          {
                $row = $data->fetch_assoc();
                $_SESSION['userName'] = $row['username'];
               $con->closeConnection();
                header('Location: homePage2.php');
          }else{
               $con->closeConnection();
               header('Location: index.php');
          }
      }
   }    
else{
    header('Location: index.php');
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
   
  return $data;
}

?>