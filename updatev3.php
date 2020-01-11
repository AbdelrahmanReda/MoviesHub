<?php
session_start();
 if(isset($_SESSION['movieId'])&&isset($_POST['movieName'] )&& isset($_POST['rate'])&&isset($_POST['coverUrl']) &&isset($_POST['year']) && isset($_POST['duration']) && isset($_POST['postUrl']) && isset($_POST['trailerUrl']) && isset($_POST['movieUrl'])&& (isset($_POST['Action'])||isset($_POST['Adventure'])||isset($_POST['Animation'])||isset($_POST['Comedy'])||isset($_POST['Drama'])||isset($_POST['Horror'])||isset($_POST['Romance'])||isset($_POST['Sci-Fi'])))
{
    require_once("database.php"); 
    echo "<script>alert(\"shit\");</script>";
    $con = new DatabaseCon();
    $con->openConnection();
    $movieName = test_input($_POST['movieName']);
    $movieRate = test_input($_POST['rate']);
    $movieYear = test_input($_POST['year']);
    $movieDuration = test_input($_POST['duration']);
    $moviePoster = test_input($_POST['postUrl']);
     $movieCover= test_input($_POST['coverUrl']);
    $movieTrailer = test_input($_POST['trailerUrl']);
    $movieUrl = addcslashes($_POST['movieUrl'],"\\");              
    $query = "UPDATE movie SET movieName = '$movieName', rate = '$movieRate', year = '$movieYear', duration = '$movieDuration', postUrl = '$moviePoster',coverUrl='$movieCover', trailerUrl = '$movieTrailer', movieUrl = '$movieUrl' where movieId = '{$_SESSION['movieId']}'";
     $con->update($query);
     $query = "delete from gener where movieId = '{$_SESSION['movieId']}'";
     $con->deleteFromDatabase($query);
     if(isset($_POST['Action'])){
        $query = "insert into gener (generName , movieId) values ('Action','{$_SESSION['movieId']}')";
         $con->implementQuery($query);
    }if(isset($_POST['Adventure'])){
        $query = "insert into gener (generName , movieId) values ('Adventure','{$_SESSION['movieId']}')";
         $con->implementQuery($query);
    }if(isset($_POST['Animation'])){
        $query = "insert into gener (generName , movieId) values ('Animation','{$_SESSION['movieId']}')";
         $con->implementQuery($query);
    }if(isset($_POST['Comedy'])){
        $query = "insert into gener (generName , movieId) values ('Comedy','{$_SESSION['movieId']}')";
         $con->implementQuery($query);
    }if(isset($_POST['Drama'])){
        $query = "insert into gener (generName , movieId) values ('Drama','{$_SESSION['movieId']}')";
         $con->implementQuery($query);
    }if(isset($_POST['Horror'])){
        $query = "insert into gener (generName , movieId) values ('Horror','{$_SESSION['movieId']}')";
         $con->implementQuery($query);
    }if(isset($_POST['Romance'])){
        $query = "insert into gener (generName , movieId) values ('Romance','{$_SESSION['movieId']}')";
         $con->implementQuery($query);
    }if(isset($_POST['Sci-Fi'])){
        $query = "insert into gener (generName , movieId) values ('Sci-Fi','{$_SESSION['movieId']}')";
         $con->implementQuery($query);
    }
    $con->closeConnection();
     echo "<script>alert(\"movie updated successfully\");</script>";
     header("location: updateMovie.php");
    exit();
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
   
  return $data;
}
?>