<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

if(isset($_POST['update'])){
    $did = $_POST['delivery_id'];
    $oid = $_POST['order_id'];
    $courierused = $_POST['courier_used'];
    $deliveryfee = $_POST['delivery_fee'];
    $trackingno = $_POST['tracking_no'];

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $updatedAt =  date('Y-m-d H:i:s');
    
    
    $queryUpdate="update delivery set order_id='$oid',courier_used='$courierused',delivery_fee='$deliveryfee',tracking_no='$trackingno' where delivery_id='$did'";
    $resultUpdate = mysqli_query($con, $queryUpdate);
    

    mysqli_close($con);

    header('location: deliveries.php');

}

?>