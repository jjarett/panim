<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

if (isset($_POST['add'])) {
    $discountcode = $_POST['discountcode'];
    $discountpercentage = $_POST['discountpercentage'];
    $minspend = $_POST['minspend'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $createdAt =  date('Y-m-d H:i:s');
    $validity = 0;

    $queryCount = "select max(discount_id) from discount_codes";
    $resultCount = mysqli_query($con, $queryCount);
    while ($row = mysqli_fetch_array($resultCount)) {
        $did = $row["max(discount_id)"] + 1;
    }

    $queryAdd = "INSERT INTO discount_codes values ('$did','$discountcode', '$discountpercentage', '$minspend' ,'$validity', '$createdAt')";
    $resultAdd = mysqli_query($con, $queryAdd);

    if ($resultAdd > 0) {
        echo "<script>alert('Collection Successfully Added')</script>";
       

    } else echo "<script>alert('Collection Failed to be Added')</script>";

    mysqli_close($con);
}

header('location: discountcodes.php');

?>