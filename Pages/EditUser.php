<?php
//connection to the database
include  '../Database/connect.h';
include "welcomeheader.php";
//session_start();

//only the Admin User can access this page
if($_SESSION['Login'] && $_SESSION['userType'] === "Admin"){

$sql = "SELECT * FROM User WHERE username='" . $_GET['username'] . "'";

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
      width :10em;
      margin:10px;
    }

  </style>
</head>

<body>



  <!---  Edit User form--->
  <form class="form" method="POST">
  <h3>Edit User Information</h3><br>

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
      <label for="newUserType">User type</label>
      <select class="form-select" name="newUserType" type="number">
        <option value='<?php echo $row['userType']; ?>'> Select an option: </option> <!-- This line send the current userType in case of no changes made by admin -->
        <option value="Admin">Admin</option>
        <option value="Table_manager">Table Manager</option>
        <option value="Client">Client</option>
        <option value="Unoutorized_User">Unauthorized_User</option>
      </select>
      <button type="submit" name="save" class="btn btn-secondary">Save</button>
      
      <a href="ManageUsers.php"><button type="button" class="btn btn-secondary">Return</button></a>
    </div>
  </form>
</body>

</html>

<?php
//When Admin press "save" we will try to update the data from User on the database
if (isset($_POST['save'])) {
  //long line of query, basicly it will try to update all the information of the User on the database
  $query = "UPDATE User SET username='" . $_POST['newUserName'] . "', email='" . $_POST['email'] . "',
        phoneNumber='" . $_POST['phoneNumber'] . "',adress='" . $_POST['adress'] . "',userType='" . $_POST['newUserType'] . "' 
        WHERE username='" . $_POST['oldName'] . "'";

  $retval = mysqli_query($conn, $query);

  if (!$retval) {
    die(mysqli_error($conn)); // if does not work it gives an error
  } else {

    //if everything went right, the database was updated
    echo '<script>alert("User Updated!")</script>';
    echo '<script>window.location.href="ManageUsers.php"</script>';
  }
}
?>
<?php
//If the SESSION User is not an Admin, it cannot access this page
    }else{
        echo '<script>alert("You dont have permission to access this Page!")</script>';
        echo '<script>window.location.href="Index.php"</script>';
    }

    
?>