<?php
//connection to the database
include  '../Database/connect.h';
include "welcomeheader.php" ;
//session_start();
//only the Admin User can access this page
if($_SESSION['Login'] && $_SESSION['userType'] === "Admin"){
    
    $productId = $_GET['productId'];

    //selecting the product the Admin wants to Edit
    $sql = "SELECT * FROM Product WHERE productId='" . $productId . "'";

    $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die(mysqli_error($conn)); // if does not work it gives an error
        }

    //Acquiring Product information from database to array (needed to html from)
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
      width:15em;
      margin:15px
    }

  </style>
  </head>
<body>

<div>
</div>

<!---  Edit Food form--->
<form class="form" method="POST">
<h3>Form to Edit Food</h3><br>

  <div class="val">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name'] ?>">
  </div>

  <!--<div class="val">
    <label for="img" class="form-label">Image</label>
    <input type="text" class="form-control" id="img" name="img" value="<?php echo $row['img'] ?>"> 
  </div>-->
  <div class="val">
      <label for="productType" class="form-label">Select the type of the Product</label>
      <select class="form-select" name="productType" type="text" required value="<?php echo $row['productType'] ?>">
        <option value="Dish">Dish</option>
        <option value="Drink">Drink</option>
        <option value="Dessert">Dessert</option>
      </select>
    </div>
  <div class="val">
    <label for="price" class="form-label">Price</label>
    <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['price'] ?>">
  </div>
  <button type="submit" name="save" class="btn btn-secondary">Save</button>
  <button type="submit" name="return" class="btn btn-secondary">Return</button>

  </form>
</body>
</html>
<?php
//When the Admin press "save" we will try to update the Food information on the database
if (isset($_POST['save'])) {
    
    // creating the query to update the information on the databse
    $query = "UPDATE Product SET name='" . $_POST['name'] . "',
   productType='" . $_POST['productType'] . "',price='" . $_POST['price'] . "'
    WHERE productId='" . $productId . "'";
    
    //executing the query
    $retval = mysqli_query($conn, $query);

    if (!$retval) {
        die(mysqli_error($conn)); // if does not work it gives an error
    } else {
        //if everything went right, the database was updated
        echo '<script>alert("Food information updated!")</script>';
        echo '<script>window.location.href="ManageFoods.php"</script>';
  }
}
?>
<?php
//If the SESSION User is not an Admin, it cannot access this page
    }else{
        echo '<script>alert("You dont have permission to access this Page!")</script>';
        echo '<script>window.location.href="Index.php"</script>';
    }

    if(isset($_POST['return'])){
      header("Location:ManageReservations.php");
    
    }
?>