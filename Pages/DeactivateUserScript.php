<?php
//connection to the database
include  '../Database/connect.h';
session_start();

$username = $_GET['username'];

$sql = "UPDATE User SET userType='Unauthorized_User' WHERE username='".$username."'";
$retval = mysqli_query( $conn, $sql );

		if(! $retval ){
			die(mysqli_error($conn)); // if does not work it gives an error
		}

        echo '<script>window.location.href="ManageUsers.php"</script>';

?>