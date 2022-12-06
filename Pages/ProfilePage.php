<?php
 include '../Database/connect.h';
  include "welcomeheader.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OA_Restaurant</title>
    <link rel="stylesheet" href="">
    <style>
       button{
           width:20em;
           margin:15px;
           padding:15px
       } 
       
    .class{
  position: absolute;
    top:55%;
    left:50%;
    transform :translate(-50%, -50%);
    color : white;
    text-align: center ; 
    
}

.class button{
  background-color : cadetblue ;
  font-size : 0.9em;
}

    </style>
</head>
<body>


<?php 
    if($userType==="Admin"){
    // When a User is Admin, it will show the following buttons on ProfilePage
?>
<!-- Start Buttons -->
<div class="class">
<div  id="btn-manageFoods">
  <a href="ManageFoods.php">
    <button type="button" class="btn btn-secondary btn-lg">Manage Foods Page</button>
  </a>
</div>
<div id="btn-users" style="padding-top: 10px">
  <a href="ManageUsers.php">
    <button type="button" class="btn btn-secondary btn-lg">Manage Users</button>
  </a>
</div>
<div id="btn-reservations" style="padding-top: 10px">
  <a href="ManageReservations">
    <button type="button" class="btn btn-secondary btn-lg">Manage Reservations</button>
  </a>
</div>
<div id="btn-personalInfo" style="padding-top: 10px">
  <a href="EditPersonalInfo.php">
    <button type="button" class="btn btn-secondary btn-lg">Edit Personal Information</button>
  </a>
</div>
</div>
<!-- End Buttons -->

<?php
    }else if($userType==="Table_manager"){
    // When a User is Table Manager, it will show the following buttons on ProfilePage
    
?>
<!-- Start Buttons -->
<div class="class">
<div id="btn-reservations" style="padding-top: 10px">
  <a href="ManageReservations.php">
    <button type="button" class="btn btn-secondary btn-lg">Manage Table Reservations</button>
  </a>
</div>
<div id="btn-personalInfo" style="padding-top: 10px">
  <a href="EditPersonalInfo.php">
    <button type="button" class="btn btn-secondary btn-lg">Edit Personal Information</button>
  </a>
</div>
</div>
<!-- End Buttons -->

<?php
    }else if($userType==="Client"){
    // When a User is Client, it will show the following buttons on ProfilePage
?>
<!-- Start Buttons -->
<div class="class">
<div id="btn-users">
  <a href="MakeReservation.php">
    <button type="button" class="btn btn-secondary btn-lg">Make Reservation</button>
  </a>
</div>
<div id="btn-reservations" style="padding-top: 10px">
  <a href="ManageReservations.php">
    <button type="button" class="btn btn-secondary btn-lg">Manage Reservations</button>
  </a>
</div>
<div id="btn-personalInfo" style="padding-top: 10px">
  <a href="EditPersonalInfo.php">
    <button type="button" class="btn btn-secondary btn-lg">Edit Personal Information</button>
  </a>
</div>
</div>
<!-- End Buttons -->

<?php } ?>








