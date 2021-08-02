<?php
session_start();

$con = mysqli_connect("localhost", "admin", null, "pganim");
$exist = false;

$pid = $_GET['pid'];
$custid = $_SESSION['cust_id'];
$quantity = $_GET['quant'];
$goCart = $_GET['gocart'];

$queryProductStock = "SELECT * FROM products WHERE product_id = $pid";
$queryProductResult = mysqli_query($con, $queryProductStock);
while ($productStock = mysqli_fetch_array($queryProductResult)) {
    if ($quantity > $productStock['stock_status']) {
        $quantity = $productStock['stock_status'];
    }
}


$queryCartProducts = "SELECT * FROM cart WHERE customer_id = $custid";
$cartProductResult = mysqli_query($con, $queryCartProducts);

while ($cartProduct = mysqli_fetch_array($cartProductResult)) {
    if ($cartProduct['product_id'] == $pid) {
        $exist = true;
    }
}
if ($exist) {
    header('location: product_details.php?pid=' . $pid . '&ae=true');
} else {
    $queryCount = "select max(cart_id) from cart";
    $resultCount = mysqli_query($con, $queryCount);
    while ($row = mysqli_fetch_array($resultCount)) {
        $cartid = $row["max(cart_id)"] + 1;
    }
    $queryAdd = "INSERT INTO cart VALUES ('$cartid', '$pid', '$custid', '$quantity')";
    $resultAdd = mysqli_query($con, $queryAdd);

    if ($goCart == 'y') {
        header('location: cart.php');
    } else {
        header('location: product_details.php?pid=' . $pid . '&ae=false');
    }
}
mysqli_close($con);
