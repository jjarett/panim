<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

$deleteid = $_GET['id'];

$queryDelete = "DELETE FROM feedback WHERE feedback_id = '$deleteid'";
$resultDelete = mysqli_query($con, $queryDelete);


mysqli_close($con);


header('location: feedbacks.php');

?>

