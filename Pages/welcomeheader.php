<?php

    //we start by checking if the logged user have acess to this page
    session_start();
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OA_Restaurant</title>
    <link rel="stylesheet" href="index.css">
    <style>
       button{
           width:20em;
           margin:15px;
           padding:15px
       } 

       h2{  
           
           padding-bottom:10em;
           text-align:center;
           color:white;
           font-size:3em;
       }
       .a{
    text-decoration: none;
    color : white;
    font-size: 25px;
    transition: 0.5s all ease;
    margin-right: 20px;
}

.logo{
    font-size: 30px;
    color:cadetblue;
    font-weight: bold;
    margin-left: 100px;
    

}
    </style>
</head>
<body>
<form action="" method="post">
    <div class="main">
        <div class="wrapper">
            <div class="header">
                <nav>
                    <div class="logo">
                        <a class="a" href="index.php" >OA_Foods</a>
                    </div>
                    <ul>

                        <li><a class="a" href="Logout.php">LOG OUT</a></li>
                    </ul>
                </nav>
                <div class="">
                <h2>Welcome  <?php echo "$username" ;?> to your personal profile </h2>
                </div>
    </div>
</form>  
</body>
</html>