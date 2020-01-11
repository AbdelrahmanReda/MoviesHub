<?php
session_start();
if(!isset($_SESSION['adminUserName'])){
    header("location: logout.php");
    exit();
}
if(isset($_POST['ActorOneName'])&&isset($_POST['ActorOnePhotoUrl'])&&isset($_POST['ActorTwoName'])&&isset($_POST['ActorTwoPhotoUrl'])&&isset($_POST['ActorThreeName'])&&isset($_POST['ActorThreePhotoUrl'])&&isset($_POST['ActorFourName'])&&isset($_POST['ActorFourPhotoUrl']))
{
require_once("database.php");
$con = new DatabaseCon();
$con->openConnection();
$actorOneName = test_input($_POST['ActorOneName']);
$actorOnePhotoUrl = test_input($_POST['ActorOnePhotoUrl']);
    $actorTwoName = test_input($_POST['ActorTwoName']);
$actorTwoPhotoUrl = test_input($_POST['ActorTwoPhotoUrl']);
    $actorThreeName = test_input($_POST['ActorThreeName']);
$actorThreePhotoUrl = test_input($_POST['ActorThreePhotoUrl']);
    $actorFourName = test_input($_POST['ActorFourName']);
$actorFourPhotoUrl = test_input($_POST['ActorFourPhotoUrl']);
$query = "update  topactors set actorName='$actorOneName',pictureUrl='$actorOnePhotoUrl' where topActorId='1' ";
$con->update($query);
$query = "update  topactors set actorName='$actorTwoName',pictureUrl='$actorTwoPhotoUrl' where topActorId='3' ";
$con->update($query);
$query = "update  topactors set actorName='$actorThreeName',pictureUrl='$actorThreePhotoUrl' where topActorId='5' ";
$con->update($query);
$query = "update  topactors set actorName='$actorFourName',pictureUrl='$actorFourPhotoUrl' where topActorId='7' ";
$con->update($query);
$con->closeConnection();
echo"<script>alert(\"added successfully\");</script>";
header("location: topActorsForm.php");
exit();
}
else{
    echo"<script>alert(\"wrong inputs\");</script>";
header("location: topActorsForm.php");
    exit();
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
   
  return $data;}
?>