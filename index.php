<?php
session_start();
session_unset();
session_destroy();
?>
<!doctype html >

<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>title goes here</title>
        <link rel="stylesheet" href="stylesheet.css">
        
    </head>
    <body >
<?php
$name =$email=$password="";
$nameError=$emailError=$passwordError="";
$check=true;
require_once("database.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   if (empty($_POST["signUpName"])) {
    $nameError = "Name is required";
       $check=false;
  } else {
    $name = test_input($_POST["signUpName"]);
  }
  
  if (empty($_POST["signUpEmail"])) {
    $emailError = "Email is required";
      $check=false;
  } else {
    $email = test_input($_POST["signUpEmail"]);
  }
    
  if (empty($_POST["signUpPassword"])) {
    $password = "password is required";
      $check=false;
  } else {
    $password = test_input($_POST["signUpPassword"]);
  }
    if($check)
    {
        $con=new DatabaseCon();
       if( $con->openConnection())
       {
        $query="insert into user(username,email,password) values('{$name}','{$email}','{$password}')";
           if($con->implementQuery($query)){
              $con->closeConnection();
               $_SESSION['userName']=$name;
               header("Location: homePage2.php");
           }else{
               $con->closeConnection();
               header("Location: index.php");
           }
       }
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


        <div class="container" id="container">
            
            <div class="form-container sign-up-container">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <h1>Create Account</h1>
                    <input type="text" placeholder="Name" name="signUpName" id="signUpName" required oninvalid="this.setCustomValidity('Please Enter Your Name!')" oninput="setCustomValidity('')" >
                    <input type="email" placeholder="Email" name="signUpEmail" id="signUpEmail" required oninvalid="this.setCustomValidity('please Enter Your Mail!')" oninput="setCustomValidity('')">
                    <input type="password" placeholder="Password" name="signUpPassword" id="signUpPassword" required oninvalid="this.setCustomValidity('please Enter Your Password!')" oninput="setCustomValidity('')">
                    <button id = >Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="signInValidation.php" method="post">
                    <h1>Sign in</h1>
                    <input type="email" placeholder="Email" name="signInMail" id="signInMail" required oninvalid="this.setCustomValidity('please Enter Your mail!')" oninput="setCustomValidity('')">
                    <input type="password" placeholder="Password" name="signInPassword" id="signInPassword" required oninvalid="this.setCustomValidity('please Enter Your password!')" oninput="setCustomValidity('')">
                    <button>Sign In</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
       

    </body>
    
</html>


<script type="text/javascript" >
        
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });

        function x()
        {
            var email = document.getElementById("signInMail").value;
            alert(email);
        }
        

        </script>