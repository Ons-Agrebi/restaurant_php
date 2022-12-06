<?php
//connection to the database
include  '../Database/connect.h';
include "welcomeheader.php";
//session_start();

if(isset($_POST['addfood'])){
    header("Location:AddFood.php");
}
if(isset($_post['return'])){
    header($_POST['ProfilePage.php']);
}
//only the Admin User can access this page
if($_SESSION['Login'] && $_SESSION['userType'] === "Admin"){
    $username = $_SESSION['username'];
?>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/2a41b7c649.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script language="JavaScript" type="text/javascript">
        function checkDelete() {
            return confirm('Are you sure you want to Delete?');
        }
    </script>
    <link rel="stylesheet" href="content.css">
    <style>
       .table{
           margin-top:5em;
       }
       caption{
        caption-side: top;
        text-align : center;
        color :white;
        font-size:30px;
       }
    </style>
</head>

<body>

    <!-- Start of Foods Manage -->
<div class="class"> 
    <!--Add new food button-->


    <?php
    //request to the database all Users
    $sql = 'SELECT * FROM Product';
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
        die(mysqli_error($conn)); // if does not work it gives an error
    }
    //draw the table with the Product content
    echo "  
    <form method='post'>
   
    
    <table class='table'>
    <caption >Table off Foods</caption>

    
    ";
   echo "<tr>
    <th>Name</th>";
    //echo "<th>Img</th>"
    echo "<th>Product Type</th>
    <th>Price</th>
    <th>Edit</th>
    <th>Delete</th></tr>";
    while ($row = mysqli_fetch_array($retval)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        //echo "<td>" . $row['description'] . "</td>";
        //echo "<td>" . $row['img'] . "</td>";
        echo "<td>" . $row['productType'] . "</td>";
        echo "<td>" . $row['price'] . " TND</td>";

        //Edit and delete buttons from the table with the respective redirect pages
        echo "<td>
              <a href='EditFood.php?productId=".$row['productId']."'>
                <button type='button' class='btn btn-primary px-3'>
                <i class='fa-solid fa-pen-to-square' aria-hidden='true'></i></button>
              </a>
            </td>";
        echo "<td>
              <a href='DeleteFood.php?productId=".$row['productId']."' onclick='return checkDelete()'>
                <button type='button' class='btn btn-danger px-3'  confirm('do you want to delete Y/N')>
                <i class='fa-solid fa-trash-can' aria-hidden='true'></i></button>
              </a>
          </td></tr>";
    }
    echo "</table><br/>
        </form>
    ";

    ?>

    <div class="buttons">
    <button type="submit" name="addfood" class="btn btn-secondary">Add New Food</button>
    <a href="ProfilePage.php">
            <button type="button" class="btn btn-secondary btn-md">Return</button>
        </a>
    </div>
   
   
    <!-- End of Foods -->
</div>
</body>
</html>
<?php
    }else{
        echo '<script>alert("You dont have permission to access this Page!")</script>';
        echo '<script>window.location.href="Index.php"</script>';
    }
?>