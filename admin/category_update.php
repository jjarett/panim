<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

if(isset($_POST['update'])){
    $cid = $_POST['category_id'];
    $categoryName = $_POST['category_name'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $updatedAt =  date('Y-m-d H:i:s');
    
    $queryUpdate="update categories set category_name='$categoryName' where category_id='$cid'";
    $resultUpdate = mysqli_query($con, $queryUpdate);
    

    mysqli_close($con);

    header('location: category.php');

}

?>