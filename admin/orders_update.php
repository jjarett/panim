<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

if(isset($_POST['update'])){
    $oid = $_POST['order_id'];
    $cname = $_POST['customer_name'];
    $price = $_POST['price'];
    $order_status = $_POST['order_status'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $updatedAt =  date('Y-m-d H:i:s');

    $queryCustomer = "SELECT * FROM customers where first_name = '$cname'";
    $resultCustomer = mysqli_query($con, $queryCustomer);
    // $queryProduct = "SELECT * FROM products where product_name = '$pname'";
    // $resultProduct = mysqli_query($con, $queryProduct);

    foreach ($resultCustomer as $customers) {
        $cid = $customers['customer_id'];
    }
    // foreach ($resultProduct as $products) {
    //     $pid = $products['product_id'];
    // }

    
    
    $queryUpdate="update orders set customer_id='$cid',price='$price',order_status='$order_status',updated_at='$updatedAt' where order_id='$oid'";
    $resultUpdate = mysqli_query($con, $queryUpdate);
    

    mysqli_close($con);

    header('location: orders.php');

}

?>