<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

if(isset($_POST['update'])){
    $cid = $_POST['customer_id'];
    $cFName = $_POST['customer_fname'];
    $cLName = $_POST['customer_lname'];
    $email = $_POST['email'];
    $mobilenum = $_POST['mobile_number'];
    $address = $_POST['address'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $updatedAt =  date('Y-m-d H:i:s');
    
    
    $queryUpdate="update customers set first_name='$cFName',last_name='$cLName',email='$email',mobile_number='$mobilenum',address='$address',updated_at='$updatedAt' where customer_id='$cid'";
    $resultUpdate = mysqli_query($con, $queryUpdate);
    

    mysqli_close($con);

    header('location: customers.php');

}

?>