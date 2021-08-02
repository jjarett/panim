<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

if(isset($_POST['update'])){
    $did = $_POST['discount_id'];
    $discountcode = $_POST['discount_code'];
    $discountpercentage = $_POST['discount_percentage'];
    $minspend = $_POST['min_spend'];

    if($_POST['validity'] == 'on'){
        $validity = 1;
    }
    else{
        $validity = 0;
    }

    
    $queryUpdate="update discount_codes set discount_code='$discountcode', discount_percentage='$discountpercentage', min_spend='$minspend', validity='$validity' where discount_id='$did'";
    $resultUpdate = mysqli_query($con, $queryUpdate);
    

    mysqli_close($con);

   header('location: discountcodes.php');

}

?>