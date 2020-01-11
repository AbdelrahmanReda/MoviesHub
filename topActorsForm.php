<?php
//save the data in $topActors
session_start();
if(!isset($_SESSION['adminUserName'])){
    header("location: logout.php");
    exit();
}
require_once("database.php");
$con = new DatabaseCon();
$con->openConnection();
$query = "select actorName,pictureUrl from topactors";
$con->selectFromDatabase($query);
$data = $con->getDataFromSelect();
$topActors = array();
$i=0;
while($row = $data->fetch_assoc()){
    $topActors[$i]=$row['actorName'];
    $i++;
    $topActors[$i]=$row['pictureUrl'];
    $i++;
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
            <h2>Update The Top Four Actors</h2>
            <form id="form1" action="updateTopActors.php" method="post">
              <div class="form-group">
                <label for="movieName">Actor One Name:</label>
                <input type="text" class="form-control"  placeholder="Enter Actor One Name" name="ActorOneName" id="input1" required oninvalid="this.setCustomValidity('Please enter actor name !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="rate">Actor One Photo Url:</label>
                <input type="text" class="form-control"  placeholder="Actor One Photo Url" name="ActorOnePhotoUrl" id="input2" required oninvalid="this.setCustomValidity('Please enter actor photo !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="year">Actor Two Name:</label>
                <input type="text" class="form-control"  placeholder="Actor Two Name" name="ActorTwoName" id="input3" required oninvalid="this.setCustomValidity('Please enter actor name !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="duration">Actor Two Poster Url:</label>
                <input type="text" class="form-control"  placeholder="Actor Two Poster Url" name="ActorTwoPhotoUrl" id="input4" required oninvalid="this.setCustomValidity('Please enter actor photo !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="postUrl">Actor Three Name:</label>
                <input type="text" class="form-control"  placeholder="Actor Three Name" name="ActorThreeName" id="input5" required oninvalid="this.setCustomValidity('Please enter actor name !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="trailerUrl">Actor Three Poster Url:</label>
                <input type="text" class="form-control"  placeholder="Actor Three Poster Url" name="ActorThreePhotoUrl" id="input6" required oninvalid="this.setCustomValidity('Please enter actor photo !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="movieUrl">Actor Four Name:</label>
                <input type="text" class="form-control"  placeholder="Actor Four Name" name="ActorFourName" id="input7"required oninvalid="this.setCustomValidity('Please enter actor name !')" oninput="setCustomValidity('')">
              </div>
                <div class="form-group">
                <label for="movieUrl">Actor Four Poster Url:</label>
                <input type="text" class="form-control"  placeholder="Actor Four Poster Url" name="ActorFourPhotoUrl" id="input8" required oninvalid="this.setCustomValidity('Please enter actor photo !')" oninput="setCustomValidity('')">
              </div>

              <button  class="btn btn-primary" >Update</button>
                <button onclick="location.href='http://127.0.0.1:8080/MoviesHub/adminHomePage.php'" class="btn btn-primary">BACK</button>
            </form>
          </div>
          
    </body>
</html>
<script>
function fillForm()
    {
        var topActors =  <?php echo '["' . implode('","', $topActors) . '"]'; ?>;
        
          var actorOneName = document.getElementById("input1");
          actorOneName.setAttribute("value",topActors[0]);
          var actorOnePhoto = document.getElementById("input2");
          actorOnePhoto.setAttribute("value",topActors[1]);
        
        var actorTwoName = document.getElementById("input3");
          actorTwoName.setAttribute("value",topActors[2]);
          var actorTwoPhoto = document.getElementById("input4");
          actorTwoPhoto.setAttribute("value",topActors[3]);
        
        var actorThreeName = document.getElementById("input5");
          actorThreeName.setAttribute("value",topActors[4]);
          var actorThreePhoto = document.getElementById("input6");
          actorThreePhoto.setAttribute("value",topActors[5]);
        
        var actorFourName = document.getElementById("input7");
          actorFourName.setAttribute("value",topActors[6]);
          var actorFourPhoto = document.getElementById("input8");
          actorFourPhoto.setAttribute("value",topActors[7]);
          
                
            
    }
    window.onload(fillForm());
</script>