<?php
    
if(isset($_POST["button"]))
{
    $generName=$_POST["button"];
    require_once("database.php");
    $con = new DatabaseCon();
    $con->openConnection();
    $query = "select movieName,rate,postUrl from movie inner join gener on movie.movieId = gener.movieId where gener.generName = '{$generName}'";
    $con->selectFromDatabase($query);
    $data = $con->getDataFromSelect();
    $movies=array();
    $cat = $generName;
    $i=0;
    while($row = $data->fetch_assoc()){
        $movies[$i]=$row['movieName'];
        $i++;
        $movies[$i]=$row['rate'];
        $i++;
        $movies[$i]=$row['postUrl'];
        $i++;
    }
    $con->closeConnection();
}
?>
<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:800&display=swap" rel="stylesheet">
    <style>
.badge {
    float: left;
width: 45px;
  padding: 1px 1px 2px;
  font-size: 10.025px;
  font-weight: bold;
    text-align: center;
    margin-right: 7px;
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
            height: 240px;
            width: 210px;
           margin-right: 5px;
           
           background-color: yellow;
           
            
            background-position: top;
            box-shadow: 0px 10px 20px -5px rgba(0, 0, 0, .8);
            transition: 0.4s;
       
            cursor: pointer;
           
            
        }

        #cardText {
           
               
                float: left;
                text-align: left;
                color: white;
                font-family: 'Montserrat', sans-serif;
                font-size: 15px;
                margin-left: 10px;
                margin-top: 170px;
           
            }

        .checked {
            color: orange;
        }

        #container {
            
           margin-top: 150px;
            margin-left: 80px;
           float:left;
         
            
            
           
            width:1179px;
            height:auto;
            
           
           
         
           
           
        }

        .unckecked {
            color: gray;

        }

        #stars {
            padding-top: 160px;
            padding-right: 10px;
        }

         #newbutton{
            float: left;
            
            padding: 0px;
            width: 1px;
            margin-right:230px;
            margin-top: 20px;
            
            border: none;
            outline: none;
            
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
            width: 81.69%;
            
        }



        body {


            position: relative;
            
           
            margin: 0px;
            padding: 0px;
        }

        #sidebar {
            

            background-color:#F0F0F0;
           
            float:left;
            
           

        
          
            height: 100%;
            width: 250px;

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
            background-image: linear-gradient(to top, #000000 5%, #020202 5%, transparent), url(https://emileeid.files.wordpress.com/2012/11/gangster-squad-banner.jpg);
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
            top:30px;
            left:400px;
            
           
            

         
        }


        #searchBarInputText {


            outline: none;
            border: 0px;
            font-family: 'Open Sans', sans-serif;
            color: gray;
            padding-left: 50px;
            padding-right: 200px;
            font-size: 18px;
            position: absolute;
            
            
            background-color: rgba(255, 255, 255, 0.884);
            border-radius: 40px;
            width: 1000px;
            height: 50px;
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
            height: 50px;
            border-radius: 50px;
            left:1057px;
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
            margin-top:100px;
            margin-right:20px;
            float:right;
            width: 1280px;
            height: 500px;
         


        }


        #actorOne {
            transition: 0.4s;
            background-image: url(https://upload.wikimedia.org/wikipedia/commons/6/60/Scarlett_Johansson_by_Gage_Skidmore_2_%28cropped%29.jpg);
            position: absolute;
            background-size: cover;
            background-blend-mode: multiply;
            width: 300px;
            height: 450px;
            background-color: #F70059;
            -webkit-box-shadow: -1px 18px 23px -17px #F70059;
            -moz-box-shadow: -1px 18px 23px -17px#F70059;
            box-shadow: -1px 18px 23px -17px #F70059;
            border-radius: 20px;
            left:375px;
            margin-top:-25px;

          
        }

        #actorTwo {
            transition: 0.4s;
            position: absolute;
            background-image: url(https://vignette.wikia.nocookie.net/prowrestling/images/a/ad/Wwe_the_rock_png_by_double_a1698_day9ylt-pre_%281%29.png/revision/latest?cb=20190225014047);
            background-repeat: no-repeat;
            background-size: cover;
            background-blend-mode: multiply;
            width: 300px;
            height: 450px;
            background-color: #F7BA00;
            -webkit-box-shadow: 0px 34px 26px -37px rgba(247,186,0,1);
        -moz-box-shadow: 0px 34px 26px -37px rgba(247,186,0,1);
                box-shadow: 0px 34px 26px -37px rgba(247,186,0,1);

            border-radius: 20px;
            left:705px;
           
          
        }


        #actorThree {
            transition: 0.4s;
            background: linear-gradient(to top, #000000 10%, #020202 10%, transparent);
            background-image: url(https://m.media-amazon.com/images/M/MV5BNzg1MTUyNDYxOF5BMl5BanBnXkFtZTgwNTQ4MTE2MjE@._V1_.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-blend-mode: multiply;


            position: absolute;

            width: 300px;
            height: 450px;
           

            -webkit-box-shadow: 0px 34px 26px -37px rgba(7,171,208,1);
-moz-box-shadow: 0px 34px 26px -37px rgba(7,171,208,1);
box-shadow: 0px 34px 26px -37px rgba(7,171,208,1);  border-radius: 20px;
            
        }


        #actorFour {
            transition: 0.4s;
            background-blend-mode: multiply;
            background-image: url(https://media.vanityfair.com/photos/5c0805f31326825d3bf1145a/1:1/w_1333,h_1333,c_limit/t-Kevin-Hart-Hosts-Oscars.jpg);
            background-repeat: no-repeat;
            background-size: cover;

            position: absolute;

            width: 300px;
            height: 450px;
            background-color: #6439B1;
            margin-top:-25px;


            -webkit-box-shadow: 0px 34px 26px -37px rgba(100,57,177,1);
-moz-box-shadow: 0px 34px 26px -37px rgba(100,57,177,1);
box-shadow: 0px 34px 26px -37px rgba(100,57,177,1);


            border-radius: 20px;
            left:1030px;
          
        }

        #ACTOR_OF_THE_WAEK {
            position: absolute;
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
            width:100%;
            height:200px;


        }
        
        #CAT{


            margin:0px;
            margin-top:150px;
            margin-left:50px;
            padding:0px;

        }
        #sideBarBtn{
            transition: width 2s;
            
            outline: none;
            cursor: pointer;
            width:100%;
            height:55px;
            border:none;
            
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


        #btnBack{
            top: 50px;
            left: 30px;
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





 
    <form id="sidebar" method="post" action="#">
    <div onclick="location.href='http://127.0.0.1:8080/MoviesHub/deleteMovie.php';"  id = "btnBack"></div>

    <h3 id="CAT">CATEGORIES</h3><br><br>
    <input  class="Action" id="sideBarBtn" type="submit" name="button" value="Action"/>
    <input  class="Adventure" id="sideBarBtn" type="submit" name="button" value="Adventure">
    <input  class="Animation" id="sideBarBtn" type="submit" name="button" value="Animation">
    <input  class="Comedy" id="sideBarBtn" type="submit" name="button" value="Comedy">
    <input  class="Drama" id="sideBarBtn" type="submit" name="button" value="Drama">
    <input  class="Horror" id="sideBarBtn" type="submit" name="button" value="Horror"> 
    <input  class="Romance" id="sideBarBtn" type="submit" name="button" value="Romance">
    <input  class="SciFi" id="sideBarBtn" type="submit" name="button" value="SciFi">
    
   
       
        
    </form>  
 

    <div id="searchbar"> 
        <form>
            <input placeholder="ENTER THE FILM NAME YOU WANT TO SEARCH..." id="searchBarInputText" type="text"
                name="FirstName" value="">
        </form>
        <button id="searchBtn" type="button">SEARCH</button>
        <img id="magnifier" src="magnifier.png" alt="Italian Trulli">
    </div>



        
        <form  id="container" action="advancedResultBox.php" method="post">
        
        
 </form>










     


 

<div id="footer">

    </div>


  

</body>
</html>






<script type="text/javascript">
    



   


 
    function addCard(){
       
        var card = <?php echo '["' . implode('","', $movies) . '"]'; ?>;
    
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
    var endl = document.createTextNode("\n");
    child3.appendChild(endl);
    var br = document.createElement("br");
    child3.appendChild(br);
    var endl2 = document.createTextNode("\n");
    child3.appendChild(endl2);
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
        
       
    
            
            
            
            
        
    child2.appendChild(child3);
    child.appendChild(child2);
    parent.appendChild(child);
    var catName = '<?php echo $cat ?>';
    var cat = document.getElementsByClassName(catName)[0];
    cat.setAttribute("style","font-weight: 600; border: 1px solid #E3E3E3; width:100%; width: 100%; height: 60px; border-left: 4px solid #f48024; font-family: sans-serif; font-size: 1rem; cursor: pointer; background-color:#E3E3E3 ");
    
    
    }
    
    }
    
    window.onload(addCard());
    
    </script>