<?php
session_start();
if(isset($_SESSION['movieId']) && isset($_SESSION['adminUserName']))
{
    require_once("database.php");
    $con = new DatabaseCon;
    $con->openConnection();
    $query = "select * from movie where movieId = '{$_SESSION['movieId']}' ";
    $con->selectFromDatabase($query);
    $data =  $con->getDataFromSelect();    
    if($data != null)
    {
        $fetched = $data->fetch_assoc();
        $movieData = array();
        $movieData[0] =$fetched["movieName"] ;
        $movieData[1] =$fetched["rate"] ;
        $movieData[2] =$fetched["year"] ;
        $movieData[3] =$fetched["duration"] ;
        $movieData[4] =$fetched["postUrl"] ;
        $movieData[5] =$fetched["trailerUrl"] ;
        $movieData[6] = addcslashes($fetched["movieUrl"],"\\") ;
        $movieData[7] = $fetched["coverUrl"];
        $query= "select generName from gener join movie on gener.movieId = '{$_SESSION['movieId']}'";
        $con->selectFromDatabase($query);
        $data2 = $con->getDataFromSelect();
        if($data2 != null){
            $movieGener = array();
            $index=0;
            while($row = $data2->fetch_assoc() ){
                $movieGener[$index]=$row['generName'];
                $index++;
            }
        }
    }
    $con->closeConnection();
}
else{
    header("location: logout.php");
    exit();
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
            <h2>Update A Movie</h2>
            <form id="form1" action="updatev3.php" method="post">
              <div class="form-group">
                <label for="movieName">Movie Name:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Name" name="movieName" id="input1"required oninvalid="this.setCustomValidity('Please the movie name !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="rate">Movie Rate:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Rate" name="rate" id="input2"required oninvalid="this.setCustomValidity('Please the movie rate !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="year">Movie Release Year:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Release Year" name="year" id="input3"required oninvalid="this.setCustomValidity('Please the movie year !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="duration">Movie Duration:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Duration" name="duration" id="input4"
                       required oninvalid="this.setCustomValidity('Please the movie duration !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="postUrl">Movie Poster URL:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Poster URL" name="postUrl" id="input5"required oninvalid="this.setCustomValidity('Please the movie post url !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="coverUrl">Movie Cover URL:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Cover URL" name="coverUrl" id="input8"required oninvalid="this.setCustomValidity('Please the movie cover url !')" oninput="setCustomValidity('')">
              </div>    
              <div class="form-group">
                <label for="trailerUrl">Movie Trailer URL:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie Trailer URL" name="trailerUrl" id="input6"
                       required oninvalid="this.setCustomValidity('Please the movie trailer url !')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="movieUrl">Movie URL:</label>
                <input type="text" class="form-control"  placeholder="Enter Movie URL" name="movieUrl" id="input7"
                       required oninvalid="this.setCustomValidity('Please the movie url !')" oninput="setCustomValidity('')">
              </div>
               

              <h2>Please Select A Genere</h2>
                <label class="checkbox-inline">
                  <input type="checkbox" name="Action" id="Action">Action
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox"  name="Adventure" id="Adventure">Adventure
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" name="Animation" id="Animation">Animation
                </label>
                  <label class="checkbox-inline">
                  <input type="checkbox" name="Comedy" id="Comedy">Comedy
                </label>
                  <label class="checkbox-inline">
                  <input type="checkbox" name="Drama" id="Drama">Drama
                </label>
                  <label class="checkbox-inline">
                  <input type="checkbox" name="Horror" id="Horror">Horror
                </label>
                  <label class="checkbox-inline">
                  <input type="checkbox" name="Romance" id="Romance">Romance
                </label>
                  <label class="checkbox-inline">
                  <input type="checkbox" name="Sci-Fi" id="Sci-Fi">SciFi
                </label>
                <br>
              <button  class="btn btn-primary"  >Update</button>
              <button onclick="location.href='http://127.0.0.1:8080/MoviesHub/adminHomePage.php'" class="btn btn-primary">BACK</button>
            </form>
          </div>
    </body>
</html>
<script>
    function fillForm()
    {
        
        var movieData = <?php echo '["' . implode('","', $movieData) . '"]'; ?>;
        var movieGener = <?php echo '["' . implode('","', $movieGener) . '"]'; ?>;
        document.getElementById("input1").setAttribute("value",movieData[0]);
        document.getElementById("input2").setAttribute("value",movieData[1]);
        document.getElementById("input3").setAttribute("value",movieData[2]);
        document.getElementById("input4").setAttribute("value",movieData[3]);
        document.getElementById("input5").setAttribute("value",movieData[4]);
        document.getElementById("input6").setAttribute("value",movieData[5]);
        document.getElementById("input7").setAttribute("value",movieData[6]);
        document.getElementById("input8").setAttribute("value",movieData[7]);
        var i=0;
        for(i;i<movieGener.length;i++){
                document.getElementsByName(movieGener[i])[0].checked=true;
        }
    }
function submitForms()
    {
        
        document.getElementById("form1").submit();
        document.getElementById("form2").submit();
    }
    window.onload(fillForm());
</script>
