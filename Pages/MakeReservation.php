<?php
//connection to the database
include  '../Database/connect.h';
include "welcomeheader.php" ;
//session_start();
?>
<html>

<head>
  <!-- Bootstarp Things -->
  <title>Teste</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/2a41b7c649.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="">
  <style>
    .buttons{
      margin :15px;
    }

      .form{
    position: absolute;
    top:55%;
    left:42%;
    transform :translate(-50%, -50%);
    color : white;
    text-align: center ; 
    background-color : rgba(0,0,0,0.5); 
    width :40em;
    margin-left:5em;

    }

    button{
         width :10em;
       }
       .val{
      margin :; 
      margin-left:5em;
      width:30em;
    }
    input,select{
      text-align : center;
    }
  </style>
</head>

<body>

  

  <!---  Reservation form--->
  <div class=" form" >

  <form class="form" method="POST" >
  <h3>Make Reservation</h3><br>

 
    <div class="val">
      <label for="date" class="form-label">Select Date</label>
      <input type="date" class="form-control" id="date" name="date">
    </div>
    <div class="val">
      <label for="hour" class="form-label">Select Hour</label>
      <select class="form-select" name="hour" required>
        <option value="11:30">11:30</option>
        <option value="12:30">12:30</option>
        <option value="13:30">13:30</option>
        <option value="14:30">14:30</option>
      </select>
    </div>
    <div class="val">
      <label for="seats" class="form-label">Select Table Seats</label>
      <select class="form-select" name="seats" type="number" required>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="6">6</option>
      </select>
    </div>
    <div class="buttons">
    <button type="submit" name="makeReservation" class="btn btn-secondary">Make Reservation</button>
    <button type="return" name="return" class="btn btn-secondary">Return</button>
    </div>
  </form>
    </div>
</body>

</html>

<!-- Reservation Script -->
<?php
if(isset($_POST['return'])){
  header("Location:ProfilePage.php");
}

//checks if the make reservation button is pressed, if it is, we will start the validations of the fields
if (isset($_POST['makeReservation'])) {

  //lets check if there are empty fields
  if (empty($_POST['date']) || empty($_POST['hour']) || empty($_POST['seats'])) {

    echo '<script>alert("You have empty fields. Please make sure you fill everything before submit.")</script>';
    echo '<script>window.location.href="MakeReservation.php"</script>';
  } else {
    // if user inserted all the fields, we need to check if there are empty seats to the date and hour that user has chose
    //start by creating some variables
    $date = $_POST['date'];
    $hour = $_POST['hour'];
    $seats = $_POST['seats'];
    $countSeats = 0; // variable needed to count the Seats Ocupied

    $verifyQuery = "SELECT * FROM Reservation WHERE reservationDate='$date'";
    $res = mysqli_query($conn, $verifyQuery);

    //cycle that will verify each reservation hour for the specific day and count the ocupied seats
    while ($row = mysqli_fetch_array($res)) {
      if ($row['reservationHour'] == $hour) {
        $countSeats += $row['seatsQty']; //incrementing the number of seats ocupied
      }
    }

    // now lets verify if the total of seats plus the seats that user want to Reservation, exceeds the limit of the restaurant
    if (($countSeats + $seats) <= 50) {
      //eerything went well, so now we just need to insert the new reservation on the database
      $sql = "INSERT INTO `Reservation`(`clientName`, `reservationDate`, `reservationHour`, `seatsQty`) 
                      VALUES ('" . $_SESSION['username'] . "','" . $date . "','" . $hour . "','" . $seats . "')";

      $result = mysqli_query($conn, $sql);

      echo '<script>alert("Reservation created.")</script>';
      echo '<script>window.location.href="ProfilePage.php"</script>';
    } else {
      //the user will recieve a error messege
      echo '<script>alert(" Maximum seats reached for that specific hour. Please try another hour or day!")</script>';
      echo '<script>window.location.href="MakeReservation.php"</script>';
    }
  }
}
?>