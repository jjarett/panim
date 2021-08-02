<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

if (isset($_POST['add'])) {
    $categoryname = $_POST['categoryname'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $createdAt =  date('Y-m-d H:i:s');
    $updatedAt =  date('Y-m-d H:i:s');

    $queryCount = "select max(category_id) from categories";
    $resultCount = mysqli_query($con, $queryCount);
    while ($row = mysqli_fetch_array($resultCount)) {
        $cid = $row["max(category_id)"] + 1;
    }

    $queryAdd = "INSERT INTO categories values ('$cid', '$categoryname', '$createdAt','$updatedAt')";
    $resultAdd = mysqli_query($con, $queryAdd);

    if ($resultAdd > 0) {
        echo "<script>alert('Category Successfully Added')</script>";
       

    } else echo "<script>alert('Category Failed to be Added')</script>";

    mysqli_close($con);
}

header('location: category.php');

?>