
<?php
 //connection to the database
 include  '../Database/connect.h';
 


?>
<html>
  <head>
    <!-- Bootstarp Things -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/2a41b7c649.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="index.css">
    <style>
        input{
            width: 50%;
            padding : 10px;

        }
        a{
            text-decoration: none;
            color : white;
            font-size: 25px;
            transition: 0.5s all ease;
            margin-right: 20px;
        }
        

        
        label{
            text-align :center ;
            margin :10px;
            font-size:20px;

        }
        .container{
            text-align:center;
            margin: 10e;
        }
        h3{
            text-align :center;
            margin-top:45px;
            color : cadetblue;

        }
        button{
            margin : 15px;
            width :15%;
            color : cadetblue;
    
        }
        .content{
            position: absolute;
            top:55%;
            left:50%;
            transform :translate(-50%, -50%);
            color : white;
            text-align: center ;
            background-color: rgba(0,0,0,0.5);
            width : 50em;
        
        }

        .form{
    position: absolute;
    top:55%;
    left:45%;
    transform :translate(-50%, -50%);
    color : white;
    text-align: center ; 
    background-color : rgba(0,0,0,0.5); 
    width :40em;
    margin-left:5em;

    }
    .val{
      margin :; 
      margin-left:5em;
      width:30em;
    }
    </style>
  </head>
<body>


    

<!---  Registration form--->
<div class="header" class="main" class="content">

<form class= "form" method="POST">
<h3>Register in the plattform</h3>
  <div class="val">
    <label for="userName" class="form-label">User Name</label>
    <input type="text" class="form-control" id="userName" name="userName" >
  </div>
  <div class="val">
    <label for="email" class="form-label">E-mail</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="val">
    <label for="phoneNumber" class="form-label">Phone Number</label>
    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber"> 
  </div>
  <div class="val">
    <label for="adress" class="form-label">Adress</label>
    <input type="text" class="form-control" id="adress" name="adress">
  </div>
  <div class="val">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="val">
    <label for="confirmPassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
  </div>
  <button type="submit" name="register" class="btn btn-secondary">Register</button>

  <a href="Index.php"> <button type="button" class="btn btn-secondary">Return</button></a>
</form>
</div>
</body>
</html>

<!-- Register Script -->
<?php
   
    session_start();

    //checks if the register button is pressed, if it is, we will start the validations of the fields
    if(isset($_POST['register'])){
      
    //This variables look unnecessary, but they are just to help in the code lenght and compreension
    $username = $_POST['userName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $adress = $_POST['adress'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

      //Comparing the passwords inserted, the condition bellow verify if they ar not matching
    if($password != $confirmPassword){
      echo '<script>alert("The passwords not match!")</script>';
      echo '<script>window.location.href="RegisterPage.php"</script>';
  }else{
      // it means that the passwords match, then lets continue our validations
      //verify if every form input is filled (not empty)
  if(empty($username) || empty($email) || empty($phoneNumber) || empty($adress) || empty($password) || empty($confirmPassword)){
      echo '<script>alert("There are empty field! Please verify your information and try again")</script>';
      echo '<script>window.location.href="RegisterPage.php"</script>';

  }else{
      //lets verify if there is an user in the database with the same name has the user is trying to create
      $getUser = "SELECT username FROM User WHERE username='".$username."'";
      $res = mysqli_query($conn, $getUser);
      $exists = mysqli_num_rows($res);

      //if already exists, the page will send an error message and cancel the registration
      if($exists){
          echo '<script>alert("This Username already exists! Please try another one.")</script>';
          echo '<script>window.location.href="RegisterPage.php"</script>';

      }else {
          // At these point it feels like every single field the user inserted are ok
          //its time to insert the new user in the database

          //first lets encrypt the password
          $password = md5($password);

          //userType to non validated user is 4
          $userType = "Unauthorized_User";

          //lets insert the data on database
          $insertUser = "INSERT INTO User VALUES ('".$username."','".$password."','".$email."','".$phoneNumber."','".$adress."','".$userType."')";
          $query = mysqli_query($conn, $insertUser);

          echo '<script>alert("The Registration is completed. \n Please wait confirmation of one of our Administrators")</script>';
          echo '<script>window.location.href="Index.php"</script>';
      }
  }
  }

    }
?>