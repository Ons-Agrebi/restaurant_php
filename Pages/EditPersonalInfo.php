<?php
//connection to the database
include  '../Database/connect.h';
include "welcomeheader.php" ;
//session_start();
if(isset($_POST['return'])){
  header("Location:ProfilePage.php");

}

$user = $_SESSION['username'];

$sql = "SELECT * FROM User WHERE username='" . $user . "'";

$retval = mysqli_query($conn, $sql);
if (!$retval) {
  die(mysqli_error($conn)); // if does not work it gives an error
}

//Acquiring User data from database to array (needed to html from)
$row = mysqli_fetch_array($retval);
?>

<html>

<head>
  <!-- Bootstarp Things -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/2a41b7c649.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <style>
    .form{
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
    .val{
      margin :; 
      margin-left:5em;
      width:30em;
    }
    input,select{
      text-align : center;
    }
    button{
      width :15em;
      margin:10px;
    }

  </style>
</head>

<body>

  <div>
  
  </div>

  <!---  Edit User form--->
  <form class="form" method="POST">
  <h3>Edit Personal Informations</h3>
    <div class="val">
      <input type="hidden" name="oldName" value="<?php echo $row['username']; ?>"> <!-- This line helps saving the old username for the php change-->
      <label for="newUserName" class="form-label">User Name</label>
      <input type="text" class="form-control" id="newUserName" name="newUserName" value="<?php echo $row['username']; ?>">
    </div>
    <div class="val">
      <label for="email" class="form-label">E-mail</label>
      <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
    </div>
    <div class="val">
      <label for="phoneNumber" class="form-label">Phone Number</label>
      <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $row['phoneNumber']; ?>">
    </div>
    <div class="val">
      <label for="adress" class="form-label">Adress</label>
      <input type="text" class="form-control" id="adress" name="adress" value="<?php echo $row['adress']; ?>">
    </div>
    <div class="val">
      <label for="newPassword" class="form-label">New Password</label>
      <input type="password" class="form-control" id="newPassword" name="newPassword">
    </div>
    <div class="val">
      <label for="confPassword" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="confPassword" name="confPassword">
    </div>
    <button type="submit" name="save" class="btn btn-secondary">Save</button>
    <button type="submit" name="return" class="btn btn-secondary">Return</button>
   
  </form>
</body>

</html>

<?php
//When User press "save" we will try to update the data on the database
if (isset($_POST['save'])) {
  //First we need to check if the user has set a new password
  if (!empty($_POST['newPassword'])) {
    //If it does, we need to verify the new password and the confirmation password
    if ($_POST['newPassword'] === $_POST['confPassword']) {
      //then we add password protection (MD5)
      $password = md5($_POST['newPassword']);
      //After that we create the query that changes all field of user, we dont know exacly what fields
      //where changed, but this step protects the change of password and gives it md5 protection
      $query = "UPDATE User SET username='" . $_POST['newUserName'] . "', email='" . $_POST['email'] . "',
          phoneNumber='" . $_POST['phoneNumber'] . "',adress='" . $_POST['adress'] . "',password='" . $password . "' 
          WHERE username='" . $_POST['oldName'] . "'";
    } else {
      //In case of the passwords do not match, we give an error messenge and redirect back to the edit page
      echo '<script>alert("Passwords are not equal!")</script>';
      echo '<script>window.location.href="EditPersonalInfo.php"</script>';
    }
  } else {
    //In case of the user dont change the password, we still can update the rest of the information
    //so we create a query containing all of the field, except the password
    $query = "UPDATE User SET username='" . $_POST['newUserName'] . "', email='" . $_POST['email'] . "',
    phoneNumber='" . $_POST['phoneNumber'] . "',adress='" . $_POST['adress'] . "' 
    WHERE username='" . $_POST['oldName'] . "'";
  }
  //For last, we execute the query to update the user information
  $retval = mysqli_query($conn, $query);

  if (!$retval) {
    die(mysqli_error($conn)); // if does not work it gives an error
  } else {
    //if everything went right, the database was updated
    echo '<script>alert("Personal information updated!")</script>';
    echo '<script>window.location.href="ProfilePage.php"</script>';
  }
}

?>