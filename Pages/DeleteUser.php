<?php
//connection to the database
include  '../Database/connect.h';
session_start();

$username = $_GET['username'];

//first we need to delete the reservations from the user that we are going to delete
$delRes = "DELETE FROM Reservation WHERE clientName='$username'";
$res = mysqli_query( $conn, $delRes );

//Next we are going to delete the user
$sql = "DELETE FROM User WHERE username='".$username."'";
$retval = mysqli_query( $conn, $sql );

	if(! $retval ){
		die(mysqli_error($conn)); // if does not work it gives an error
	}

    echo '<script>alert("User Deleted!")</script>';
    echo '<script>window.location.href="ManageUsers.php"</script>';

?>