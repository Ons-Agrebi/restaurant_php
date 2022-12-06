<?php
//connection to the database
include  '../Database/connect.h';
include "welcomeheader.php";
//session_start();

if($_SESSION['Login'] && $_SESSION['userType'] === "Admin"){
    $username = $_SESSION['username'];
?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/2a41b7c649.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script language="JavaScript" type="text/javascript">function checkDelete(){return confirm('Are you sure you want to Delete?');}</script>
    <style>
        .class{
    position: absolute;
    top:55%;
    left:50%;
    transform :translate(-50%, -50%);
    color : white;
    text-align: center ; 

    
}
th,td{
    color : white;
    font-size:20px;
}

caption{
        caption-side: top;
        text-align : center;
        color :white;
        font-size:30px;
       }
button{
    width : 8em;
}
    </style>
</head>
<body>
<!-- Start of Users -->

<div class="content">
<?php
    //request to the database all Users
	$sql = 'SELECT * FROM User';
	$retval = mysqli_query( $conn, $sql );
		if(! $retval ){
			die(mysqli_error($conn)); // if does not work it gives an error
		}
    //draw the table with the content
    echo "<table class='table' style='text-align:center;'>";
    echo "    <caption>Table of Users </caption>
    ";
    echo "<tr><td>Username</td><td>E-mail</td><td>Phone Number</td><td>Adress</td><td>User Type</td><td>Activated | Deactivated</td><td>Edit</td><td>Delete</td></tr>";
		while($row = mysqli_fetch_array($retval)){	
			echo "<tr>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['email']."</td>";
			echo "<td>".$row['phoneNumber']."</td>";
            echo "<td>".$row['adress']."</td>";
            echo "<td>".$row['userType']."</td>";
            // If the User is user is to be activated, it will show the activation button, else will show deactivate button
            if ($row['userType'] === "Unauthorized_User"){
                echo "<td><a href='ValidateUserScript.php?username=".$row['username']."'><button type='button' class='btn btn-danger px-3'><i class='fas fa-xmark' aria-hidden='true'></i></button></a></td>";
            }else{
                echo "<td><a href='DeactivateUserScript.php?username=".$row['username']."'><button type='button' class='btn btn-success px-3'><i class='fas fa-check' aria-hidden='true'></i></button></a></td>";
            }
            echo "<td><a  href='EditUser.php?username=".$row['username']."' disabled ><button type='button' class='btn btn-info px-3'><i class='fas fa-user-pen' aria-hidden='true'></i></button></a></td>";
            echo "<td><a href='DeleteUser.php?username=".$row['username']."' onclick='return checkDelete()'><button type='button' class='btn btn-danger px-3'><i class='fa-solid fa-trash-can' aria-hidden='true'></i></button></a></td>";
			echo "</tr>";
		}
		echo "</table><br/>";
?>
<div id="btn-return" style="padding-top: 10px">
  <a href="ProfilePage.php">
    <button type="button" class="btn btn-secondary btn-md">Return</button>
  </a>
</div>
<!-- End of Users -->
</div>
</body>

<?php
//if the SESSION User is not an Admin it should not have access to the page a its redirected to the index page
}else{
    echo '<script>alert("You dont have permission to access this Page!")</script>';
    echo '<script>window.location.href="Index.php"</script>';
}
?>