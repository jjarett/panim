<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

if (isset($_POST['add'])) {
    $collectionname = $_POST['collectionname'];
    $collectiondesc = $_POST['collectiondesc'];
    $filename = $_FILES['photo']['name'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $createdAt =  date('Y-m-d H:i:s');
    $updatedAt =  date('Y-m-d H:i:s');
    $homepage = 0;

    $queryCount = "select max(collection_id) from collections";
    $resultCount = mysqli_query($con, $queryCount);
    while ($row = mysqli_fetch_array($resultCount)) {
        $cid = $row["max(collection_id)"] + 1;
    }

    if (!empty($filename)) {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $newfilename = preg_replace('/[^a-zA-Z0-9\']/', '-', $collectionName);
        $newfilename = str_replace("'", '', $newfilename);
        $new_filename = $newfilename . '.' . $ext;

        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $new_filename);
    } else {
        $new_filename = '';
    }

    $queryAdd = "INSERT INTO collections values ('$cid', '$collectionname', '$collectiondesc', '$new_filename','$homepage', '$createdAt','$updatedAt')";
    $resultAdd = mysqli_query($con, $queryAdd);

    if ($resultAdd > 0) {
        echo "<script>alert('Collection Successfully Added')</script>";
       

    } else echo "<script>alert('Collection Failed to be Added')</script>";

    mysqli_close($con);
}

header('location: collections.php');

?>