<?php
    session_start();
if(!isset($_SESSION['userName']) && !isset($_SESSION['adminUserName']))
{
    header("location: logout.php");
    exit();
}
    require_once("database.php");
   
        
        $con = new DatabaseCon();
        $con->openConnection();
        $query = "select * from movie";
        $con->selectFromDatabase($query);
        $data = $con->getDataFromSelect();
       if($data!= null)
        {
           $filmData = array();
            $filmGener = array();
            $row2;
            $i=0;
            $j=0;
           while($fetched =$data->fetch_assoc())
           {
            
                    
                $query2 = "SELECT generName FROM gener INNER JOIN movie ON gener.movieId = movie.movieId where gener.movieId='{$fetched['movieId']}'";
                  $con->selectFromDatabase($query2);
                    $data2 = $con->getDataFromSelect();
                   while($row2=$data2->fetch_assoc()){
                       
                        $filmGener[$j] = $row2["generName"];
                        $j++;
                   }
               $filmGener[$j]="|";
                   
                  $j++;  
                    $filmData[$i]=$fetched["movieName"];
                    $i++;
                    $filmData[$i]=$fetched["rate"];
                    $i++;
                    $filmData[$i]=$fetched["postUrl"];
                    $i++;

            
       }  
       }
        $query = "select * from upcomingmovies";
        $con->selectFromDatabase($query);
        $data=$con->getDataFromSelect();
        $images  = array();
        $i=0;
        while($row = $data->fetch_assoc()){
            $images[$i]= $row['pictureUrl'];
            $i++;
        }
        $con->closeConnection();
?>
<!DOCTYPE html>

<html>
<head> 
    <link rel="shortcut icon" type="image/jpg" href="fav.jpg"/>
    <title>MoviesHub Main</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <style>
        
        

#signoutContainer{
    position: absolute;
    left: 30px;
    top:50px;
      
        height:30px;
        width: 300px;

    }

.navbar {
    
top:45px;
left:1100px;
height: 25px;
border-radius:6px;
width: 200px;
overflow: hidden;
}



.dropdown {
    
width: 200px;    
float: left;
overflow: hidden;
}

.dropdown .dropbtn {
border: none;
outline: none;
color: #F2752B;
font-family: 'Open Sans', sans-serif;
font-size: 20px;
font-weight:300;
margin: 0;
}



.dropdown-content {

display: none;
position: absolute;
top:25px;
background-color: white;
min-width: 160px;
box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
border-radius: 5px;
z-index: 1;
}

.dropdown-content a {
float: none;
color: black;
padding: 12px 16px;
text-decoration: none;
display: block;
text-align: left;
font-family: 'Open Sans', sans-serif;
color: #F2752B;

font-size: 14px;
font-weight:300;
}

.dropdown-content a:hover {
background-color: #ddd;
border-radius: 5px;


}

.dropdown:hover .dropdown-content {
display: block;
}

        
        
.badge {
    float: left;
width: 50px;
  padding: 1px 1px 1px;
  font-size: 10.025px;
  font-weight: bold;
    text-align: center;
    margin-right: 4px;
    margin-top: 10px;
 
  color: #ffffff;
  

  border-radius: 2px;
}

.badge-Action {
  background-color: #2abbec;
    
}

.badge-Drama {
  background-color: #800080;
}

.badge-Adventure {
  background-color: #ffa500;
}

.badge-Animation {
  background-color:#468847;
}

.badge-Comedy {
  background-color: #FFC107;
}
.badge-Horror {
  background-color: #FF0000;
}
.badge-Romance {
  background-color: #FFC0CB;
}
.badge-SciFi {
  background-color: #C0C0C0;
}        

.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

        #cardOne {
           
            background-size: cover;
            border-radius: 7px;
            height: 210px;
            width: 180px;
            
            background-position: top;
            box-shadow: 0px 10px 20px -5px rgba(0, 0, 0, .8);
            transition: 0.4s;
       
            cursor: pointer;
            float: left;
            
        }

       #cardText {
           
            position: relative;
            float: left;
           text-align: left;
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-size: 15px;
            margin-left: 5px;
            margin-top: 120px;
            }

        .checked {
            color: orange;
        }

        #container {
          
            margin-top:-50px;
            margin-right: 20px;
           
           float:right;
            width:1200px;
            height:auto;
            
           
           
         
           
           
        }

        .unckecked {
            color: gray;

        }

        #stars {
            padding-top: 160px;
            padding-right: 10px;
        }

        #cardOne:hover {
            transform: scale(1.1, 1.1);
            box-shadow: 5px 5px 30px 15px rgba(0, 0, 0, 0.25),
                -5px -5px 30px 15px rgba(0, 0, 0, 0.22);
        }

        #actorOne:hover {
            transform: scale(0.9, 0.9);
            box-shadow: 5px 5px 30px 15px rgba(0, 0, 0, 0.25),
                -5px -5px 30px 15px rgba(0, 0, 0, 0.22);
        }
        #actorTwo:hover {
            transform: scale(0.9, 0.9);
            box-shadow: 5px 5px 30px 15px rgba(0, 0, 0, 0.25),
                -5px -5px 30px 15px rgba(0, 0, 0, 0.22);
        }
        #actorThree:hover {
            transform: scale(0.9, 0.9);
            box-shadow: 5px 5px 30px 15px rgba(0, 0, 0, 0.25),
                -5px -5px 30px 15px rgba(0, 0, 0, 0.22);
        }
        #actorFour:hover {
            transform: scale(0.9, 0.9);
            box-shadow: 5px 5px 30px 15px rgba(0, 0, 0, 0.25),
                -5px -5px 30px 15px rgba(0, 0, 0, 0.22);
        }

        #coverImage {
            
            height: 550px;
            width: 100%;
            overflow: hidden;
        }

        #magmag {

           
            float:right;
            display:block;
            width: 81.70%;
            
        }



        body {


            position: relative;
            background-color: black;
           
            margin: 0px;
            padding: 0px;
        }

        #sidebar {
            -webkit-box-shadow: 10px 0px 3px -8px rgba(0,0,0,0.23);
-moz-box-shadow: 10px 0px 3px -8px rgba(0,0,0,0.23);
box-shadow: 10px 0px 3px -8px rgba(0,0,0,0.23);
            
            border-radius: 0px 0px  100px 0px ;
            background-color:#F5F4EF;
           
            float:left;
            border: 0.55mpx solid white;

        
          
            height: 890px;
            width: 281.1px;

        }

        #cell {
                
            cursor: pointer;
            width: 250px;
            height: 50px;
            line-height: 50px;
            border-bottom: 1px solid rgba(128, 128, 128, 0.418);
        }

        #cellLabel {
            cursor: pointer;
            
            margin-left: 70px;
            font-family: 'Open Sans', sans-serif;
            font-weight: 400px;
            font-size: 12px;
            color: #808385;
        }

       
        #icon {
            background-color:crimson;
            position: absolute;
            /* z-index: 99; */
            width: 25px;
            height: 21px;
            margin-top: 15px;
            margin-left: 22px;

        }

       
        #banner {

            
            -webkit-box-shadow: -1px 24px 26px -16px rgba(0, 0, 0, 1);
            -moz-box-shadow: -1px 24px 26px -16px rgba(0, 0, 0, 1);
            box-shadow: -1px 24px 26px -16px rgba(0, 0, 0, 1);
           
            background-repeat: no-repeat;
            background-size: cover;
            margin-right:30px;
            
            
          
              float:right;
           
            background-color: blue;
            border-radius: 7px;
            width: 1280px;
            height: 350px;
            margin-top:30px;

           
        }
        #searchbar{
            
          transform: scale(0.7, 0.7);
            position: absolute;
            width:1300px;
            height:70px;
            top:250px;
            left: 150px;
            
           
            

         
        }


        #searchBarInputText {

background-color: blue;
            outline: none;
            border: 0px;
            font-family: 'Open Sans', sans-serif;
            color: gray;
            padding-left: 50px;
            padding-right: 200px;
            font-size: 18px;
            position: absolute;
            
            
            background-color: rgba(255, 255, 255, 0.884);
            border-radius: 7px;
            width: 900px;
            height: 60px;
            -webkit-box-shadow: 0px 16px 38px -13px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 0px 16px 38px -13px rgba(0, 0, 0, 0.75);
            box-shadow: 0px 16px 38px -13px rgba(0, 0, 0, 0.75);

        }

        #magnifier {
            position: absolute;
            width: 25px;
            height: 25px;
            left:14px;
            top:14px;
        }

        #searchBtn {
            background-color: black;
            border-style: solid;
            border-width: 3px;
            border-color: #ce7b15;
            outline: none;
            cursor: pointer;
            position: absolute;
            width: 190px;
            height: 60px;
            border-radius: 7px;
            left:957px;
            background: #CE791D;
            background: -moz-linear-gradient(-45deg, #CE791D 0%, #FF7430 100%, #C57320 100%);
            background: -webkit-linear-gradient(-45deg, #CE791D 0%, #FF7430 100%, #C57320 100%);
            background: linear-gradient(135deg, #CE791D 0%, #FF7430 100%, #C57320 100%);
            color: white;
            font-size: 15px;
            font-family: 'Open Sans', sans-serif;
        }

        #sidebarLogo {

            width: 200px;
            position: relative;
            top: 60px;
            left: 20PX;
        }

  #top_actors {
            margin-top:300px;
            margin-right:20px;
            float:right;
            width: 1280px;
            height: 500px;
         


        }


        #actorOne {
             margin: 10px;
            transition: 0.4s;
            background-image: url(https://upload.wikimedia.org/wikipedia/commons/6/60/Scarlett_Johansson_by_Gage_Skidmore_2_%28cropped%29.jpg);
            
            background-size: cover;
            background-blend-mode: multiply;
            width: 280px;
            height: 430px;
            background-color: #F70059;
            -webkit-box-shadow: -1px 18px 23px -17px #F70059;
            -moz-box-shadow: -1px 18px 23px -17px#F70059;
            box-shadow: -1px 18px 23px -17px #F70059;
            border-radius: 20px;
            float: left;
           

          
        }

        #actorTwo {
             margin: 10px;
            transition: 0.4s;
            
            background-image: url(https://vignette.wikia.nocookie.net/prowrestling/images/a/ad/Wwe_the_rock_png_by_double_a1698_day9ylt-pre_%281%29.png/revision/latest?cb=20190225014047);
            background-repeat: no-repeat;
            background-size: cover;
            background-blend-mode: multiply;
            width: 280px;
            height: 430px;
            background-color: #F7BA00;
            -webkit-box-shadow: 0px 34px 26px -37px rgba(247,186,0,1);
        -moz-box-shadow: 0px 34px 26px -37px rgba(247,186,0,1);
                box-shadow: 0px 34px 26px -37px rgba(247,186,0,1);

            border-radius: 20px;
             float: left;
           
          
        }


        #actorThree {
             margin: 10px;
            transition: 0.4s;
            background: linear-gradient(to top, #000000 10%, #020202 10%, transparent);
            background-image: url(https://m.media-amazon.com/images/M/MV5BNzg1MTUyNDYxOF5BMl5BanBnXkFtZTgwNTQ4MTE2MjE@._V1_.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-blend-mode: multiply;


             float: left;

            width: 280px;
            height: 430px;
            background-color: #07ABD0;

            -webkit-box-shadow: 0px 34px 26px -37px rgba(7,171,208,1);
-moz-box-shadow: 0px 34px 26px -37px rgba(7,171,208,1);
box-shadow: 0px 34px 26px -37px rgba(7,171,208,1);  border-radius: 20px;
            
        }


        #actorFour {
             margin: 10px;
            transition: 0.4s;
            background-blend-mode: multiply;
            background-image: url(https://media.vanityfair.com/photos/5c0805f31326825d3bf1145a/1:1/w_1333,h_1333,c_limit/t-Kevin-Hart-Hosts-Oscars.jpg);
            background-repeat: no-repeat;
            background-size: cover;

           float: left;

            width: 280px;
            height: 430px;
            background-color: #6439B1;
           


            -webkit-box-shadow: 0px 34px 26px -37px rgba(100,57,177,1);
-moz-box-shadow: 0px 34px 26px -37px rgba(100,57,177,1);
box-shadow: 0px 34px 26px -37px rgba(100,57,177,1);


            border-radius: 20px;
            left:1030px;
          
        }

        #ACTOR_OF_THE_WAEK {

            position: absolute;
            left: 90px;
           margin-top:-60px;
            font-family: 'Open Sans', sans-serif;
            font-weight: 800PX;
            font-size: 20PX;
            color: blanchedalmond;
        }



        ::-webkit-scrollbar {
    width: 0px;  /* Remove scrollbar space */
    background: transparent;  /* Optional: just make scrollbar invisible */
        }
      





        ::-webkit-scrollbar {
    width: 0px;  /* Remove scrollbar space */
    background: transparent;  /* Optional: just make scrollbar invisible */
        }
  







        ::placeholder {
            color: rgba(0, 0, 0, 0.418);
            font-size: 15px;
        }
        #curve{
            position: absolute;
            top: 750px;
            left: 0px;
                

        }

        #footer{
            float:right;
            background-image:url("foter.png");
            background-size:cover;
            background-color:black;
            background-size:700px ;
            background-position: center;
            background-repeat: no-repeat;
            margin-bottom: 0PX;
            width:100%;
            height:200px;


        }
        
        #CAT{

            
            margin:0px;
            margin-top:240px;
            margin-left:50px;
            padding:0px;

        }
        #sideBarBtn{
            
       
    border: none;
           width:100%;
            height: 60px;
   
   
 background-color: #F5F4EF;
    color: #000000;
    font-family: sans-serif;
    font-size: 1rem;
    cursor: pointer;
   
    transition: background 250ms ease-in-out, 
                transform 150ms ease;
    -webkit-appearance: none;
    -moz-appearance: none;
            
             
            
        }
 #sideBarBtn:hover{
     font-weight: 600;
     border: 1px solid #E3E3E3;
            
      width:100%;

            width: 100%;
            height: 60px;
   
   
 background-color: #F2F2F2;
    color:black;
     border-left: 4px solid #f48024;
    font-family: sans-serif;
    font-size: 1rem;
    cursor: pointer;
   
    transition: background 250ms ease-in-out, 
                transform 150ms ease;
    -webkit-appearance: none;
    -moz-appearance: none;
            
             
            
        }

        #curve{
          width:250px;
          height:250px;

           

        }
        #signout
        {

left:1200px;
top:50px;
cursor: pointer;
color:white;
    background-color:orange;
    outline: none;
    border:none;
    width:60xpx;
    
border-radius: 4px;
position:absolute;
        }
        
        #newbutton{
            float: left;
            
            padding: 0px;
            width: 0px;
            margin-right: 200px;
            margin-top: 20px;
            
            border: none;
            outline: none;
            
        }
        
        
        
        
 #map{
            background-color:red;
            margin-right:30px;
            border: none;
     }
#mapContainer
	{
        margin-top: 200px;
           
            margin-left:100px;
            padding-right:100px;
            float:left;
            width:1000px;
            height:450px;
        }
        
        
           #ticketsMarch{
              cursor: pointer;

            margin-top: 0px;
            background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRC-WjJGaxQI1X9uWPEscQOMx7-raONCiMO5pIHk90IVLf-3ZOe&s);
            right: 200px;
            position: absolute;
            background-size: contain;
            background-repeat: no-repeat;
            width: 300px;
            height: 100px;
          
            
            float: right;
            
        }
        
                    
 @-webkit-keyframes scroll {
	 0% {
		 -webkit-transform: translateX(0);
		 transform: translateX(0);
	}
	 100% {
		 -webkit-transform: translateX(calc(-250px * 4));
		 transform: translateX(calc(-250px * 4));
	}
}
 @keyframes scroll {
	 0% {
		 -webkit-transform: translateX(0);
		 transform: translateX(0);
	}
	 100% {
		 -webkit-transform: translateX(calc(-250px * 4));
		 transform: translateX(calc(-250px * 4));
	}
}
 .slider {
     

	 background: rgb(223, 16, 16)ff;
	 box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.125);
	 height: 100px;
	 margin: auto;
	 overflow: hidden;
	 position: relative;
	 width: 960px;
}
 .slider::before, .slider::after {
	 background: linear-gradient(to right, white 0%, rgba(255, 255, 255, 0) 100%);
	 content: "";
	 height: 100px;
	 position: absolute;
	 width: 200px;
	 z-index: 2;
}
 .slider::after {
	 right: 0;
	 top: 0;
	 -webkit-transform: rotateZ(180deg);
	 transform: rotateZ(180deg);
}
 .slider::before {
	 left: 0;
	 top: 0;
}
 .slider .slide-track {
	 -webkit-animation: scroll 40s linear infinite;
	 animation: scroll 40s linear infinite;
	 display: flex;
	 width: calc(250px * 8);
}
 .slider .slide {
	 height: 100px;
	 width: 250px;
     background-color: white;
}
#cinemaLogo{
margin-top:200px;   
height: 300px;

}
    html, body {
  margin: 0;
  padding: 0;
}

.pic-ctn {
  width: 100vw;
  height: 200px;
}

@keyframes display {
  0% {
    transform: translateX(200px);
    opacity: 0;
  }
  10% {
    transform: translateX(0);
    opacity: 1;
  }
  20% {
    transform: translateX(0);
    opacity: 1;
  }
  30% {
    transform: translateX(-200px);
    opacity: 0;
  }
  100% {
    transform: translateX(-200px);
    opacity: 0;
  }
}

.pic-ctn {
    margin-top: 40px;
   
  position: relative;
  

  

  
}

.pic-ctn > img {
    background-size: cover;
  background-color: black;
  width:1280px;
  height:350px;
  position: absolute;
  top: 0;
  left: calc(50% - 630px);
  opacity: 0;
  animation: display 20s infinite;
}

img:nth-child(2) {
  animation-delay: 5s;
}
img:nth-child(3) {
  animation-delay: 10s;
}
img:nth-child(4) {
  animation-delay: 15s;
}
img:nth-child(5) {
  animation-delay: 20;
}
        
        #allCombo{
           
            float: left;
            height: 600px;
            margin-top: 60px;
            
            
        }
        
         #UPCOMMING_MOVIES{
            
            float: left;
           
            font-family: 'Open Sans', sans-serif;
            font-weight: 800PX;
            font-size: 20PX;
            color: blanchedalmond;
            margin-left: 100px;
            
            
        }
        
        #btnBack{
            top: 140px;
            left: 40px;
            cursor: pointer;
            position: absolute;
            background-image: url(logo.jpg);
            background-size: contain;
            background-repeat: no-repeat;
            width: 200px;
            height: 100px;
           
        }
        
        
    </style>



</head>

<body>


<div id="signoutContainer">
<div class="navbar">
    <div class="dropdown">
        <button class="dropbtn"><?php echo "Hello".$_SESSION['userName'];?>
        <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
        <a href="logout.php">SIGNOUT</a>
        </div>
    </div> 
    </div>
</div>

   
<img  id="magmag" src="coverOne.jpg"/>

<!--  <img id="homeRef"  onclick="location.href='homePage2.php';"  scr="LOGO.jpg"/>-->
 
    <form id="sidebar" method="post" action="category.php">
        <div onclick="location.href='http://127.0.0.1:8080/MoviesHub/deleteMovie.php';"  id = "btnBack"></div>
      
  
    <h3 id="CAT">CATEGORIES</h3><br><br>
    <input  class="bottonOne" id="sideBarBtn" type="submit" name="button" value="Action"/>
    
    <input  class="bottonTwo" id="sideBarBtn" type="submit" name="button" value="Adventure">
    <input  class="bottonThree" id="sideBarBtn" type="submit" name="button" value="Animation">
    <input  class="bottonFour" id="sideBarBtn" type="submit" name="button" value="Comedy">
    <input  class="bottonFive" id="sideBarBtn" type="submit" name="button" value="Drama">
    <input  class="bottonSix" id="sideBarBtn" type="submit" name="button" value="Horror"> 
    <input  class="bottonSeven" id="sideBarBtn" type="submit" name="button" value="Romance">
    <input  class="bottonEight" id="sideBarBtn" type="submit" name="button" value="Sci-Fi">
    
   
       
        
    </form>  
 

    <div id="searchbar"> 
        <form method="post" action="searchResult2.0.php">
            <input placeholder="ENTER THE FILM NAME YOU WANT TO SEARCH..." id="searchBarInputText" type="text"
                name="FirstName" value=""required oninvalid="this.setCustomValidity('Please enter movie name to search for !')" oninput="setCustomValidity('')">
            <button id="searchBtn" type="submit">SEARCH</button>
        </form>
        
        <img id="magnifier" src="magnifier.png" alt="Italian Trulli">
    </div>



        
        <form  id="container" action="advancedResultBox.php" method="post">
        
        
 </form>





 <div id="allCombo">
    
          <label id="UPCOMMING_MOVIES"> UPCOMMING MOVIES</label>
            <div class="pic-ctn">
        <img src="https://emileeid.files.wordpress.com/2012/11/gangster-squad-banner.jpg" alt="" class="pic">
        <img src="http://cafmp.com/wp-content/uploads/2016/06/Alexander-Banner-716x406.jpg" alt="" class="pic">
        <img src="https://www.relianceentertainment.com/wp-content/uploads/banner-1.png" alt="" class="pic">
        <img src="http://cafmp.com/wp-content/uploads/2016/06/Alexander-Banner-716x406.jpg" alt="" class="pic">
        <img src="https://www.relianceentertainment.com/wp-content/uploads/banner-1.png" alt="" class="pic">
      </div>
        <div id="top_actors">
        <label id="ACTOR_OF_THE_WAEK">TOP ACTORS OF THE WAEK</label>
        <div id="actorOne"></div>
        <div id="actorTwo"></div>
        <div id="actorThree"></div>
        <div id="actorFour"></div>


   

    </div>

        
        <div id="cinemaLogo">


        
        <div class="slider">
            <div class="slide-track">
               
                    <img id="imageOne" src="data:image/jpeg;base64,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" height="100" width="250" alt="" />
               
                <div class="slide">
                    <img src="http://roznamaonline.com/en/images/portfolio-images/portfolio-item-3.jpg" height="100" width="250" alt="" />
                </div>
                <div class="slide">
                    <img src="https://assets.cairo360.com/app/uploads/2016/07/point90cinemas.png" height="100" width="250" alt="" />
                </div>
                <div class="slide">
                    <img src="http://www.citystars-heliopolis.com.eg/public/images/brand_logo/HJv8ZEPFfe-main.jpeg?1507109603986" height="100" width="190" alt="" />
                </div>
                <div class="slide">
                    <img src="https://assets.cairo360.com/app/uploads/2016/07/starscinema-211x211-1482419807.png" height="100" width="250" alt="" />
                </div>
                <div class="slide">
                    <img src="http://www.zawyacinema.com/images/zawyaLogo.jpg" height="100" width="50" alt="" />
                </div>
                <div class="slide">
                    <img src="https://dneegypt.nyc3.digitaloceanspaces.com/2018/09/Cairo-festival-city.jpg" height="100" width="250" alt="" />
                </div>
                <div class="slide">
                    <img src="https://cdn.worldvectorlogo.com/logos/amc-theatres-72805.svg" height="100" width="250" alt="" />
                </div>
               
        </div>

    
    
    </div>

        
        
    </div>

 




     
  <div id="mapContainer">
   
    <div onclick="location.href='https://www.ticketsmarche.com/';"   id="ticketsMarch"> </div>
        <div  style="width: 90%; margin-right:40px ;overflow: hidden; height: 400px;">
            <iframe id="map"
                src="https://www.google.com/maps/d/embed?mid=1HLQchOgt07_x4t8wehnUjuygxXcH7RAw"
                width="100%"
                height="800"
                frameborder="0"
                style="border:0; margin: -150px;">
            </iframe>
        </div>
    </div>
     
         
<div id="footer">

    </div>


     </div>


</body>
</html>






<script type="text/javascript">
    



   


    function addCard(){
    
        
        var card = <?php echo '["' . implode('","', $filmData) . '"]'; ?>;
    
    var i=0;
    var generIndex=0;
    
    for(i;i<card.length;i+=3)
    {
        
       
       
        
    var movieName = card[i];
    
    var movieRating = card[i+1];
    
    var poster = card[i+2];
    
    
    
    var parent = document.getElementById("container");
    
    var child = document.createElement("button");
    child.id="newbutton";
    child.setAttribute("value",movieName);
    child.setAttribute("name","button");
    var child2 = document.createElement("div");
    child2.id = "cardOne";
    child2.setAttribute("style","background-image: linear-gradient( to top , #000000 10%, #020202 10%, transparent) ,url("+poster+")");
    
    var child3 = document.createElement("span");
    child3.id="cardText";
        
    var name = document.createTextNode(movieName);
    

    child3.appendChild(name);
//    var endl = document.createTextNode("\n");
//    child3.appendChild(endl);
    var br = document.createElement("br");
    child3.appendChild(br);
    var counter;
    var maxOO = parseInt(movieRating, 10);
    
    
    for(counter=0;counter<maxOO ;counter++)
    {
        
    
        var star = document.createElement("span");
        star.className="fa fa-star checked";
        child3.appendChild(star);
        var endl3 = document.createTextNode("\n");
        child3.appendChild(endl3);
    }
    var y=5-maxOO;
        
    for(var x = 0;x<y ; x++)
    {
        
    
        var ustar = document.createElement("span");
    ustar.className="fa fa-star unckecked";
    var endl4 = document.createTextNode("\n");
    
        child3.appendChild(endl4);
        child3.appendChild(ustar);
    }
         

    var newLine = document.createElement("br");
    child3.appendChild(newLine);
        
       
    var filmGener = <?php echo '["' . implode('","', $filmGener) . '"]'; ?>;
    
    for(generIndex;generIndex<filmGener.length;)
        {
            if(filmGener[generIndex] == "|"){
                
                generIndex++;
                break;
            }
            
            var child4 = document.createElement("div");
            if(filmGener[generIndex]=="Action")
                {
                    child4.className="badge badge-Action";
                }
            else if(filmGener[generIndex]=="Adventure")
                {
                    child4.className="badge badge-Adventure";
                }
            else if(filmGener[generIndex]=="Animation")
                {
                    child4.className="badge badge-Animation";
                }
            else if(filmGener[generIndex]=="Comedy")
                {
                    child4.className="badge badge-Comedy";
                }
            else if(filmGener[generIndex]=="Drama")
                {
                    child4.className="badge badge-Drama";
                }
            else if(filmGener[generIndex]=="Horror")
                {
                    child4.className="badge badge-Horror";
                }
            else if(filmGener[generIndex]=="Romance")
                {
                    child4.className="badge badge-Romance";
                }
            else if(filmGener[generIndex]=="Sci-Fi")
                {
                    child4.className="badge badge-SciFi";
                }
            
         
            var text = document.createTextNode(filmGener[generIndex]);
            child4.appendChild(text);
            generIndex++;
            child3.appendChild(child4);
        }
    child2.appendChild(child3);
    child.appendChild(child2);
    parent.appendChild(child);
        
    }
        var images2 = <?php echo '["' . implode('","', $images) . '"]'; ?>;
        var pic_ctn = document.getElementsByClassName("pic-ctn")[0];
        if (pic_ctn==null)alert("null");
        alert(imgaes2[0]);
        
                alert("in loop");
                var image = document.createElement("img");
                image.setAttribute("src",images2[0]);
                image.setAttribute("alt","");
                image.className="pic";
                pic_ctn.appendChild(image);
            
        
    
    }
    
     
    

    
    window.onload(addCard(),imagei());
    
    </script>