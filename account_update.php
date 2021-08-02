<?php

session_start();

$con = mysqli_connect("localhost", "admin", null, "pganim");

if (isset($_POST['save'])) {
    $custid = $_SESSION['cust_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $mobileno = $_POST['mobileno'];

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $updatedAt =  date('Y-m-d H:i:s');


    $queryUpdate="update customers set first_name='$fname',last_name='$lname',email='$email',mobile_number='$mobileno',address='$address', updated_at = '$updatedAt' where customer_id='$custid'";
    $resultUpdate = mysqli_query($con, $queryUpdate);


    mysqli_close($con);
}

header('location: accountdetails.php');

?>