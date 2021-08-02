<?php
session_start();

$con = mysqli_connect("localhost", "admin", null, "pganim");
$exist = false;

$custid = $_SESSION['cust_id'];
$cart_id = $_GET['cartid'];
$cquantity = $_GET['quant'];

$updateCartQuery = "UPDATE cart SET quantity = $cquantity WHERE cart_id = $cart_id";
$updateCartResult = mysqli_query($con, $updateCartQuery);
header('location: cart.php');


mysqli_close($con);
?>