<?php
    //connection to the database
    include  '../Database/connect.h';

    session_start();

    if($_SESSION['Login']){
        session_destroy();
        //echo '<script>alert("Logout done! Thanks for your visit!")</script>';
        echo '<script>window.location.href="Index.php"</script>';

    }else{
        echo '<script>alert("There are no users session started!")</script>';
        echo '<script>window.location.href="Index.php"</script>';
    }
