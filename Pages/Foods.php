<?php
  //connection to the database
  include  '../Database/connect.h';
  
?>

<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/2a41b7c649.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="index.css">
  <style>
           
        a{
            text-decoration: none;
            color : white;
            font-size: 25px;
            transition: 0.5s all ease;
            margin-right: 20px;
        }
        

     
        .container{
            text-align:center;
            margin: 10e;
        }
        .title{
            text-align :center;
            margin-top:10px;
            color : white;
            font-size :5em;


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

        .list{
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

    td,th{
      color :white;
    }
    .val{
      margin :; 
      margin-left:5em;
      width:30em;
    }

    table{
     
    }
  </style>
</head>

<body>
<!--Beginning of Navigation Bar-->
<div class="main">
    <div class="wrapper">
        <div class="header">
            <nav>
                <div class="logo">
                    <a href="home.php">OA_Foods</a>
                </div>
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="Foods.php">FOODS</a></li>
                    <li><a href="LoginPage.php">LOGIN</a></li>
                    <li><a href="RegisterPage.php">REGISTER</a></li>
                </ul>
            </nav>
            <p class="title">Welcome to our menu </p>
            
        </div>
    </div>
</div>
  <!--End of Navigation Bar-->

  <!--Beginning of foods list-->
  <div class="list">
  
  <h4>Dishes</h4>

  
  
  <!-- Start Dishes -->
 
  <?php
  // echo "<table class='table  '  style='text-align:center;'>";
  
  //request to the database all the Dishes products
  $sql = 'SELECT * FROM Product WHERE productType="Dish"';
  $retval = mysqli_query($conn, $sql);
  if (!$retval) {
    die(mysqli_error($conn)); // if does not work it gives an error
  }
  //draw the table with the content
  
  echo "<table class='table  '  style='text-align:center;'>";
  while ($row = mysqli_fetch_array($retval)) {
    echo "<tr>
    <td>" . $row['name'] . "</td>";
    //echo "<td>" . $row['description'] . "</td>";
    //echo "<td>" . '<img class="filme" id="capa" src="' . $row['img'] . '">' . "</td>";
    echo "<td>" . $row['price'] . "TND </td>";
    echo "</tr>";
  }
  echo "</table><br/>";
  ?>
  <!-- End Dishes -->

  <!-- Start Drinks -->
  <h4>Drinks</h4>


  <?php
  

  //request to the database all the Drinks products
  $sql = 'SELECT* FROM Product WHERE productType="Drink"';
  $retval = mysqli_query($conn, $sql);
  if (!$retval) {
    die(mysqli_error($conn)); // if does not work it gives an error
  }
  //draw the table with the content
  echo "<table class='table ' style='text-align:center;'>";
  while ($row = mysqli_fetch_array($retval)) {
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    //echo "<td>" . $row['description'] . "</td>";
    //echo "<td>" . '<img class="filme" id="capa" src="' . $row['img'] . '">' . "</td>";
    echo "<td>" . $row['price'] . " TND</td>";
    echo "</tr>";
  }
  echo "</table><br/>";
  ?>
  <!-- End Drinks -->

  <!-- Start Desserts -->
  <h4>Desserts</h4>

  <?php

  //request to the database all the Desserts products
  $sql = 'SELECT* FROM Product WHERE productType="Dessert"';
  $retval = mysqli_query($conn, $sql);
  if (!$retval) {
    die(mysqli_error($conn)); // if does not work it gives an error
  }
  //draw the table with the content
  echo "<table class='table   ' style='text-align:center;'>";
  while ($row = mysqli_fetch_array($retval)) {
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    //echo "<td>" . $row['description'] . "</td>";
    //echo "<td>" . '<img class="food" id="img" src="' . $row['img'] . '">' . "</td>";
    echo "<td>" . $row['price'] . "TND</td>";
    echo "</tr>";
  }
  echo "</table><br/>";
  ?>
  <!-- End Deserts -->

  <!--End of foods list-->
  </div>

</body>
</html>