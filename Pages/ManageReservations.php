<?php
//connection to the database
include  '../Database/connect.h';
include "welcomeheader.php" ;
//session_start();

$userType = $_SESSION['userType'];
?>

<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/2a41b7c649.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script language="JavaScript" type="text/javascript">
    function checkDelete() {
      return confirm('Are you sure you want to Delete?');
    }
  </script>
  
  <style>
    .form{
    position: absolute;
    top:25em;
    left:45em;
    transform :translate(-50%, -50%);
    color : white;
    text-align: center ; 
    background-color : rgba(0,0,0,0.5); 
    width:80em;
    margin-left:5em;

    }
    caption{
        caption-side: top;
        text-align : center;
        color :white;
        font-size:35px;
       }
       td,th{
         color : white;
         font-size :20px
       }

       button{
         width :10em;
       }

       .bt{
        position: absolute;
        top:26em;
        left:40em;
       
       }
       .bt1{
        position: absolute;
        top: 26em;
        left:25em;
        
       }
  </style>
</head>

<body>

  <!-- Start of Reservations -->
<div class="">



  <?php
  // if logged user is admin or table_manger they have option to crerate Reservation in this page
  if ($_SESSION['userType'] === "Admin" || $_SESSION['userType'] === "Table_manager") {
   

    //request to the database all Users
    $sql = 'SELECT * FROM Reservation';
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
      die(mysqli_error($conn)); // if does not work it gives an error
    }
    //draw the table with the content
    echo "<form class='form'>
    <table class='table' style='text-align:center;'>";
    echo "    <caption >Reservations List</caption>" ;
    echo "<tr><td>Id Reservation</td><td>Client Username</td><td>Reservation Date</td><td>Reservation Hour</td><td>Seats Qty</td><td>Attended</td><td>Edit</td><td>Delete</td></tr>";
    while ($row = mysqli_fetch_array($retval)) {
      echo "<tr>";
      echo "<td>" . $row['idReservation'] . "</td>";
      echo "<td>" . $row['clientName'] . "</td>";
      echo "<td>" . $row['reservationDate'] . "</td>";
      echo "<td>" . $row['reservationHour'] . "</td>";
      echo "<td>" . $row['seatsQty'] . "</td>";

      //Buttons to Attend a reservation, if its not attended with will show a red button with tumb-down icon,
      // if the reservation is attended, the button becom green and the icon is tumb-up
      // aditional there is an option to set the reservation has not attended by clicking on the green button
      if ($row['is_Attended'] == 0) {
        echo "<td class='btt'>
                <a href='AttendReservation.php?idReservation=" . $row['idReservation'] . "'>
                  <button type='button' class='btn btn-danger px-3'>
                  <i class='fa-solid fa-thumbs-down'></i></button>
                </a>
              </td>";
      } else {
        echo "<td>
                <a href='NotAttendedReservation.php?idReservation=" . $row['idReservation'] . "'>
                  <button type='button' class='btn btn-success px-3'>
                  <i class='fa-solid fa-thumbs-up'></i></button>
                  </a>
              </td>";
      }

      //Edit and delete buttons from the table with the respective redirect pages
      echo "<td>
              <a href='EditREservation.php?idReservation=" . $row['idReservation'] . "'>
                <button type='button' class='btn btn-primary px-3'>
                <i class='fa-solid fa-pen-to-square' aria-hidden='true'></i></button>
              </a>
            </td>";
      echo "<td>
              <a href='DeleteReservationScript.php?idReservation=" . $row['idReservation'] . "' onclick='return checkDelete()'>
                <button type='button' class='btn btn-danger px-3'  confirm('do you want to delete Y/N')>
                <i class='fa-solid fa-trash-can' aria-hidden='true'></i></button>
              </a>
          </td></tr>";
          
    }
    echo "</table>
    <div class='bt'>
    <a href='ProfilePage.php'>
    <button  type='button' class='btn btn-secondary '>Return</button>
  </a></div
  </form>"
    ;
    echo '<div class="bt1" id="btn-return" >
    <a href="MakeReservation.php">
      <button  type="button" class="btn btn-secondary ">Create Reservation</button>
    </a>
  </div>';
  } else if ($_SESSION['userType'] === "Client") {

    $name = $_SESSION['username'];

    //request to the database all Users
    $sql = "SELECT * FROM Reservation WHERE clientName='$name'";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
      die(mysqli_error($conn)); // if does not work it gives an error
    }
    //draw the table with the content
    echo "<form class='form'>
    <table class='table' style='text-align:center;'>";
    echo "<tr><td>Id Reservation</td><td>Username</td><td>Reservation Date</td><td>Reservation Hour</td><td>Seats Qty</td><td>Edit</td><td>Delete</td></tr>";
    while ($row = mysqli_fetch_array($retval)) {
      echo "<tr>";
      echo "<td>" . $row['idReservation'] . "</td>";
      echo "<td>" . $row['clientName'] . "</td>";
      echo "<td>" . $row['reservationDate'] . "</td>";
      echo "<td>" . $row['reservationHour'] . "</td>";
      echo "<td>" . $row['seatsQty'] . "</td>";


      //Edit and delete buttons from the table with the respective redirect pages
      echo "<td>
              <a href='EditREservation.php?idReservation=" . $row['idReservation'] . "'>
                <button type='button' class='btn btn-primary px-3'>
                <i class='fa-solid fa-pen-to-square' aria-hidden='true'></i></button>
              </a>
            </td>";
      echo "<td>
              <a href='DeleteReservationScript.php?idReservation=" . $row['idReservation'] . "' onclick='return checkDelete()'>
                <button type='button' class='btn btn-danger px-3'  confirm('do you want to delete Y/N')>
                <i class='fa-solid fa-trash-can' aria-hidden='true'></i></button>
              </a>
          </td></tr>";
    }
    echo "</table><br/>
    <a href='ProfilePage.php'>
    <button  type='button' class='btn btn-secondary '>Return</button>
  </a>";
    echo "<form>" ;
  }

  ?>

  <!-- End of Reservations -->
  </div>
</body>

</html>