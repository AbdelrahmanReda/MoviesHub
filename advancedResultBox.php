<?php
session_start();
if(!isset($_SESSION['userName'])&&!isset($_SESSION['adminUserName'])){
    header("location: logout.php");
    exit();
}
if(isset($_POST["button"]))
{
    $movieName = $_POST["button"];
     require_once("database.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $con = new DatabaseCon;
        $con->openConnection();
        $query = "select * from movie where movieName = '$movieName' ";
        $con->selectFromDatabase($query);
        $data =  $con->getDataFromSelect();
        if($data!=null)
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
        
        }
        $query2 = "SELECT generName FROM gener INNER JOIN movie ON gener.movieId = movie.movieId where gener.movieId='{$fetched['movieId']}'";
        $con->selectFromDatabase($query2);
        $data2 = $con->getDataFromSelect();
        
        $movieGener = array();
        $i=0;
        while($fetched2 = $data2->fetch_assoc())
        {
            $movieGener[$i] =  $fetched2["generName"];
            $i++;
        }
       
    }
}
else{
    header('location: homePage2.php');
    exit();
}
?>
<!DOCTYPE html>
<html>

    <head>


        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

        <link
            href="https://fonts.googleapis.com/css?family=Fira+Sans:400,900|Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
            rel="stylesheet">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,600i,700,700i,800,800i&display=swap"
            rel="stylesheet">
        <style>
            .checked {
                color: orange;
            }

            .unchecked
            {
                color:darkgray;
            }
            #mainContainer {
                
                z-index: 1;
                position: absolute;
                background-position: center;
                background-size: cover;
                margin: 50px;
                width: 1100px;
                height: 500px;
                background-color: black;
                overflow: hidden;
                border-radius: 3px;



            }


            #filmthumbnail {

             
                background-position: center;
                background-repeat: no-repeat;
                background-size: 120%;
                width: 200px;
                height: 260px;
                background-color: blue;
                float: left;
                margin-top: 50px;
                margin-left: 50px;
                border-radius: 3px;
                -webkit-box-shadow: 0px 30px 31px -41px rgba(255, 255, 255, 1);
                -moz-box-shadow: 0px 30px 31px -41px rgba(255, 255, 255, 1);
                box-shadow: 0px 30px 31px -41px rgba(255, 255, 255, 1);
            }

            #filmDetails {
                position: absolute;
                top: 60px;
                left: 310px;
                width: 800px;
                height: 200px;

                transform: scale(1.1, 1.1);

            }

            #preplayfilmName {
                color: white;
                
                font-family: 'Fira Sans', sans-serif;
                font-size: 35px;
                font-weight: 400;
            }

            #rating {
                margin-top: 40px;
                
                width: 700px;
                height: 15 px;
                /* background-color: chocolate; */
                padding-bottom: 10px;
                padding-left: 4px;
                
            }

            #customers {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 220px;
                font-family: 'Open Sans', sans-serif;
                font-size: 10px;
                font-weight: 500;
                color: white;

            }

              #customers td,
            #customers th {
                padding-top: 0px;
            }


            #tableDiscription {
                
                margin-top: 10px;
                float: left;
                color: white;
            }

            #BACK {
                z-index: -1;
                width: 1100px;
                height: 500px;
                position: absolute;

                filter: blur(0.05rem) brightness(50%);

                background-size: cover;

               

            }

            #catoffilm {

                position: absolute;
                width: 800px;
                height: 40px;
                /* background-color: red; */
                top: 170px;

            }

            #category {

                background-color: rgba(255, 0, 0, 0);
                border: 1px solid rgba(255, 255, 255, 0.582);
                color: white;
                padding: 2px 10px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                border-radius: 2px;
                font-size: 9px;
                margin-top: 20px;

                cursor: pointer;

            }


            #playBtn:hover {
                transform: scale(0.9, 0.9);

            }

            #playBtn {
                cursor: pointer;
                transition: 500ms;
                position: absolute;
                width: 15%;
                top: 300px;
                left: 850px;

            }

            .modal-body {

                background-color: black;
            }

            .modal-title {
                color: white;
            }

            .modal-header {
                background-color: black;
            }

            .modal-content {

                background-color: black;
            }

            #youtubeBtn{

                cursor: pointer;
                transition: 500ms;
               
                position: absolute;
                width: 21%;
                top:300px;
                left: 600px;
               
            

            }
            #youtubeBtn:hover {
                transform: scale(0.9, 0.9);

            }





            body {
                background-color:black;
                margin: 0px;
            }
        </style>


    </head>

    <body>



        <div class="container">

            

            <!-- The Modal -->
            <div class="modal fade" id="myModal"    data-keyboard="false" data-backdrop="static" >
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                     
                           
                        
                        </div>

                        <!-- Modal body -->
                        <div  class="modal-body">
                            
                            
                            
                            <iframe id="iframe" width="1080" height="600"
                                   
                                frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                            
                            <!-- Modal footer -->
                            
                            
                            
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            
         
             
                 <!-- The Modal -->
            <div class="modal fade" id="myModalsss" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-xl">
                    <div id="clickbox" class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                     
                           
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                        
                             <video id="video" height="600" width="1080" controls>  
                                </video> 
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            
            


            <div id="mainContainer">
                
                <div id="BACK"> </div>

                <div id="TOPPER">


                </div>


                <img data-toggle="modal" data-target="#myModal" id="youtubeBtn" src="YOUtUBE.png" alt="btn" />

                <img data-toggle="modal" data-target="#myModalsss" id="playBtn" src="watctbtn.png" alt="btn" />
                
                
                <div id="filmDetails">
                    
                    


    

                    <div id="catoffilm">
                        <form action="#" method="POST" id="categoryForm">

                        </form>
                    </div>
                    <div id="tableDiscription">

                        <table id="customers">
                            
                        </table>

                    </div>
                    

                </div>
        
            </div>
            </div>
    


</body>
    </html>

<script>
    
   
    
    window.addEventListener('click', function(e){   
  if (document.getElementById('clickbox').contains(e.target)){
    
  } else{
    // Clicked outside the box
  }
});
    
    
 var movieData = <?php echo '["' . implode('","', $movieData) . '"]'; ?>;
 var movieGener =<?php echo '["' . implode('","', $movieGener) . '"]'; ?>;
 var TOOPER = document.getElementById("TOPPER");
 var filmthumbnail = document.createElement("div");
 filmthumbnail.id = "filmthumbnail";
 filmthumbnail.setAttribute("style","background-image: url("+movieData[4]+")");
 TOOPER.appendChild(filmthumbnail);

 var filmDetails = document.getElementById("filmDetails");
 var ratingDiv = document.createElement("div");
 ratingDiv.id="rating";
 ratingDiv.setAttribute("style","border-bottom: 1px solid rgba(128,128,128,0.418)");
 var preplayfilmName = document.createElement("label");
 preplayfilmName.id = "preplayfilmName";
 var preplayfilmNameText = document.createTextNode(movieData[0]);
 preplayfilmName.appendChild(preplayfilmNameText);
 ratingDiv.appendChild(preplayfilmName);
    
 var newDiv = document.createElement("div");
 
 var stars=5-movieData[1];
 for(var i=0;i<movieData[1];i++)
     {
         
         var starSpan = document.createElement("span");
         starSpan.className = "fa fa-star checked";
         newDiv.appendChild(starSpan);
         var endl = document.createTextNode("\n");
         newDiv.appendChild(endl);
     }
for(var j=0;j<stars;j++)
    {
         var starSpan = document.createElement("span");
         starSpan.className = "fa fa-star unchecked";
         newDiv.appendChild(starSpan);
         var endl = document.createTextNode("\n");
         newDiv.appendChild(endl);
    }
    
    ratingDiv.appendChild(newDiv);
    filmDetails.appendChild(ratingDiv);
    
    var tabelDisc = document.createElement("div");
    tabelDisc.id="tableDiscription";
    
    var tabel = document.createElement("table");
    tabel.id="customers";
    
    var row1 = document.createElement("tr");
    var cell1 = document.createElement("td");
    var cellText1 = document.createTextNode("Duration : "+""+movieData[3]);
   
    cell1.appendChild(cellText1);
    row1.appendChild(cell1);
    tabel.appendChild(row1);
   
    var row2 = document.createElement("tr");
    var cell2 =  document.createElement("td");
    var cellText2 = document.createTextNode("Released Year : "+""+movieData[2]);
    
    cell2.appendChild(cellText2);
    row2.appendChild(cell2);
    tabel.appendChild(row2);
    tabelDisc.appendChild(tabel);
    filmDetails.appendChild(tabelDisc);
    
    var categoryForm = document.getElementById("categoryForm");
    
    for(var i = 0 ; i<movieGener.length;i++)
        {
            var category = document.createElement("input");
            category.id="category";
            category.setAttribute("onclick","location.href = '';")
            category.setAttribute("type","submit");
            category.setAttribute("value",movieGener[i]);
            categoryForm.appendChild(category);
            var endl = document.createTextNode("\n");
            categoryForm.appendChild(endl);
        }
    var iframe = document.getElementById("iframe");
    var vedio=document.getElementById("video");
    iframe.setAttribute("src",movieData[5]);
    var modal_header = document.getElementsByClassName("modal-header")[0];
    var modalTitle = document.createElement("h4");
    var modalButton = document.createElement("button");
    modalButton.className="close";
    modalButton.setAttribute("data-dismiss","modal");
    var buttonText = document.createTextNode("X");
    modalButton.appendChild(buttonText);
    vedio.setAttribute("src",movieData[6]);
    
    vedio.setAttribute("type","video/mp4");
    var modal_header = document.getElementsByClassName("modal-header")[0];
    var modalTitle = document.createElement("h4");
    var modalButton = document.createElement("button");
    modalButton.className="close";
    modalButton.setAttribute("data-dismiss","modal");
    var buttonText = document.createTextNode("X");
    modalButton.appendChild(buttonText);
    
    
    
     
    var modal_header2 = document.getElementsByClassName("modal-header")[1];
    var modalTitle2 = document.createElement("h4");
    var modalButton2 = document.createElement("button");
    modalButton2.className="close";
    modalButton2.setAttribute("data-dismiss","modal");
    var buttonText2 = document.createTextNode("X");
    modalButton2.appendChild(buttonText2);
    modalTitle2.className="modal-title";
    var modalTitleText2 = document.createTextNode(movieData[0]);
    modalTitle2.appendChild(modalTitleText2);
    modal_header2.appendChild(modalTitle2);
    modal_header2.appendChild(modalButton2);
    modalTitle.className ="modal-title";
    var modalTitleText = document.createTextNode(movieData[0]);
    modalTitle.appendChild(modalTitleText);
    modal_header.appendChild(modalTitle);
    modal_header.appendChild(modalButton);
    
    var cover = document.getElementById("BACK");
    cover.setAttribute("style"," background-image: radial-gradient(circle, rgba(36, 17, 0, 0) 0%, rgba(0, 0, 0, 1) 82%), url("+movieData[7]+")");
    
    
        
</script>