<?php

$con = mysqli_connect("localhost", "admin", null, "pganim");

if(isset($_POST['update'])){
    $pid = $_POST['product_id'];
    $pname = $_POST['product_name'];
    $pcat = $_POST['category'];
    $pcollection = $_POST['collection'];
    $pprice = $_POST['price'];
    $pdesc = $_POST['description'];
    $pstock = $_POST['stock_status'];
    $filename = $_FILES['photo']['name'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $updatedAt =  date('Y-m-d H:i:s');

    if($_POST['isNew'] == 'on'){
        $isNew = 1;
    }
    else{
        $isNew = 0;
    }

    
    if (!empty($filename)) {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $newfilename = preg_replace('/[^a-zA-Z0-9\']/', '-', $pname);
        $newfilename = str_replace("'", '', $newfilename);
        $new_filename = $newfilename . '.' . $ext;

        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $new_filename);
    } else {
        $new_filename = $_POST['photoName'];
    }

    $queryUpdate="update products set product_name='$pname',category_id='$pcat',collection_id='$pcollection',img='$new_filename',price='$pprice',description='$pdesc', stock_status='$pstock', isNew='$isNew', updated_at = '$updatedAt' where product_id='$pid'";
    $resultUpdate = mysqli_query($con, $queryUpdate);

    
    }

    mysqli_close($con);

    header('location: products.php');


?>