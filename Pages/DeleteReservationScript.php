<?php
//connection to the database
include  '../Database/connect.h';
session_start();

$reservationId = $_GET['idReservation'];

$sql = "DELETE FROM Reservation WHERE idReservation='".$reservationId."'";
$retval = mysqli_query( $conn, $sql );

		if(! $retval ){
			die(mysqli_error($conn)); // if does not work it gives an error
		}

        echo '<script>alert("Reservation Deleted!")</script>';
        echo '<script>window.location.href="ManageReservations.php"</script>';

?>