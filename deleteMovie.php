<?php
session_start();
if(!isset($_SESSION['adminUserName'])){
    header("Location: logout.php");
    exit();
}
require_once("database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['movieName'])){
    $con=new DatabaseCon();
    $con->openConnection();
    $movieName = test_input($_POST['movieName']);
    $query="select movieId from movie where movieName='$movieName'";
    $con->selectFromDatabase($query);
    $data=$con->getDataFromSelect();
    if($data != null){
          $id = $data->fetch_assoc();
          $query = "delete from movie where movieName='$movieName'";
          $con->deleteFromDatabase($query);
          $query = "delete from gener where movieId = '{$id['movieId']}'";
          $con->deleteFromDatabase($query);  
        $con->closeConnection();
        echo "<script>alert(\"the movie is deleted successfully\");</script>";
    }
    else{
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <style>
        .container
        {
            margin-top: 50px;
        }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Delete A Movie</h2>
            <form action="#" method="post">
              <div class="form-group">
                <label for="movieName">Movie Name:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Name" name="movieName" required oninvalid="this.setCustomValidity('please Enter the Movie Name !')" oninput="setCustomValidity('')">
              </div>
            <button type="submit" class="btn btn-primary">DELETE</button>
            <button onclick="location.href='http://127.0.0.1:8080/MoviesHub/adminHomePage.php'" class="btn btn-primary">BACK</button>
            </form>
          </div>

    </body>
</html>