<?php
session_start();
if(!isset($_SESSION['adminUserName'])){
    header("Location: logout.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
    .container
        {
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
  <h2>Admin Operation</h2>
  <p>Please Select an Operation!</p>
  <ul class="pagination">
    
    <li class="page-item" id="1"><a class="page-link" href="http://127.0.0.1:8080/MoviesHub/addMovie.php" >Add Movie</a></li>
    <li class="page-item" id="2"><a class="page-link" href="http://127.0.0.1:8080/MoviesHub/deleteMovie.php">Delete Movie</a></li>
    <li class="page-item" id="3"><a class="page-link" href="http://127.0.0.1:8080/MoviesHub/updateMovie.php">Update Movie</a></li>
      <li class="page-item" id="3"><a class="page-link" href="http://127.0.0.1:8080/MoviesHub/topActorsForm.php">Update Top Actors</a></li>
      <li class="page-item" id="3"><a class="page-link" href="http://127.0.0.1:8080/MoviesHub/addupComingMovie.php">Add Upcoming Movie</a></li>
      <li class="page-item" id="4"><a class="page-link" href="http://127.0.0.1:8080/moviesHub/homePage2.php">Monitor Website</a></li>
      <li class="page-item" id="5"><a class="page-link" href="http://127.0.0.1:8080/MoviesHub/logout.php">Logout</a></li>
   
  </ul>
</div>

</body>
</html>
<script>

</script>
