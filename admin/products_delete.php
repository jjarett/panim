<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

$deleteid = $_GET['id'];

$queryDelete = "DELETE FROM products WHERE product_id = '$deleteid'";
$resultDelete = mysqli_query($con, $queryDelete);


mysqli_close($con);


header('location: products.php');

?>

