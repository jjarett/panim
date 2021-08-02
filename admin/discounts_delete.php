<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

$deleteid = $_GET['id'];

$queryDelete = "DELETE FROM discount_codes WHERE discount_id = '$deleteid'";
$resultDelete = mysqli_query($con, $queryDelete);


mysqli_close($con);


header('location: discountcodes.php');

?>

