<?php

session_start();

$con = mysqli_connect("localhost", "admin", null, "pganim");

if (isset($_POST['save'])) {
    $custid = $_SESSION['cust_id'];
    $address = $_POST['address'];

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $updatedAt =  date('Y-m-d H:i:s');


    $queryUpdate="update customers set address='$address', updated_at = '$updatedAt' where customer_id='$custid'";
    $resultUpdate = mysqli_query($con, $queryUpdate);


    mysqli_close($con);
}

header('location: checkout.php');

?>