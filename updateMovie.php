<?php
session_start();
if(!isset($_SESSION['adminUserName'])){
    header("Location: logout.php");
    exit();
}
require_once("database.php");
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['movieName']))
{
    $con = new DatabaseCon();
    $con->openConnection();
    $movieName = test_input($_POST['movieName']);
    $query="select movieId from movie where movieName = '$movieName' ";
    $con->selectFromDatabase($query);
    $data = $con->getDataFromSelect();
    if($data != null){
        $id = $data->fetch_assoc();
        $_SESSION['movieId']=$id['movieId'];
        $con->closeConnection();
        header("Location: updatev2.php");
        exit();
    }else{
        $con->closeConnection();
     echo "<script>alert(\"this movie doesn't exist\");</script>";
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
       
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        

        
       
        <style>
       .container{
         margin-top:50px;
       }
        </style>
    </head>
    <body>
    <div class="container" div="div1">
  <h2 id="h2">Please Select a Movie by its Name</h2>
  <form action="" method="post" >
    <div class="form-group">
      <label for="movieName">Movie Name:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter Movie Name" name="movieName" required oninvalid="this.setCustomValidity('please Enter Your The Movie Name!')" oninput="setCustomValidity('')">
    </div>
    <button type="submit" class="btn btn-primary" onclick="x()">Select</button>
  </form>
</div>



    </body>
</html>
<script>
    

  
  </script>