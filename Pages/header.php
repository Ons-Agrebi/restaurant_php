<?php
    if(isset($_POST['home'])){
        header('Location:home.php');
    }
    if(isset($_POST['foods'])){
        header('Location:food.php');
    }
    if(isset($_POST['login'])){
        header('Location:login.php');
    }
    if(isset($_POST['register'])){
        header('Location:register.php');
    }
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IO_Restaurant</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<form action="" method="post">
    <div class="main">
        <div class="wrapper">
            <div class="header">
                <nav>
                    <div class="logo">
                        <a href="home.php">IO_Foods</a>
                    </div>
                    <ul>
                        <li><a class="home" href="home.php">HOME</a></li>
                        <li><a class="foods" href="food.php">FOODS</a></li>
                        <li><a class="login" href="login.php">LOGIN</a></li>
                        <li><a class="register" href="register.php">REGISTER</a></li>
                    </ul>
                </nav>
 
            </div>
        </div>
    </div>
</form>  
</body>
</html>