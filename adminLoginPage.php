<?php
session_start();
require_once("database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['adminEmail']) && isset($_POST['adminPassword'])){
        $con = new DatabaseCon();
        $con->openConnection();
        $adminEmail = test_input($_POST['adminEmail']);
        $adminPassword = test_input($_POST['adminPassword']);
        $query = "select username from admin where email = '$adminEmail' and password = '$adminPassword'";
        $con->selectFromDatabase($query);
        $data = $con->getDataFromSelect();
        if($data != null){
            $row =$data->fetch_assoc();
            $_SESSION['adminUserName'] = $row ["username"];
            $con->closeConnection();
            header('Location: adminHomePage.php');
            exit();
             
        }else{
              $con->closeConnection();
        echo "<script>alert(\"Wrong email or password\");</script>";
        }
      
    }
    
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
   
  return $data;
}
?>
<!DOCTYPE html>
<html>
    <head>
<title>admin page</title>
<link rel="stylesheet" href="adminStyle.css">
    </head>
    <body>
        <div class="container" id="container">

        <div class="admin-login">

            <form action="" method="post"> 
                <h2>welcome admin</h2>
                <input type="email" name="adminEmail" id="adMail" placeholder="Email" required oninvalid="this.setCustomValidity('Please Enter Your Email !')" oninput="setCustomValidity('')">
                <input type="password" name="adminPassword" id="adPass" placeholder="Password"
                       required oninvalid="this.setCustomValidity('Please Enter Your Password !')" oninput="setCustomValidity('')">
                <button id="logSubmit">LogIn</button>
            </form>
        </div>
       
        
        </div>
        
    </body>
</html>