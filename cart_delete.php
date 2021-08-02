<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

$deleteid = $_GET['cartid'];
$queryDelete = "DELETE FROM cart WHERE cart_id = '$deleteid'";
$resultDelete = mysqli_query($con, $queryDelete);


mysqli_close($con);


header('location: cart.php');

?>