<?php
//connection to the database
include  '../Database/connect.h';
include "welcomeheader.php";

//session_start();
//only the Admin User can access this page
if($_SESSION['Login'] && $_SESSION['userType'] === "Admin"){
  
?>
<html>
  <head>
    <!-- Bootstarp Things -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/2a41b7c649.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
      .content{
    position: absolute;
    color : white;
    text-align: center ;
    background-color: rgba(0,0,0,0.5);
}
input {
  
  width :5em;
}

.buttons{
  margin-top:10px;
}
    h3{
      text-align:center;
        margin-bottom:0em;
    }

    .new{
      margin-left:5em;
      margin-right:5em;
    }
    select,input{
      text-align:center;
    }
    </style>
  </head>
<body>


<!---  Add food form--->
<div>

<form class="content" action="" method="POST">
<h3> Form to Add New Food</h3><br>

  <div class="new" >
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
  <div class="new" >
    <label for="description" class="form-label">Description</label>
    <input type="text" class="form-control" id="description" name="description">
  </div>
  <!--<div  class="new" >
    <label for="img" class="form-label">Image</label>
    <input type="text" class="form-control" id="img" name="img"> 
  </div>-->
  <div  class="new" >
      <label for="productType" class="form-label">Select the type of the Product</label>
      <select class="form-select" name="productType" type="text" required>
        <option value="Dish">Dish</option>
        <option value="Drink">Drink</option>
        <option value="Dessert">Dessert</option>
      </select>
    </div>
  <div class="new" >
    <label for="price" class="form-label">Price</label>
    <input type="text" class="form-control" id="price" name="price">
  </div>
  <div class="buttons">
  <button type="submit" name="save" class="btn btn-secondary">Save</button>
  <button type="submit" name="return" class="btn btn-secondary">Return</button>
  </div>
 </form>
</div>
</body>
</html>


<!-- Add Food Script -->
<?php
    //When the User press the save button
    if(isset($_POST['save'])){
   
    $name = $_POST['name'];
    $description = $_POST['description'];
    //$img = $_POST['img'];
    $productType = $_POST['productType'];
    $price = $_POST['price'];

      //We need to check if all the field have information
  if(empty($name) || empty($description)  || empty($productType) || empty($price)){
      echo '<script>alert("There are empty field! Please verify your information and try again")</script>';
      echo '<script>window.location.href="AddFood.php"</script>';

  }else{
        //if everithing is ok, we need to add the new information in the database
          $sql = "INSERT INTO `Product`(`name`, `description`, `productType`, `price`) 
                    VALUES ('$name','$description','$productType','$price')";
          $query = mysqli_query($conn, $sql);

          echo '<script>alert("The Product was add to the database")</script>';
          echo '<script>window.location.href="ManageFoods.php"</script>';
      }
  }
?>

<?php
//If the SESSION User is not an admin, it cannot access this page
    }else{
        echo '<script>alert("You dont have permission to access this Page!")</script>';
        echo '<script>window.location.href="Index.php"</script>';
    }

    if(isset($_POST['return'])){
      header("Location:ManageFoods.php");
    }
?>