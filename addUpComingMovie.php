<?php
session_start();
if(!isset($_SESSION['adminUserNamae'])){
    header("location: logout.php");
    exit();
}
require_once("database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['trailerUrl']) && isset($_POST['posterUrl'])){
 $con = new DatabaseCon();
$con->openConnection();
    $trailerUrl  = test_input($_POST['trailerUrl']);
    $posterUrl = test_input($_POST['posterUrl']);
    $query = "insert into upcomingmovies (trailerUrl,pictureUrl) values ('$trailerUrl','$posterUrl')";
    $con->implementQuery($query);
    $con->closeConnection();
    echo"<script>alert(\"added successfully\");</script>";
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
   
  return $data;}
?>
<!DOCTYPE html>
<html>
    <head>

        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        
        <div class="container">
            <h2>Add Upcoming Movie</h2>
            <form id="form1" action="#" method="post">
              <div class="form-group">
                <label for="moviePoster">Movie Poster Url:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Poster Url" name="posterUrl" id="input1">
              </div>
              <div class="form-group">
                <label for="movieTrailer">Movie Trailer Url:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Trailer Url" name="trailerUrl" id="input2">
                </div>
              <button  class="btn btn-primary"  >ADD</button>
                  <button onclick="location.href='http://127.0.0.1:8080/MoviesHub/adminHomePage.php'" class="btn btn-primary">BACK</button>
            </form>
          
          </div>
          
    </body>
</html>