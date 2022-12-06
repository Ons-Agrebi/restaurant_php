<?php

    $server = "localhost";
    $user = "root" ;
    $pass ="" ;
    $database ="restaurantdb" ;

    $conn = mysqli_connect($server,$user,$pass,$database);

    if(!$conn){
        echo "<script>alert('connection failed')</script>";
    }

    
?>

