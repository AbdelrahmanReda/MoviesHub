<?php
    session_start();
    if(!isset($_SESSION['adminUserName'])){
        header("Location: logout.php");
        +
        exit();
    }
   require_once("database.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(((isset($_POST['action']))||(isset($_POST['adventure']))||isset($_POST['Animation'])||isset($_POST['Comedy'])||isset($_POST['Drama'])||isset($_POST['Horror'])||isset($_POST['Romance'])||isset($_POST['SciFi']))&&isset($_POST['movieName'])&&isset($_POST['rate'])&&isset($_POST['year'])&&isset($_POST['duration'])&&isset($_POST['postUrl'])&&isset($_POST['coverUrl'])&&isset($_POST['trailerUrl'])&&isset($_POST['movieUrl']))
    {
   $con=new DatabaseCon();
    $con->openConnection();
    $movieName = test_input($_POST['movieName']);
    $movieRate = test_input($_POST['rate']);
    $movieYear = test_input($_POST['year']);
    $movieDuration = test_input($_POST['duration']);
    $moviePost = test_input($_POST['postUrl']);
    $movieCover = $_POST['coverUrl'];
    $movieTrailer = test_input($_POST['trailerUrl']);
    $movieUrl = addcslashes($_POST['movieUrl'],"\\");
    $query="insert into movie(movieName,rate,year,duration,postUrl,coverUrl,trailerUrl,movieUrl) values('$movieName','$movieRate','$movieYear','$movieDuration','$moviePost','$movieCover','$movieTrailer','$movieUrl')";
    $con->implementQuery($query);
    $id = $con->getLastId();
    if(isset($_POST['action'])){
        $query = "insert into gener (generName , movieId) values ('Action','{$id}')";
         $con->implementQuery($query);
    }if(isset($_POST['adventure'])){
        $query = "insert into gener (generName , movieId) values ('Adventure','{$id}')";
         $con->implementQuery($query);
    }if(isset($_POST['Animation'])){
        $query = "insert into gener (generName , movieId) values ('Animation','{$id}')";
         $con->implementQuery($query);
    }if(isset($_POST['Comedy'])){
        $query = "insert into gener (generName , movieId) values ('Comedy','{$id}')";
         $con->implementQuery($query);
    }if(isset($_POST['Drama'])){
        $query = "insert into gener (generName , movieId) values ('Drama','{$id}')";
         $con->implementQuery($query);
    }if(isset($_POST['Horror'])){
        $query = "insert into gener (generName , movieId) values ('Horror','{$id}')";
         $con->implementQuery($query);
    }if(isset($_POST['Romance'])){
        $query = "insert into gener (generName , movieId) values ('Romance','{$id}')";
         $con->implementQuery($query);
    }if(isset($_POST['SciFi'])){
        $query = "insert into gener (generName , movieId) values ('Sci-Fi','{$id}')";
         $con->implementQuery($query);
    }
    $con->closeConnection();
    echo "<script>alert(\"Addition was successful\");</script>";
}
    else{
        echo "<script>alert(\"you must choose a gener\");</script>";
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
    </head>
    <body>
        
        <div class="container">

            <h2>Add New Movie</h2>
            <form id="form1" action="" method="post" >
              <div class="form-group">
                <label for="movieName">Movie Name:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Name" name="movieName"
                       required oninvalid="this.setCustomValidity('Please the movie name !')" oninput="setCustomValidity('')"/>
              </div>
              <div class="form-group">
                <label for="rate">Movie Rate:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Rate" name="rate"
                       required oninvalid="this.setCustomValidity('Please the movie rate !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="year">Movie Release Year:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Release Year" name="year" required oninvalid="this.setCustomValidity('Please enter the release your of the movie !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="duration">Movie Duration:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Duration" name="duration"
                       required oninvalid="this.setCustomValidity('Please enter the duration of the movie !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="postUrl">Movie Poster URL:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Poster URL" name="postUrl"
                       required oninvalid="this.setCustomValidity('Please enter the poster url !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="coverUrl">Movie Cover URL:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Cover URL" name="coverUrl"
                       required oninvalid="this.setCustomValidity('Please enter the cover url !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="trailerUrl">Movie Trailer URL:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Trailer URL" name="trailerUrl"
                       required oninvalid="this.setCustomValidity('Please enter movie trailer url !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="movieUrl">Movie URL:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie URL" name="movieUrl"
                       required oninvalid="this.setCustomValidity('Please enter movie url !')" oninput="setCustomValidity('')">
              </div>
                <h2>Please Select A Genere</h2>
                 <label class="checkbox-inline">
                  <input type="checkbox" name="action">Action
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox"  name="adventure">Adventure
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" name="Animation">Animation
                </label>
                  <label class="checkbox-inline">
                  <input type="checkbox" name="Comedy">Comedy
                </label>
                  <label class="checkbox-inline">
                  <input type="checkbox" name="Drama">Drama
                </label>
                  <label class="checkbox-inline">
                  <input type="checkbox" name="Horror">Horror
                </label>
                  <label class="checkbox-inline">
                  <input type="checkbox" name="Romance">Romance
                </label>
                  <label class="checkbox-inline">
                  <input type="checkbox" name="SciFi">SciFi
                </label>
                <br>
                <br>
                <button  class="btn btn-primary">ADD</button>
                <button onclick="location.href='http://127.0.0.1:8080/MoviesHub/adminHomePage.php'" class="btn btn-primary">BACK</button>
            </form>
        </div>
          
    </body>
</html>
