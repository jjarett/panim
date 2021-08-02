<?php

session_start();

$transactionid = $_GET['pay'];
$_SESSION['txnid'] = $transactionid;
$totalpaid = $_SESSION['total'];
$orderstatus = 'Pending';


$con = mysqli_connect("localhost", "admin", null, "pganim");

$cust_id = $_SESSION['cust_id'];

date_default_timezone_set("Asia/Kuala_Lumpur");
$createdAt =  date('Y-m-d H:i:s');
$updatedAt =  date('Y-m-d H:i:s');


//get order id count
$queryCountOrders = "select max(order_id) from orders";
$resultCountOrders = mysqli_query($con, $queryCountOrders);
while ($row = mysqli_fetch_array($resultCountOrders)) {
    $oid = $row["max(order_id)"] + 1;
}

$_SESSION['oid'] = $oid;



//get all from cart whr cust id = $cust id

$queryfrCart = "SELECT * FROM cart WHERE customer_id = $cust_id";
$resultfrCart = mysqli_query($con, $queryfrCart);
while ($rowCart = mysqli_fetch_array($resultfrCart)) {
    $prodIDfrCart = $rowCart['product_id'];
    $quantityfrCart = $rowCart['quantity'];
    $queryProduct = "SELECT * FROM products WHERE product_id = $prodIDfrCart";
    $resultProduct = mysqli_query($con, $queryProduct);
    $product = mysqli_fetch_array($resultProduct);
    $newQuantity = $product['stock_status'] - $rowCart['quantity'];

    $updateStockQuery = "UPDATE products SET stock_status='$newQuantity' where product_id='$prodIDfrCart'";
    $resultupdateStockQuery = mysqli_query($con, $updateStockQuery);

    //get cust order id count
    $queryCountCustOrders = "select max(custorders_id) from cust_orders";
    $resultCountCustOrders = mysqli_query($con, $queryCountCustOrders);
    while ($row = mysqli_fetch_array($resultCountCustOrders)) {
    $custordersid = $row["max(custorders_id)"] + 1;
}
    //insert to cust orders table
    $queryAddCustOrders = "INSERT INTO cust_orders values ('$custordersid', '$oid', '$prodIDfrCart', '$quantityfrCart')";
    $resultAddCustOrders = mysqli_query($con, $queryAddCustOrders);
}

//insert payment details



$queryCountPayments = "select max(payment_id) from payments";
$resultCountPayments = mysqli_query($con, $queryCountPayments);
while ($row = mysqli_fetch_array($resultCountPayments)) {
    $paymentid = $row["max(payment_id)"] + 1;
}

$queryAddPayment = "INSERT INTO payments values ('$paymentid', '$createdAt', '$oid', '$totalpaid','$transactionid')";
$resultAddPayment = mysqli_query($con, $queryAddPayment);


//insert to orders table

$queryAddOrders = "INSERT INTO orders values ('$oid', '$cust_id', '$totalpaid', '$orderstatus','$createdAt', '$updatedAt')";
$resultAddOrders = mysqli_query($con, $queryAddOrders);

// insert to delivery table
$queryCountDelivery = "select max(delivery_id) from delivery";
$resultCountDelivery = mysqli_query($con, $queryCountDelivery);
while ($row = mysqli_fetch_array($resultCountDelivery)) {
    $deliveryid = $row["max(delivery_id)"] + 1;
}

$deliveryFee = $_SESSION['deliveryFee'];

$queryAddDelivery = "INSERT INTO delivery values ('$deliveryid', '$oid', 'N/A', '$deliveryFee','N/A', '$createdAt', '$updatedAt')";
$resultAddDelivery = mysqli_query($con, $queryAddDelivery);


mysqli_close($con);


header('location: thankyou.php');
?>