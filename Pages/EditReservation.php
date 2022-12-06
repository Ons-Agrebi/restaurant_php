<?php
//connection to the database
include  '../Database/connect.h';
include "welcomeheader.php" ;
//session_start();

$idRes = $_GET['idReservation'];

$sql = "SELECT * FROM Reservation WHERE idReservation='$idRes'";

$retval = mysqli_query($conn, $sql);
if (!$retval) {
  die(mysqli_error($conn)); // if does not work it gives an error
}

//Acquiring Reservation data from database to array (needed to html from)
$row = mysqli_fetch_array($retval);

?>

<html>

<head>
  <!-- Bootstarp Things -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/2a41b7c649.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="content.css">
  <style>
    .form{
    position: absolute;
    top:50%;
    left:45%;
    transform :translate(-50%, -50%);
    color : white;
    text-align: center ; 
    background-color : rgba(0,0,0,0.5); 
    width :40em;
    margin-left:5em;

    }
    .val{
      margin :1em; 
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
  <form class="form" method="POST">
  <h3>Edit Reservation</h3><br>

    <div class="val">
      <label for="date" class="form-label">Select Date</label>
      <input type="date" class="form-control" id="date" name="date" value='<?php echo $row['reservationDate']; ?>'>
    </div>
    <div class="val">
      <label for="hour" class="form-label">Select Hour</label>
      <select class="form-select" name="hour" type="text">
        <option value='<?php echo $row['reservationHour']; ?>'>Select an Hour:</option>
        <option value="11:30">11:30</option>
        <option value="12:30">12:30</option>
        <option value="13:30">13:30</option>
        <option value="14:30">14:30</option>
      </select>
    </div>
    <div class="val">
      <label for="seats" class="form-label">Select Table Seats</label>
      <select class="form-select" name="seats" type="number">
        <option value="<?php echo $row['seatsQty']; ?>">Select table seats:</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="6">6</option>
      </select>
    </div>
    <button type="submit" name="save" class="btn btn-secondary">Save</button>
    <button type="submit" name="return" class="btn btn-secondary">Return</button>

 </form>
</body>

</html>

<!-- Reservation Script -->
<?php
//When User press "save" we will try to update the data from Reservation on the database
if (isset($_POST['save'])) {

  //some variables needed to the next code block
  $date = $_POST['date'];
  $hour = $_POST['hour'];
  $seats = $_POST['seats'];

  // lets verify if there are seats available

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
    //long line of query, basicly it will try to update all the information of the Reservation on the database
    $query = "UPDATE Reservation SET reservationDate='$date', reservationHour='$hour',
                    seatsQty='$seats' WHERE idReservation='$idRes'";

    $retval = mysqli_query($conn, $query);

    echo '<script>alert("Reservation updated.")</script>';
    echo '<script>window.location.href="ProfilePage.php"</script>';
  } else {
    //the user will recieve a error messege
    echo '<script>alert(" Maximum seats reached for that specific hour. Please try another hour or day!")</script>';
    echo '<script>window.location.href="EditReservation.php"</script>';
  }
}
if(isset($_POST['return'])){
  header("Location:ManageReservations.php");

}

?>