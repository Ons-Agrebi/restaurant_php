

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Login</title>
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
        h2{
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
    </style>
</head>
<body class="header">
<nav>
      <div class="logo">
         <a class="a" href="index.php" >OA_Foods</a>
      </div>
    </nav>
<div class="main" >
  <div class="content">
    <form action="" method="POST">
      
      <h2>Login to your profile</h2>
      <div class="col-md-4">
        <label for="userName" class="form-label">User Name</label> <br>
        <input type="text" class="form-control" id="userName" name="userName"  >
      </div>
      <div class="col-md-4">
        <label for="password" class="form-label">Password</label> <br>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <button type="submit" name="login" class="btn btn-secondary">Login</button>

     <a href="Index.php"> <button type="button" class="btn btn-outline-secondary">Return</button></a>
    </form>
  </div>
</div>
</body>
</html>


<!-- Login Script-->
<?php
//connection to the database
include  '../Database/connect.h';

if (isset($_POST['login'])) {

  //first we see if the user inserted the two field needed to login
  if (isset($_POST['userName']) && isset($_POST['password'])) {

    session_start();
    //lets check if the data corresponds to an user in the database
    $username = $_POST['userName'];
    $password = $_POST['password'];
    $password = md5($password);

    $getUser = "SELECT * FROM User WHERE username='" . $username . "' AND password='" . $password . "'";
    $query = mysqli_query($conn, $getUser);

    //if the data is valid, we need to grab and array of user information
    if (mysqli_num_rows($query) == 1) {
      $row = mysqli_fetch_array($query);
      if ($row == FAlSE) {
        die();
      }

      //now we need to create the SESSION variables to the valid Users of our Sytem
      $_SESSION['Login'] = True;
      $_SESSION['username'] = $username;
      //and the SESSION variable for the userType
      switch ($row['userType']) {
        case "Admin":
          $_SESSION['userType'] = "Admin";
          header("Location:ProfilePage.php");
          break;
        case "Table_manager":
          $_SESSION['userType'] = "Table_manager";
          header("Location:ProfilePage.php");
          break;
        case "Client":
          $_SESSION['userType'] = "Client";
          header("Location:ProfilePage.php");
          break;
        case "Unauthorized_User":
          echo '<script>alert("Login failed!! Wait for Admin to validate your account.")</script>';
          echo '<script>window.location.href="Index.php"</script>';
          break;
        default:
          echo '<script>alert("Invalid type of User!!")</script>';
          echo '<script>window.location.href="LoginPage.php"</script>';
          break;
      }
    } else {
      echo '<script>alert("Login failed!! Username or password is incorrect!")</script>';
      echo '<script>window.location.href="LoginPage.php"</script>';
    }
  } else {
    echo '<script>alert("Empty fields, please try again!")</script>';
    echo '<script>window.location.href="LoginPage.php"</script>';
  }
}
?>