<?php
    //connection to the database
    include  '../Database/connect.h';

    session_start();

    $productId = $_GET['productId'];

    //if everithing is ok, we need to add the new information in the database
    $sql = "DELETE FROM Product WHERE productId='$productId'";
    $query = mysqli_query($conn, $sql);

    echo '<script>alert("The Product was deleted from the database")</script>';
    echo '<script>window.location.href="ManageFoods.php"</script>';

?>