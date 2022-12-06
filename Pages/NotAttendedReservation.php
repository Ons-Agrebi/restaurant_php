<?php
//connection to the database
include  '../Database/connect.h';

session_start();
$resId = $_GET['idReservation'];

$sql = "UPDATE Reservation SET is_Attended=0 WHERE idReservation='".$resId."'";
$retval = mysqli_query( $conn, $sql );

		if(! $retval ){
			die(mysqli_error($conn)); // if does not work it gives an error
		}

        echo '<script>window.location.href="ManageReservations.php"</script>';

?>